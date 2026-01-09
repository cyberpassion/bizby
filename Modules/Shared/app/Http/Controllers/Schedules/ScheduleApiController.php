<?php

namespace Modules\Shared\Http\Controllers\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Shared\Models\Schedules\Schedule;
use Modules\Shared\Jobs\Schedules\RunScheduleJob;
use Modules\Shared\Services\Schedules\ScheduleNextRunCalculator;

class ScheduleApiController extends Controller
{

	public $tenantID = 1;
    /**
     * List schedules for current tenant
     */
    public function index()
    {
        return Schedule::where('tenant_id', $this->tenantID)
            ->orderByDesc('created_at')
            ->get();
    }

    /**
     * Create a new schedule (CENTRAL DB)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'             => 'required|string|max:255',
            'job_key'          => 'required|string',
            'frequency'        => 'required|in:daily,weekly,monthly,cron',
            'cron_expression'  => 'required_if:frequency,cron|nullable|string',
            'run_at'           => 'required_unless:frequency,cron|nullable',
            'timezone'         => 'nullable|string',
            'meta'             => 'nullable|array',
        ]);

        $data['tenant_id'] = $this->tenantID;
        $data['timezone'] ??= config('app.timezone');

        $schedule = Schedule::create($data);

        // 🔥 IMPORTANT: calculate next run immediately
        $schedule->update([
            'next_run_at' => ScheduleNextRunCalculator::calculate($schedule),
        ]);

        return response()->json($schedule, 201);
    }

    /**
     * Update schedule
     */
    public function update(Request $request, Schedule $schedule)
    {
        $this->authorizeTenant($schedule);

        $data = $request->validate([
            'name'             => 'sometimes|string|max:255',
            'job_key'          => 'sometimes|string',
            'frequency'        => 'sometimes|in:daily,weekly,monthly,cron',
            'cron_expression'  => 'nullable|string',
            'run_at'           => 'nullable',
            'timezone'         => 'nullable|string',
            'meta'             => 'nullable|array',
        ]);

        $schedule->update($data);

        // Recalculate next run when schedule changes
        if ($schedule->is_active) {
            $schedule->update([
                'next_run_at' => ScheduleNextRunCalculator::calculate($schedule),
            ]);
        }

        return $schedule;
    }

	/**
	 * Show a single schedule
	 */
	public function show(Schedule $schedule)
	{
    	$this->authorizeTenant($schedule);

    	return response()->json($schedule);
	}

	/**
	 * Delete a schedule
	 */
	public function destroy(Schedule $schedule)
	{
    	$this->authorizeTenant($schedule);

	    $schedule->delete();

		return response()->json([
            'status' => 'success',
            'message' => 'Resource deleted successfully.',
            'data' => null
        ], 200);
	}

    /**
     * Enable / Disable schedule
     */
    public function toggle(Schedule $schedule)
    {
        $this->authorizeTenant($schedule);

        $schedule->update([
            'is_active' => ! $schedule->is_active,
        ]);

        // If re-enabled, recalc next run
        if ($schedule->is_active) {
            $schedule->update([
                'next_run_at' => ScheduleNextRunCalculator::calculate($schedule),
            ]);
        }

        return $schedule;
    }

    /**
     * Run schedule immediately (manual trigger)
     */
    public function runNow(Schedule $schedule)
    {
        $this->authorizeTenant($schedule);

        dispatch(new RunScheduleJob($schedule));

        return response()->json([
            'status' => 'queued',
        ]);
    }

    /**
     * Tenant authorization (CENTRAL DB safety)
     */
    protected function authorizeTenant(Schedule $schedule): void
    {
        abort_if(
            $schedule->tenant_id !== $this->tenantID,
            403,
            'Unauthorized schedule access'
        );
    }
}

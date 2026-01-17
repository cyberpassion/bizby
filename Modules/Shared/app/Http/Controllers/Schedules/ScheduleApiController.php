<?php

namespace Modules\Shared\Http\Controllers\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Shared\Models\Schedules\Schedule;
use Modules\Shared\Models\Schedules\ScheduleLock;
use Modules\Shared\Jobs\Schedules\RunScheduleJob;
use Modules\Shared\Services\Schedules\ScheduleNextRunCalculator;

class ScheduleApiController extends Controller
{
    protected function tenantId(): int
    {
        return tenant('id');
    }

    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Schedule::where('tenant_id', $this->tenantId())
                ->orderByDesc('created_at')
                ->get()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'job_key'         => 'required|string',
            'frequency'       => 'required|in:daily,weekly,monthly,cron',
            'cron_expression' => 'required_if:frequency,cron|nullable|string',
            'run_at'          => 'required_unless:frequency,cron|nullable',
            'timezone'        => 'nullable|string',
            'meta'            => 'nullable|array',
        ]);

        $data['tenant_id'] = $this->tenantId();
        $data['timezone'] ??= config('app.timezone');

        $schedule = Schedule::create($data);

        $schedule->update([
            'next_run_at' => ScheduleNextRunCalculator::calculate($schedule)
        ]);

        return response()->json([
            'status' => 'success',
            'data'   => $schedule
        ], 201);
    }

    public function show(Schedule $schedule)
    {
        $this->authorizeTenant($schedule);

        return response()->json(['status' => 'success', 'data' => $schedule]);
    }

    public function update(Request $request, Schedule $schedule)
    {
        $this->authorizeTenant($schedule);

        $schedule->update($request->validate([
            'name'            => 'sometimes|string|max:255',
            'job_key'         => 'sometimes|string',
            'frequency'       => 'sometimes|in:daily,weekly,monthly,cron',
            'cron_expression' => 'nullable|string',
            'run_at'          => 'nullable',
            'timezone'        => 'nullable|string',
            'meta'            => 'nullable|array',
        ]));

        if ($schedule->is_active) {
            $schedule->update([
                'next_run_at' => ScheduleNextRunCalculator::calculate($schedule)
            ]);
        }

        return response()->json(['status' => 'success', 'data' => $schedule]);
    }

    public function destroy(Schedule $schedule)
    {
        $this->authorizeTenant($schedule);

        $schedule->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Schedule deleted'
        ]);
    }

    public function toggle(Schedule $schedule)
    {
        $this->authorizeTenant($schedule);

        $schedule->update(['is_active' => ! $schedule->is_active]);

        if ($schedule->is_active) {
            $schedule->update([
                'next_run_at' => ScheduleNextRunCalculator::calculate($schedule)
            ]);
        }

        return response()->json(['status' => 'success', 'data' => $schedule]);
    }

    public function runNow(Schedule $schedule)
    {
        $this->authorizeTenant($schedule);

        // 🔐 Acquire lock before dispatch
        $lock = ScheduleLock::acquire($schedule);

        abort_if(! $lock, 409, 'Schedule already running');

        dispatch(new RunScheduleJob($schedule));

        return response()->json(['status' => 'queued']);
    }

    protected function authorizeTenant(Schedule $schedule): void
    {
        abort_if($schedule->tenant_id !== $this->tenantId(), 403);
    }
}

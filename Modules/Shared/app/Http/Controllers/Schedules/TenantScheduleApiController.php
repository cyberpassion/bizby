<?php

namespace Modules\Shared\Http\Controllers\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Shared\Models\Schedules\TenantSchedule;

class TenantScheduleApiController extends Controller
{
    public function index()
    {
        return TenantSchedule::where('tenant_id', tenant()->id)
            ->latest()
            ->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'job_key' => 'required|string',
            'frequency' => 'required|in:daily,weekly,monthly,cron',
            'cron_expression' => 'nullable|string',
            'run_at' => 'nullable',
            'timezone' => 'nullable|string',
            'meta' => 'nullable|array',
        ]);

        $data['tenant_id'] = tenant()->id;

        return TenantSchedule::create($data);
    }

    public function update(Request $request, TenantSchedule $tenantSchedule)
    {
        $this->authorizeTenant($tenantSchedule);

        $tenantSchedule->update(
            $request->only([
                'name',
                'job_key',
                'frequency',
                'cron_expression',
                'run_at',
                'timezone',
                'meta',
            ])
        );

        return $tenantSchedule;
    }

    public function toggle(TenantSchedule $tenantSchedule)
    {
        $this->authorizeTenant($tenantSchedule);

        $tenantSchedule->update([
            'is_active' => ! $tenantSchedule->is_active,
        ]);

        return $tenantSchedule;
    }

    public function runNow(TenantSchedule $tenantSchedule)
    {
        $this->authorizeTenant($tenantSchedule);

        dispatch(new RunTenantScheduleJob($tenantSchedule));

        return response()->json(['status' => 'queued']);
    }

    protected function authorizeTenant(TenantSchedule $schedule)
    {
        abort_if($schedule->tenant_id !== tenant()->id, 403);
    }
}

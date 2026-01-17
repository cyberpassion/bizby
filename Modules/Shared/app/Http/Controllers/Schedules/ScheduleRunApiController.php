<?php

namespace Modules\Shared\Http\Controllers\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Shared\Models\Schedules\Schedule;
use Modules\Shared\Models\Schedules\ScheduleRun;

class ScheduleRunApiController extends Controller
{
    protected function tenantId(): int
    {
        return tenant('id');
    }

    public function index(Request $request, Schedule $schedule)
    {
        $this->authorizeTenant($schedule);

        $query = ScheduleRun::where('schedule_id', $schedule->id)
            ->where('tenant_id', $this->tenantId());

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return response()->json([
            'status' => 'success',
            'data' => $query->orderByDesc('created_at')->paginate(20)
        ]);
    }

    public function show(Schedule $schedule, ScheduleRun $run)
    {
        $this->authorizeTenant($schedule);

        abort_if($run->schedule_id !== $schedule->id, 404);

        return response()->json(['status' => 'success', 'data' => $run]);
    }

    protected function authorizeTenant(Schedule $schedule): void
    {
        abort_if($schedule->tenant_id !== $this->tenantId(), 403);
    }
}

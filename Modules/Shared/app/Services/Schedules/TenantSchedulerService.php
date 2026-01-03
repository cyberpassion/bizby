<?php
namespace Modules\Shared\Services\Schedules;

use Modules\Shared\Models\Schedules\TenantSchedule;
use Modules\Shared\Jobs\Schedules\RunTenantScheduleJob;

class TenantScheduleRunnerService
{
    public function runDueSchedules(): void
    {
        $now = now();

        TenantSchedule::where('is_active', true)
            ->whereTime('run_at', $now->format('H:i'))
            ->each(function ($schedule) {
                dispatch(new RunTenantScheduleJob($schedule));
            });
    }
}

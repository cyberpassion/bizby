<?php
namespace Modules\Shared\Services\Schedules;

use Modules\Shared\Models\Schedules\Schedule;
use Modules\Shared\Jobs\Schedules\RunScheduleJob;

class ScheduleRunnerService
{
    public function runDueSchedules(): void
    {
        $now = now();

        Schedule::where('is_active', true)
            ->whereTime('run_at', $now->format('H:i'))
            ->each(function ($schedule) {
                dispatch(new RunScheduleJob($schedule));
            });
    }
}

<?php

namespace Modules\Shared\Services\Schedules;

use Modules\Shared\Models\Schedules\Schedule;

class ScheduleJobDispatcher
{
    public static function dispatch(Schedule $schedule): void
    {
        ScheduleJobRegistry::run($schedule->job_key);
    }
}

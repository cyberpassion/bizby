<?php

namespace Modules\Shared\Services\Schedules;

use Exception;
use Modules\Shared\Models\Schedules\Schedule;
use Modules\Shared\Jobs\Reports\SendCashReportJob;
use Modules\Shared\Jobs\Reminders\SendLeadReminderJob;

class ScheduleJobDispatcher
{
    public static function dispatch(Schedule $schedule): void
    {
        ScheduleJobRegistry::run($schedule->job_key);
    }
}

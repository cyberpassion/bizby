<?php
namespace Modules\Shared\Services\Schedules;

use Exception;
use Modules\Shared\Models\Schedules\TenantSchedule;

class TenantScheduleJobDispatcher
{
    public static function dispatch(TenantSchedule $schedule): void
    {
        match ($schedule->job_key) {
            //'report:cash'    => dispatch(new SendCashReportJob()),
            //'reminder:fees'  => dispatch(new SendFeeReminderJob()),
            //'billing:invoice'=> dispatch(new GenerateInvoiceJob()),
            default => throw new Exception(
                "Invalid tenant schedule job: {$schedule->job_key}"
            ),
        };
    }
}

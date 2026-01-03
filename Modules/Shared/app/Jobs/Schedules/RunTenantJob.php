<?php

namespace Modules\Shared\Jobs\Schedules;

use Throwable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use Modules\Shared\Jobs\Reports\SendCashReportJob;
use Modules\Shared\Jobs\Reminders\SendLeadReminderJob;

use Modules\Shared\Models\Schedules\TenantSchedule;

class RunTenantJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public TenantSchedule $schedule
    ) {}

    public function handle(): void
    {
        try {
            // ✅ Initialize tenant context
            tenancy()->initialize($this->schedule->tenant_id);

            // ✅ Execute job synchronously inside tenant context
            $this->runJob($this->schedule);

        } catch (Throwable $e) {
            Log::error('Tenant job failed', [
                'tenant_id'   => $this->schedule->tenant_id,
                'schedule_id' => $this->schedule->id,
                'job'         => $this->schedule->job,
                'error'       => $e->getMessage(),
            ]);

            throw $e;

        } finally {
            // ✅ ALWAYS end tenancy
            tenancy()->end();
        }
    }

    protected function runJob(TenantSchedule $schedule): void
    {
        match ($schedule->job) {

            // REPORTS
            'report:cash' =>
                (new SendCashReportJob())->handle(),

            // REMINDERS
            'reminder:leads' =>
                (new SendLeadReminderJob())->handle(),

            default =>
                Log::warning('Unknown tenant schedule job', [
                    'tenant_id'   => $schedule->tenant_id,
                    'schedule_id' => $schedule->id,
                    'job'         => $schedule->job,
                ]),
        };
    }
}

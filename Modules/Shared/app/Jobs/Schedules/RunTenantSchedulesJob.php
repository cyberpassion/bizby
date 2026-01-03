<?php

namespace Modules\Shared\Jobs\Schedules;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Modules\Shared\Models\Schedules\TenantSchedule;
use Modules\Shared\Models\Schedules\TenantScheduleRun;
use Modules\Shared\Services\Schedules\TenantScheduleJobDispatcher;

use Stancl\Tenancy\Facades\Tenancy;

class RunTenantScheduleJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public function __construct(public TenantSchedule $schedule) {}

    public function handle()
    {
        // ✅ Correct tenant initialization
        Tenancy::initialize($this->schedule->tenant_id);

        $run = TenantScheduleRun::create([
            'schedule_id' => $this->schedule->id,
            'tenant_id' => $this->schedule->tenant_id,
            'status' => 'running',
            'started_at' => now(),
        ]);

        try {
            TenantScheduleJobDispatcher::dispatch($this->schedule);

            $run->update([
                'status' => 'success',
                'finished_at' => now(),
            ]);

            $this->schedule->update([
                'last_run_at' => now(),
            ]);
        } catch (\Throwable $e) {
            $run->update([
                'status' => 'failed',
                'finished_at' => now(),
                'error' => $e->getMessage(),
            ]);

            throw $e;
        } finally {
            // ✅ IMPORTANT: end tenancy
            Tenancy::end();
        }
    }
}

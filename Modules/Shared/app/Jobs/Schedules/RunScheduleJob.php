<?php

namespace Modules\Shared\Jobs\Schedules;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Modules\Shared\Models\Schedules\Schedule;
use Modules\Shared\Models\Schedules\ScheduleRun;
use Modules\Shared\Services\Schedules\ScheduleJobDispatcher;
use Modules\Shared\Services\Schedules\ScheduleLockService;

use Stancl\Tenancy\Facades\Tenancy;

class RunScheduleJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public function __construct(public Schedule $schedule) {}

    public function handle()
	{
	    // 🔒 Acquire lock
    	if (! ScheduleLockService::acquire(
        	$this->schedule->id,
        	$this->schedule->tenant_id
	    )) {
    	    return; // Already running → skip
    	}

	    Tenancy::initialize($this->schedule->tenant_id);

	    $run = ScheduleRun::create([
    	    'schedule_id' => $this->schedule->id,
        	'tenant_id'   => $this->schedule->tenant_id,
        	'status'      => 'running',
        	'started_at'  => now(),
	    ]);

	    try {
    	    ScheduleJobDispatcher::dispatch($this->schedule);

	        $run->update([
    	        'status'       => 'success',
        	    'finished_at' => now(),
	        ]);

	        $this->schedule->update([
    	        'last_run_at' => now(),
        	]);

	    } catch (\Throwable $e) {

	        $run->update([
    	        'status'       => 'failed',
        	    'finished_at' => now(),
            	'error'        => $e->getMessage(),
	        ]);

	        throw $e;

	    } finally {
    	    Tenancy::end();

	        // 🔓 Always release lock
    	    ScheduleLockService::release(
        	    $this->schedule->id,
            	$this->schedule->tenant_id
	        );
    	}
	}

}

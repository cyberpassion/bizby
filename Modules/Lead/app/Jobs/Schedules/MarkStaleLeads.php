<?php

namespace Modules\Lead\Jobs\Schedules;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Lead\Models\Lead;

class MarkStaleLeads implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        Lead::query()
            ->whereNull('converted_at')
            ->where('status', '!=', 'stale')
            ->where('updated_at', '<=', now()->subDays(14))
            ->chunkById(200, function ($leads) {
                foreach ($leads as $lead) {
                    $lead->update([
                        'status' => 'stale',
                        'stale_at' => now(),
                    ]);
                }
            });
    }
}

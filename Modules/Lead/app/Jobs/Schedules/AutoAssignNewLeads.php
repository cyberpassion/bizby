<?php

namespace Modules\Lead\Jobs\Schedules;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Lead\Models\Lead;
use Modules\Lead\Services\LeadAssignmentService;

class AutoAssignNewLeads implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        Lead::query()
            ->whereNull('assigned_to')
            ->where('status', 'new')
            ->limit(50)
            ->get()
            ->each(function ($lead) {
                app(LeadAssignmentService::class)->assign($lead);
            });
    }
}

<?php

namespace Modules\Lead\Jobs\Schedules;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Lead\Models\Lead;
use Illuminate\Support\Facades\Notification;
use Modules\Lead\Notifications\LeadFollowupReminder;

class SendLeadFollowupReminders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        /*Lead::query()
            ->whereNull('converted_at')
            ->whereNotNull('next_followup_at')
            ->whereDate('next_followup_at', '<=', now())
            ->with(['owner'])
            ->chunkById(100, function ($leads) {
                foreach ($leads as $lead) {
                    if ($lead->owner) {
                        Notification::send(
                            $lead->owner,
                            new LeadFollowupReminder($lead)
                        );
                    }

                    // prevent duplicate reminders
                    $lead->updateQuietly([
                        'last_reminded_at' => now(),
                    ]);
                }
            });*/
    }
}

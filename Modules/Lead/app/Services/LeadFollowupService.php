<?php

namespace Modules\Lead\Services;

use Modules\Lead\Models\Lead;
use Illuminate\Support\Facades\Notification;
use Modules\Lead\Notifications\LeadFollowupReminder;

class LeadFollowupService
{
    public function sendReminders(): void
    {
        Lead::query()
            ->whereNull('converted_at')
            ->whereNotNull('next_followup_at')
            ->whereDate('next_followup_at', '<=', now())
            ->with('owner')
            ->chunkById(100, function ($leads) {
                foreach ($leads as $lead) {
                    if ($lead->owner) {
                        Notification::send(
                            $lead->owner,
                            new LeadFollowupReminder($lead)
                        );
                    }

                    $lead->updateQuietly([
                        'last_reminded_at' => now(),
                    ]);
                }
            });
    }
}

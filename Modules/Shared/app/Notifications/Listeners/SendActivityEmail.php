<?php
namespace Modules\Shared\Notifications\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Modules\Shared\Notifications\Events\ActivityOccurred;
use Modules\Shared\Notifications\Mailables\ActivityMail;
use Modules\Shared\Notifications\Services\TenantNotificationPreferenceService;
use Modules\Shared\Notifications\Services\NotificationAuditService;
use Modules\Shared\Notifications\Services\NotificationPayloadResolver;

class SendActivityEmail implements ShouldQueue
{
    public $tries = 5;
    public $backoff = [60, 300, 900];

    public function handle(
        ActivityOccurred $event,
        TenantNotificationPreferenceService $prefs,
        NotificationPayloadResolver $resolver,
        NotificationAuditService $audit
    ) {
        if (! $prefs->enabled($event->tenantId, $event->activityKey, 'email')) return;

        $email = $resolver->email($event);

        $auditId = $audit->log([
            'tenant_id' => $event->tenantId,
            'activity_key' => $event->activityKey,
            'channel' => 'email',
            'to' => $event->toEmail,
            'status' => 'queued',
            'payload' => json_encode($event->data),
        ]);

        try {
            Mail::to($event->toEmail)->send(
                new ActivityMail($email['subject'], $email['view'], $email['vars'])
            );
        } catch (\Throwable $e) {
            $audit->markFailed($auditId, $e->getMessage());
            throw $e;
        }
    }
}

<?php

namespace Modules\Shared\Notifications\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Shared\Notifications\Channels\WhatsappChannel;
use Modules\Shared\Notifications\Events\ActivityOccurred;
use Modules\Shared\Notifications\Mailables\ActivityMail;
use Modules\Shared\Notifications\Services\TenantNotificationPreferenceService;
use Modules\Shared\Notifications\Services\NotificationAuditService;
use Modules\Shared\Notifications\Services\NotificationPayloadResolver;

class SendActivityWhatsapp implements ShouldQueue
{
    public function handle(
        ActivityOccurred $event,
        TenantNotificationPreferenceService $prefs,
        NotificationPayloadResolver $resolver
    ) {
        if (! $event->toMobile) return;
        if (! $prefs->enabled($event->tenantId, $event->activityKey, 'whatsapp')) return;

        WhatsappChannel::send(
            $event->toMobile,
            $resolver->whatsapp($event)
        );
    }
}

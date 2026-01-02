<?php

namespace Modules\Shared\Mail\Notifications;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GenericReminderMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public string $name,
        public string $message,
        public ?string $actionUrl = null,
        public ?string $actionText = null
    ) {}

    public function build()
    {
        return $this
            ->subject('Notification from Bizby')
            ->view('shared::emails.notifications.reminder-generic');
    }
}

<?php

namespace Modules\Shared\Mails\Notifications;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GenericReminderMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public string $name,
        public string $content,
        public ?string $actionUrl = null,
        public ?string $actionText = null
    ) {}

    public function build()
    {
        return $this
            ->subject('Notification from Bizby')
            ->view('shared::emails.notifications.reminder-generic')
			->with([
                'content' => $this->content,
            ]);;
    }
}

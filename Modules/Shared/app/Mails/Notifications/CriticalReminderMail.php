<?php

namespace Modules\Shared\Mails\Notifications;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CriticalReminderMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public string $name,
        public string $content,
        public string $actionUrl,
        public string $actionText
    ) {}

    public function build()
    {
        return $this
            ->subject('Action Required')
            ->view('shared::emails.notifications.reminder-critical')
			->with([
                'content' => $this->content,
            ]);;
    }
}

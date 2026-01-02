<?php

namespace Modules\Shared\Mail\Notifications;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderListMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public string $name,
        public string $title,
        public array $items,      // array of rows
        public ?string $actionUrl = null,
        public ?string $actionText = null
    ) {}

    public function build()
    {
        return $this
            ->subject($this->title)
            ->view('shared::emails.notifications.reminder-list');
    }
}

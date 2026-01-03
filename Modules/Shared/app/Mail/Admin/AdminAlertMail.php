<?php

namespace Modules\Shared\Mail\Admin;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminAlertMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public string $content
    ) {}

    public function build()
    {
        return $this
            ->subject('Admin Alert')
            ->view('shared::emails.admin.alert')
            ->with([
                'content' => $this->content,
            ]);
    }
}

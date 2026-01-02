<?php

namespace Modules\Shared\Mail\Auth;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationPendingReminderMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public string $name,
        public string $resumeUrl
    ) {}

    public function build()
    {
        return $this
            ->subject('Complete your registration')
            ->view('shared::emails.auth.registration-pending');
    }
}

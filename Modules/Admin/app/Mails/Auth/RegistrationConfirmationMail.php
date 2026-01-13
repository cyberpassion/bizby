<?php

namespace Modules\Admin\Mails\Auth;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationConfirmationMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public string $name,
        public string $loginUrl
    ) {}

    public function build()
    {
        return $this
            ->subject('Welcome to Bizby')
            ->view('admin::emails.auth.registration-confirmation');
    }
}

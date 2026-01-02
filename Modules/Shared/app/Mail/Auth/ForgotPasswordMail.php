<?php

namespace Modules\Shared\Mail\Auth;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public string $name,
        public string $resetUrl
    ) {}

    public function build()
    {
        return $this
            ->subject('Reset your password')
            ->view('shared::emails.auth.forgot-password');
    }
}

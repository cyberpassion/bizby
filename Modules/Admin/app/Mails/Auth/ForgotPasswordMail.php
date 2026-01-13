<?php

namespace Modules\Admin\Mails\Auth;

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
            ->view('admin::emails.auth.forgot-password');
    }
}

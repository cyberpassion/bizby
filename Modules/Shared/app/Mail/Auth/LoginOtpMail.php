<?php
namespace Modules\Shared\Mail\Auth;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginOtpMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public string $name,
        public string $otp
    ) {}

    public function build()
    {
        return $this
            ->subject('Your login code')
            ->view('shared::emails.auth.login-otp');
    }
}

<?php
namespace Modules\Admin\Mails\Auth;

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
            ->view('admin::emails.auth.login-otp');
    }
}

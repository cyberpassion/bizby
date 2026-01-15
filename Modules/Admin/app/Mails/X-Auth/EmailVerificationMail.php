<?php
namespace Modules\Admin\Mails\Auth;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerificationMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public string $name,
        public string $verifyUrl
    ) {}

    public function build()
    {
        return $this->subject('Verify your email')
            ->view('admin::emails.auth.verify-email');
    }
}

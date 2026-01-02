<?php
namespace Modules\Shared\Mail\Auth;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginAlertMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public string $name,
        public string $ip,
        public string $device
    ) {}

    public function build()
    {
        return $this->subject('New login detected')
            ->view('shared::emails.auth.login-alert');
    }
}

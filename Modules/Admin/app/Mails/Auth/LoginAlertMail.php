<?php
namespace Modules\Admin\Mails\Auth;

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
            ->view('admin::emails.auth.login-alert');
    }
}

<?php
namespace Modules\Admin\Mails\Auth;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountLockedMail extends Mailable
{
    use SerializesModels;

    public function __construct(public string $name) {}

    public function build()
    {
        return $this->subject('Account locked')
            ->view('admin::emails.auth.account-locked');
    }
}

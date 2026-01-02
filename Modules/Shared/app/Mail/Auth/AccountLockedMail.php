<?php
namespace Modules\Shared\Mail\Auth;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountLockedMail extends Mailable
{
    use SerializesModels;

    public function __construct(public string $name) {}

    public function build()
    {
        return $this->subject('Account locked')
            ->view('shared::emails.auth.account-locked');
    }
}

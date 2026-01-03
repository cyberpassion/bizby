<?php
namespace Modules\Shared\Mail\Engagement;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InactivityNudgeMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public string $name,
        public string $loginUrl
    ) {}

    public function build()
    {
        return $this->subject('We miss you on Bizby')
            ->view('shared::emails.engagement.inactive');
    }
}

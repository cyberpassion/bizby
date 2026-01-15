<?php
namespace Modules\Shared\Mails\Billing;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionActivatedMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public string $name,
        public string $plan,
        public string $invoiceUrl
    ) {}

    public function build()
    {
        return $this->subject('Subscription activated')
            ->view('shared::emails.billing.subscription-activated');
    }
}

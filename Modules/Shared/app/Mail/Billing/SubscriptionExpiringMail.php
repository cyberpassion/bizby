<?php
namespace Modules\Shared\Mail\Billing;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionExpiringMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public string $name,
        public string $expiryDate,
        public string $renewUrl
    ) {}

    public function build()
    {
        return $this->subject('Subscription expiring soon')
            ->view('shared::emails.billing.subscription-expiring');
    }
}

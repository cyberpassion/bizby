<?php
namespace Modules\Shared\Mail\Billing;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentFailedMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public string $name,
        public string $retryUrl
    ) {}

    public function build()
    {
        return $this->subject('Payment failed')
            ->view('shared::emails.billing.payment-failed');
    }
}

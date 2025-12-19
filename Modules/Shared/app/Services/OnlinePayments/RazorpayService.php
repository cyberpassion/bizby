<?php

namespace Modules\Shared\Services\OnlinePayments;

use Razorpay\Api\Api;
use Razorpay\Api\Order;

class RazorpayService
{
    protected Api $api;

    public function __construct()
    {
        $this->api = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );
    }

    /**
     * Create a Razorpay order
     */
    public function createOrder(
        float $amount,
        string $receipt,
        string $currency = 'INR'
    ): Order {
        return $this->api->order->create([
            'amount'   			=> (int) round($amount * 100), // paise
            'currency' 			=> $currency,
            'receipt'  			=> $receipt
        ]);
    }

    /**
     * Verify Razorpay payment signature
     */
    public function verifySignature(array $attributes): bool
    {
        $this->api->utility->verifyPaymentSignature($attributes);
        return true;
    }
}

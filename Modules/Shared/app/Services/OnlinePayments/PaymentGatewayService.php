<?php

namespace Modules\Shared\Services\OnlinePayments;

use Modules\Shared\Models\OnlinePayments\OnlinePayment;
use Illuminate\Support\Facades\Log;

class PaymentGatewayService
{
    protected RazorpayService $razorpay;

    public function __construct(RazorpayService $razorpay)
    {
        $this->razorpay = $razorpay;
    }

    /**
     * Create gateway order for a payment attempt
     */
    public function createOrder(OnlinePayment $payment): array
    {
        // Idempotency guard
        if ($payment->gateway_order_id) {
            return [
                'gateway'   => $payment->gateway,
                'order_id'  => $payment->gateway_order_id,
                'amount'    => $payment->amount,
                'currency'  => $payment->currency,
                'payload'   => $payment->gateway_payload,
            ];
        }

        // Razorpay order
        $order = $this->razorpay->createOrder(
            $payment->amount,
            'pay_' . $payment->id
        );

        return [
            'gateway'  => 'razorpay',
            'order_id' => $order['id'],
            'amount'   => $payment->amount,
            'currency' => $payment->currency,
            'payload'  => $order,
        ];
    }

    /**
     * Verify webhook signature (gateway-specific)
     */
    public function verifyWebhook($request): void
    {
        $signature = $request->header('X-Razorpay-Signature');
        $body      = $request->getContent();

        $this->razorpay->verifyWebhookSignature($body, $signature);
    }

    /**
     * Refund a payment
     */
    public function refund(OnlinePayment $payment, ?float $amount = null): array
    {
        if (! $payment->gateway_payment_id) {
            throw new \Exception('Cannot refund: gateway payment id missing');
        }

        return $this->razorpay->refund(
            $payment->gateway_payment_id,
            $amount ?? $payment->amount
        );
    }
}

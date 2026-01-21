<?php

namespace Modules\Shared\Services\OnlinePayments;

use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Order;
use Razorpay\Api\Payment;
use Razorpay\Api\Refund;

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
     * Create Razorpay order
     */
    public function createOrder(
        float $amount,
        string $receipt,
        string $currency = 'INR'
    ): array {
        try {
            $order = $this->api->order->create([
                'amount'   => (int) round($amount * 100), // paise
                'currency' => $currency,
                'receipt'  => $receipt,
                'notes'    => [
                    'system' => 'bizby',
                ],
            ]);

            return $order->toArray();
        } catch (\Throwable $e) {
            Log::error('Razorpay order creation failed', [
                'error' => $e->getMessage(),
            ]);

            throw new \Exception('Unable to create payment order');
        }
    }

    /**
     * Verify webhook signature (MANDATORY)
     */
    public function verifyWebhookSignature(
        string $payload,
        string $signature
    ): void {
        try {
            $this->api->utility->verifyWebhookSignature(
                $payload,
                $signature,
                config('services.razorpay.webhook_secret')
            );
        } catch (\Throwable $e) {
            Log::warning('Invalid Razorpay webhook signature', [
                'error' => $e->getMessage(),
            ]);

            throw new \Exception('Invalid webhook signature');
        }
    }

    /**
     * Verify payment signature (frontend redirect flow, optional)
     */
    public function verifyPaymentSignature(array $attributes): void
    {
        try {
            $this->api->utility->verifyPaymentSignature($attributes);
        } catch (\Throwable $e) {
            Log::warning('Invalid Razorpay payment signature', [
                'error' => $e->getMessage(),
            ]);

            throw new \Exception('Invalid payment signature');
        }
    }

    /**
     * Fetch payment from Razorpay
     */
    public function fetchPayment(string $paymentId): array
    {
        try {
            return $this->api->payment->fetch($paymentId)->toArray();
        } catch (\Throwable $e) {
            Log::error('Failed to fetch Razorpay payment', [
                'payment_id' => $paymentId,
                'error'      => $e->getMessage(),
            ]);

            throw new \Exception('Unable to fetch payment');
        }
    }

    /**
     * Capture payment (if manual capture enabled)
     */
    public function capture(string $paymentId, float $amount): array
    {
        try {
            return $this->api->payment
                ->fetch($paymentId)
                ->capture(['amount' => (int) round($amount * 100)])
                ->toArray();
        } catch (\Throwable $e) {
            Log::error('Failed to capture Razorpay payment', [
                'payment_id' => $paymentId,
                'error'      => $e->getMessage(),
            ]);

            throw new \Exception('Payment capture failed');
        }
    }

    /**
     * Refund payment (full or partial)
     */
    public function refund(string $paymentId, ?float $amount = null): array
    {
        try {
            $payload = [];

            if ($amount !== null) {
                $payload['amount'] = (int) round($amount * 100);
            }

            return $this->api->payment
                ->fetch($paymentId)
                ->refund($payload)
                ->toArray();
        } catch (\Throwable $e) {
            Log::error('Razorpay refund failed', [
                'payment_id' => $paymentId,
                'amount'     => $amount,
                'error'      => $e->getMessage(),
            ]);

            throw new \Exception('Refund failed');
        }
    }
}

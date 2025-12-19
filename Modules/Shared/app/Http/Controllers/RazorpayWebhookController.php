<?php

namespace Modules\Shared\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Shared\Models\OnlinePayment;
use Razorpay\Api\Api;

class RazorpayWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $signature = $request->header('X-Razorpay-Signature');

        // 1️⃣ Verify webhook signature
        $expectedSignature = hash_hmac(
            'sha256',
            $payload,
            config('services.razorpay.webhook_secret')
        );

        /*if (! hash_equals($expectedSignature, $signature)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid webhook signature',
            ], Response::HTTP_UNAUTHORIZED);
        }*/

        $event = json_decode($payload, true);

        // 2️⃣ Only care about payment events
        if (! isset($event['event'])) {
            return response()->json(['status' => 'ignored']);
        }

        $razorpayPaymentId = $event['payload']['payment']['entity']['id'] ?? null;

        if (! $razorpayPaymentId) {
            return response()->json(['status' => 'ignored']);
        }

        // 3️⃣ Find your payment record
        $payment = OnlinePayment::where(
            'gateway_payment_id',
            $razorpayPaymentId
        )->first();

        if (! $payment) {
            return response()->json([
                'status' => 'ignored',
                'message' => 'Payment not found',
            ]);
        }

        // Idempotency: already final
        if (in_array($payment->payment_status, ['success', 'failed'])) {
            return response()->json(['status' => 'success']);
        }

        // 4️⃣ Fetch payment from Razorpay API (final truth)
        $razorpay = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );

        $rzpPayment = $razorpay->payment->fetch($razorpayPaymentId);

        // 5️⃣ Validate amount
        if ((int) $rzpPayment->amount !== (int) ($payment->amount * 100)) {
            $payment->update([
                'payment_status' => 'failed',
                'system_remark'  => 'Amount mismatch in webhook',
            ]);

            return response()->json(['status' => 'error']);
        }

        // 6️⃣ Handle events
        if ($event['event'] === 'payment.captured') {

            $payment->update([
                'payment_status' => 'success',
                'paid_at'        => now(),
                'system_remark'  => 'Confirmed via Razorpay webhook',
            ]);

            // 🔔 Trigger business logic
            $this->handleBusinessSuccess($payment);

        } elseif ($event['event'] === 'payment.failed') {

            $payment->update([
                'payment_status' => 'failed',
                'system_remark'  => 'Payment failed via Razorpay webhook',
            ]);
        }

        return response()->json(['status' => 'success']);
    }

    protected function handleBusinessSuccess(OnlinePayment $payment)
    {
        // Example:
        // $payable = $payment->payable;
        // $payable->markAsPaid();

        // Keep this decoupled per module
    }
}

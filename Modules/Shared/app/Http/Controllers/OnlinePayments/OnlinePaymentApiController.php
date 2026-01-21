<?php

namespace Modules\Shared\Http\Controllers\OnlinePayments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Modules\Shared\Models\OnlinePayments\OnlinePayment;
use Modules\Shared\Models\OnlinePayments\PaymentPayable;
use Modules\Shared\Services\OnlinePayments\PayableResolver;
use Modules\Shared\Services\OnlinePayments\RazorpayService;

class OnlinePaymentApiController extends Controller
{
    protected function model() {
        return OnlinePayment::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }

    /**
     * Read-only: frontend can poll payment status
     */
    public function show(int $id)
    {
        $payment = OnlinePayment::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => [
                'id'       => $payment->id,
                'status'   => $payment->status,
                'amount'   => $payment->amount,
                'currency' => $payment->currency,
                'paid_at'  => $payment->paid_at,
				'key'      => config('services.razorpay.key'),
            ]
        ]);
    }

    /**
     * Razorpay webhook (ONLY source of truth)
     */
    public function razorpayWebhook(
        Request $request,
        RazorpayService $razorpay
    ) {
        // 1️⃣ Verify signature (CRITICAL)
        $razorpay->verifyWebhookSignature(
		    $request->getContent(), // raw body
    		$request->header('X-Razorpay-Signature')
		);

        $event = $request->input('event');
        $payload = $request->input('payload.payment.entity');

        if (! $payload) {
            return response()->json(['status' => 'ignored']);
        }

        $gatewayPaymentId = $payload['id'];
        $gatewayOrderId   = $payload['order_id'];
        $status           = $payload['status'];

        // 2️⃣ Find payment
        $payment = OnlinePayment::where('gateway_order_id', $gatewayOrderId)->first();

        if (! $payment) {
            logger()->warning('Payment not found for gateway order', [
                'order_id' => $gatewayOrderId
            ]);
            return response()->json(['status' => 'ignored']);
        }

        // 3️⃣ Idempotency guard
        if (in_array($payment->status, ['success', 'failed'])) {
            return response()->json(['status' => 'ok']);
        }

        DB::transaction(function () use ($payment, $status, $gatewayPaymentId) {

            // 4️⃣ Update payment record
            if ($status === 'captured') {
                $payment->update([
                    'status'             => 'success',
                    'gateway_payment_id' => $gatewayPaymentId,
                    'paid_at'            => now(),
                ]);
            } elseif ($status === 'failed') {
                $payment->update([
                    'status'             => 'failed',
                    'gateway_payment_id' => $gatewayPaymentId,
                ]);
            }

            // 5️⃣ Finalize payable ONLY if success
            if ($payment->status === 'success') {
                $this->finalize($payment);
            }
        });

        return response()->json(['status' => 'ok']);
    }

	public function complete(Request $request, $id)
	{
    	$request->validate([
        	'gateway_payment_id' => 'required|string',
    	]);

	    $payment = OnlinePayment::findOrFail($id);

	    // Idempotent
    	if (in_array($payment->payment_status, ['processing', 'success'])) {
        	return response()->json([
            	'status'  => 'success',
            	'message' => 'Payment already being processed',
	        ]);
    	}

	    // 1️⃣ Save reference & mark processing
    	$payment->update([
        	'gateway_payment_id' => $request->gateway_payment_id,
	        'payment_status'     => 'processing',
    	    'system_remark'      => 'Received payment_id from frontend',
    	]);

		// 2️⃣ Link payable snapshot to this payment (IMPORTANT)
	    if ($payment->payable && !$payment->payable->online_payment_id) {
			PaymentPayable::where('id', $payment->payment_payable_id)
			    ->whereNull('online_payment_id')
			    ->update(['online_payment_id' => $payment->id]);
    	}

		// 3️⃣ Try immediate capture (Razorpay specific)
	    try {
    	    $razorpay = new \Razorpay\Api\Api(
        	    config('services.razorpay.key'),
            	config('services.razorpay.secret')
	        );

	        // 2️⃣ Fetch payment
    	    $rzpPayment = $razorpay->payment->fetch($request->gateway_payment_id);

	        // 3️⃣ Try manual capture ONCE (only if authorized)
    	    if ($rzpPayment->status === 'authorized') {
        	    $razorpay->payment
            	    ->fetch($request->gateway_payment_id)
                	->capture([
                    	'amount' => (int) ($payment->amount * 100),
                	]);
        	}

	        // 4️⃣ Short delay (2 seconds)
    	    sleep(2);

	        // 5️⃣ Re-fetch status
    	    $rzpPayment = $razorpay->payment->fetch($request->gateway_payment_id);

	        // 6️⃣ If captured → mark success
    	    if ($rzpPayment->status === 'captured') {
        	    $payment->update([
            	    'payment_status' => 'success',
                	'paid_at'        => now(),
                	'system_remark'  => 'Captured after short delay',
	            ]);
    	    }

	    } catch (\Exception $e) {
        	// ❗ Do not fail — webhook will handle it
    	    logger()->info('Capture delayed or deferred', [
        	    'payment_id' => $payment->id,
            	'error'      => $e->getMessage(),
        	]);
    	}

		// ⚠️ ONLY FOR LOCAL TESTING
	    if (app()->environment('local', 'testing')) {
    	    app(self::class)->finalize($payment);
    	}

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Payment received. Confirmation in progress.',
    	]);
	}

    /**
     * Finalize payable (business logic)
     */
    public function finalize(OnlinePayment $payment)
    {
        $payable = PaymentPayable::with('payable')->findOrFail(
            $payment->payment_payable_id
        );

        // Idempotent
        if ($payable->status === 'paid') {
            return;
        }

        $model = $payable->payable;

        if (! $model) {
            throw new \Exception('Payable model missing');
        }

        // Execute domain logic
        $model->markAsPaid($payable);

        // Update source of truth
        $payable->update([
            'status'      => 'paid',
            'resolved_at' => now(),
        ]);
    }
}

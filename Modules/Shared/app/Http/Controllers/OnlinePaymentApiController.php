<?php

namespace Modules\Shared\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Shared\Models\OnlinePayment;
use Modules\Shared\Services\OnlinePayments\RazorpayService;
use Modules\Shared\Services\OnlinePayments\PayableResolver;
use Illuminate\Http\Response;

class OnlinePaymentApiController extends SharedApiController
{

	protected function model() {
		return OnlinePayment::class;
	}
    protected function validationRules($id = null)
    {
        return [];
    }

    public function initiate(
        Request $request,
        PayableResolver $resolver,
        RazorpayService $razorpay
    ) {
        // 1️⃣ Resolve payable safely
        $payable = $resolver->resolve(
            $request->payable_type,
            $request->payable_id
        );

        // 2️⃣ Check payable state (optional but recommended)
        if (method_exists($payable, 'isPayable') && ! $payable->isPayable()) {
            abort(400, 'This item is not payable');
        }

        // 3️⃣ Determine payable amount (CORE FIX)
        $amount = $this->determineAmount($payable);

        if ($amount <= 0) {
            abort(400, 'Invalid payable amount');
        }

        // 4️⃣ Create online payment record
        $payment = OnlinePayment::create([
            'payable_type'    => $request->payable_type,
            'payable_id'      => $request->payable_id,
            'amount'          => $amount,
            'currency'        => 'INR',
            'payment_gateway' => 'razorpay',
            'payment_method'  => $request->payment_method,
            'payment_status'  => 'initiated',
            'entry_source'    => 'web',
        ]);

        // 5️⃣ Create Razorpay order (SERVER-SIDE)
        $order = $razorpay->createOrder(
            $payment->amount,
            'pay_' . $payment->id
        );

        // 6️⃣ Update payment with gateway order id
        $payment->update([
            'gateway_order_id' => $order['id'],
            'payment_status'   => 'pending',
        ]);

        // 7️⃣ Return checkout data
		return response()->json([
    	    'status'  => 'success',
        	'message' => 'Payment Initiated successfully.',
	        'data'    => [
                'payment_id'        => $payment->id,
                'gateway_order_id' => $order['id'],
                'amount'            => (int) ($payment->amount * 100),
                'currency'          => 'INR',
                'key'               => config('services.razorpay.key'),
            ],
        ], Response::HTTP_OK);
    }

    /**
     * Determine amount based on payable type & rules
     */
    protected function determineAmount($payable): float
    {

        // Registration
        if ($payable instanceof \Modules\Registration\Models\Registration) {
            return $payable->registration_fee;
        }

        // Default (safety)
        abort(400, 'Unsupported payable type');
    }

	public function show($id)
	{
    	$payment = OnlinePayment::findOrFail($id);

	    // Safety: only allow pending payments
    	/*if (! in_array($payment->payment_status, ['initiated', 'pending'])) {
        	return response()->json([
            	'status'  => 'error',
	            'message' => 'Payment is not payable',
    	    ], Response::HTTP_BAD_REQUEST);
    	}*/

	    // Safety: ensure gateway order exists
    	if (! $payment->gateway_order_id) {
        	return response()->json([
            	'status'  => 'error',
            	'message' => 'Payment gateway order not found',
	        ], Response::HTTP_BAD_REQUEST);
    	}

	    return response()->json([
    	    'status' => 'success',
        	'data'   => [
            	'payment_id'        => $payment->id,
	            'gateway_order_id' => $payment->gateway_order_id,
    	        'amount'            => (int) ($payment->amount * 100), // paise
        	    'currency'          => $payment->currency,
            	'key'               => config('services.razorpay.key'),
        	],
	    ], Response::HTTP_OK);
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

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Payment received. Confirmation in progress.',
    	]);
	}

}

<?php

namespace Modules\Shared\Http\Controllers\OnlinePayments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Shared\Models\OnlinePayments\PaymentPayable;
use Modules\Shared\Models\OnlinePayments\OnlinePayment;
use Modules\Shared\Services\OnlinePayments\PayableResolver;
use Modules\Shared\Services\OnlinePayments\PaymentGatewayService;
use Modules\Admin\Services\Tenants\TenantPaymentService;
use Modules\Shared\Services\OnlinePayments\PreviewFormatter;

class PaymentPayableApiController extends Controller
{
    /**
     * Resolve a payable entity and preview payment details.
     */
    public function resolve(Request $request, PayableResolver $resolver)
    {
        $data = $request->validate([
            'payable_type' => 'required|string',
            'payable_id'   => 'required|integer',
            'charge_type'  => 'nullable|string',
        ]);

        $model = $resolver->resolve($data['payable_type'], $data['payable_id']);
        $chargeType = $data['charge_type'] ?? null;

        return response()->json([
            'status' => 'success',
            'data' => [
                'type'    => class_basename($model),
                'id'      => $model->id,
                'amount'  => $model->payableAmount($chargeType),
                'purpose' => $model->payablePurpose($chargeType),
                'meta'    => $model->payableSnapshot($chargeType),
            ],
        ]);
    }

    /**
     * Preview billing details (UI only).
     */
    public function preview(Request $request, PayableResolver $resolver)
    {
        $data = $request->validate([
            'payable_type' => 'required|string',
            'payable_id'   => 'required|integer',
            'charge_type'  => 'required|string',
        ]);

        $model = $resolver->resolve($data['payable_type'], $data['payable_id']);

        return response()->json([
            'status' => 'success',
            'data' => app(TenantPaymentService::class)->preview($model, $data['charge_type']),
        ]);
    }

    /**
     * Checkout = create payable + payment + gateway order (atomic).
     */
    public function checkout(Request $request, PayableResolver $resolver)
    {
        $data = $request->validate([
            'payable_type' => 'required|string',
            'payable_id'   => 'required|integer',
            'charge_type'  => 'nullable|string',
        ]);

        return DB::transaction(function () use ($data, $resolver) {

            // 1️⃣ Resolve payable entity
            $model = $resolver->resolve($data['payable_type'], $data['payable_id']);
            $chargeType = $data['charge_type'] ?? null;

            // 2️⃣ Cancel previous pending payables
            PaymentPayable::where('payable_type', get_class($model))
                ->where('payable_id', $model->id)
                ->where('charge_type', $chargeType)
                ->where('status', 'pending')
                ->update(['status' => 'cancelled']);

            // 3️⃣ Create payable (frozen snapshot)
            $payable = PaymentPayable::create([
                'payable_type' => get_class($model),
                'payable_id'   => $model->id,
                'tenant_id'    => tenant('id'),
                'charge_type'  => $chargeType,
                'amount'       => $model->payableAmount($chargeType),
                'currency'     => 'INR',
                'purpose'      => $model->payablePurpose($chargeType),
                'meta'         => $model->payableSnapshot($chargeType),
                'expires_at'   => now()->addMinutes(15),
            ]);

            // 4️⃣ Create online payment attempt
            $payment = OnlinePayment::create([
                'payment_payable_id' => $payable->id,
				'payable_type' 		=> get_class($model),
                'payable_id'   		=> $model->id,
                'tenant_id'          => tenant('id'),
                'amount'             => $payable->amount,
                'currency'           => $payable->currency,
                'payment_status'     => 'initiated',
                'payment_method'     => 'upi',
				'payment_gateway'    => 'razorpay',
            ]);

            // 5️⃣ Initialize gateway (backend only)
            $gatewayPayload = app(PaymentGatewayService::class)
                ->createOrder($payment);

            // 6️⃣ Save gateway data
            $payment->update([
                'gateway'          => $gatewayPayload['gateway'],
                'gateway_order_id' => $gatewayPayload['order_id'],
                'gateway_payload'  => $gatewayPayload,
            ]);

            return response()->json([
                'status' => 'success',
                'data' => [
                    'payable_id' => $payable->id,
                    'payment_id' => $payment->id,
                    'amount'     => $payable->amount,
                    'currency'   => $payable->currency
                ],
            ]);
        });
    }

	/**
     * Fetch frozen payable snapshot by online payment id
     * Used for:
     * - receipt page
     * - invoice download
     * - email receipt
     * - audit logs
     */
    public function showByPayment(OnlinePayment $payment)
    {
        // 1️⃣ Fetch payable snapshot (simple & safe)
        $payable = PaymentPayable::where('online_payment_id', $payment->id)->firstOrFail();

        // 2️⃣ Extract stored meta (snapshot from checkout)
        $meta = $payable->meta ?? [];

        // 3️⃣ Build formatter input (same contract as preview)
        $data = [
            'preview' => [], // explicitly empty for receipt

            'charge_type'     => $payable->charge_type,

            'reference_type'  => $payable->payable_type,
            'reference_id'    => $payable->payable_id,

            'items'           => $meta['items'] ?? [],

            'period_start'    => $meta['period']['start'] ?? null,
            'period_end'      => $meta['period']['end'] ?? null,

            'subtotal'        => $meta['breakdown']['subtotal'] ?? $payable->amount,
            'discount'        => $meta['breakdown']['discount'] ?? 0,
            'tax'             => $meta['breakdown']['tax'] ?? 0,
            'total'           => $meta['breakdown']['total'] ?? $payable->amount,

            'currency'        => $payable->currency,

            'can_pay'         => false, // IMPORTANT: receipt is not payable
            'reason'          => null,
        ];

        // 4️⃣ Return raw record + preview format
        return response()->json([
            'status' => 'success',
            'data' => [
                'record'  => $payable,                       // raw DB snapshot
                'preview' => PreviewFormatter::make($data),  // UI-friendly
            ],
        ]);
    }

}

<?php

namespace Modules\Shared\Http\Controllers\OnlinePayments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Shared\Models\OnlinePayments\PaymentPayable;
use Modules\Shared\Services\OnlinePayments\PayableResolver;
use Modules\Admin\Services\TenantPaymentService;

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

        $model = $resolver->resolve(
            $data['payable_type'],
            $data['payable_id']
        );

        $chargeType = $data['charge_type'] ?? null;

        return response()->json([
            'status' => 'success',
            'data'   => [
                'type'        => class_basename($model),
                'id'          => $model->id,
                'charge_type' => $chargeType,
                'amount'      => $model->payableAmount($chargeType),
                'purpose'     => $model->payablePurpose($chargeType),
                'meta'        => $model->payableSnapshot($chargeType),
            ],
        ]);
    }

    /**
     * Create a PaymentPayable (frozen payment intent).
     */
    public function checkout(Request $request, PayableResolver $resolver)
    {
        $data = $request->validate([
            'payable_type' => 'required|string',
            'payable_id'   => 'required|integer',
            'charge_type'  => 'nullable|string',
        ]);

        // 1️⃣ Resolve payable safely
        $model = $resolver->resolve(
            $data['payable_type'],
            $data['payable_id']
        );

        $chargeType = $data['charge_type'] ?? null;

        // 2️⃣ Cancel previous pending payables for same entity + charge type
        PaymentPayable::where('payable_type', get_class($model))
            ->where('payable_id', $model->id)
            ->where('charge_type', $chargeType)
            ->where('status', 'pending')
            ->update(['status' => 'cancelled']);

        // 3️⃣ Create payable snapshot (payment intent)
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

        return response()->json([
            'status' => 'success',
            'data'   => [
                'payment_payable_id' => $payable->id,
                'amount'             => $payable->amount,
                'charge_type'        => $chargeType,
            ],
        ]);
    }

	/**
     * Preview billing details (dates, modules, amount).
     * DOES NOT create any DB record.
     */
    public function preview(Request $request, PayableResolver $resolver)
    {
        $data = $request->validate([
            'payable_type' => 'required|string',
            'payable_id'   => 'required|integer',
            'charge_type'  => 'required|string',
        ]);

        $model = $resolver->resolve(
            $data['payable_type'],
            $data['payable_id']
        );

        // Currently tenant-only, future-proofed
        $preview = app(TenantPaymentService::class)
            ->preview($model, $data['charge_type']);

        return response()->json([
            'status' => 'success',
            'data'   => $preview,
        ]);
    }

}

<?php

namespace Modules\Student\Models\Traits;

use Modules\Shared\Models\OnlinePayments\PaymentPayable;
use Modules\Student\Services\StudentFeePaymentService;
use Modules\Student\Enums\StudentChargeType;

/* =====================================================
 | Payable Interface Implementation
 |=====================================================*/

trait StudentPayable
{
    /**
     * Determine the amount payable for student.
     *
     * Called during checkout to calculate the final
     * amount to be charged.
     */
    public function payableAmount(string $chargeType): float
    {
        return app(StudentFeePaymentService::class)
            ->calculateAmount($this, StudentChargeType::from($chargeType));
    }

    /**
     * Provide a human-readable purpose for the payment.
     *
     * Used in:
     * - Payment records
     * - Gateway order notes
     * - Invoices and receipts
     * - Admin dashboards
     */
    public function payablePurpose(string $chargeType): string
    {
        return 'Student Fee Payment';
    }

    /**
     * Provide a snapshot of student-related data
     * at the time of checkout.
     *
     * Stored permanently with payment record
     * to preserve historical accuracy.
     *
     * @return array<string, mixed>
     */
    public function payableSnapshot(string $chargeType): array
    {
        return app(StudentFeePaymentService::class)
            ->snapshot($this, StudentChargeType::from($chargeType));
    }

    /**
     * Execute business logic after successful payment.
     *
     * Called ONLY after payment confirmation.
     *
     * IMPORTANT:
     * Must be idempotent.
     */
    public function markAsPaid(PaymentPayable $payment): void
    {
        app(StudentFeePaymentService::class)->finalize($this, $payment);
    }

    /* =====================================================
     | Payment Finalize
     |=====================================================*/

    /**
     * Finalize payment at model level.
     *
     * Kept for symmetry with other payable models.
     */
    public function finalizePayment(PaymentPayable $payable): void
    {
        match ($payable->charge_type) {
            StudentChargeType::FEE->value => $this->markStudentFeePaid($payable),
            default => throw new \InvalidArgumentException('Invalid finalization type'),
        };
    }

    /**
     * Mark student fee as paid.
     *
     * Actual logic will be implemented later.
     */
    protected function markStudentFeePaid(PaymentPayable $payable): void
    {
        // to be implemented
    }
}

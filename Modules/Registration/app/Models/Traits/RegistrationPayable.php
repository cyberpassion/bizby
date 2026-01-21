<?php

namespace Modules\Registration\Models\Traits;

use Modules\Shared\Models\OnlinePayments\PaymentPayable;
use Modules\Registration\Services\RegistrationPaymentService;
use Modules\Registration\Enums\RegistrationChargeType;

/* =====================================================
 | Payable Interface Implementation
 |=====================================================*/

trait RegistrationPayable
{
    /**
     * Determine the amount payable for registration.
     *
     * Called during checkout to calculate the final
     * amount to be charged.
     */
    public function payableAmount(string $chargeType): float
    {
        return app(RegistrationPaymentService::class)
            ->calculateAmount($this->fee_option_key);
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
        return 'Student Registration Fee';
    }

    /**
     * Provide a snapshot of registration data
     * at the time of checkout.
     *
     * Stored with payment record to preserve
     * historical accuracy.
     *
     * @return array<string, mixed>
     */
    public function payableSnapshot(string $chargeType): array
    {
        return app(RegistrationPaymentService::class)
            ->snapshot($this->fee_option_key, $chargeType);
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
        app(RegistrationPaymentService::class)->finalize($payment);
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
            RegistrationChargeType::FEE->value => $this->markRegistrationPaid(),
            default => throw new \InvalidArgumentException('Invalid finalization type'),
        };
    }

    /**
     * Mark registration as paid.
     *
     * Actual logic to be implemented later.
     */
    protected function markRegistrationPaid(): void
    {
        // to be implemented
    }
}

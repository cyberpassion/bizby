<?php

namespace Modules\Shared\Contracts\OnlinePayments;

use Modules\Shared\Models\OnlinePayments\PaymentPayable;

/**
 * Interface Payable
 *
 * Implemented by any model that can participate
 * in the payment system (tenant, student, registration, etc.).
 *
 * The payment engine interacts ONLY with this interface.
 */
interface Payable
{
    /**
     * Get the payable amount for a specific charge type.
     *
     * Called during checkout to determine how much
     * money should be charged.
     *
     * Examples of $chargeType:
     * - onboarding
     * - renewal
     * - addon
     * - fee
     * - penalty
     *
     * IMPORTANT:
     * - Must return the FINAL amount.
     * - Must NOT trust frontend-provided amounts.
     *
     * @param string|null $chargeType
     * @return float
     */
    public function payableAmount(string $chargeType): float;

    /**
     * Get a human-readable purpose for the payment.
     *
     * Used for:
     * - Payment descriptions
     * - Invoices / receipts
     * - Admin UI
     * - Logs
     *
     * @param string|null $chargeType
     * @return string
     */
    public function payablePurpose(string $chargeType): string;

    /**
     * Get a snapshot of important data related to this payment.
     *
     * Stored permanently with the payment record to ensure
     * historical accuracy even if underlying data changes later.
     *
     * Examples:
     * - Plan name
     * - Module list
     * - Semester / year
     * - Fee breakup
     *
     * @param string|null $chargeType
     * @return array<string, mixed>
     */
    public function payableSnapshot(string $chargeType): array;

    /**
     * Execute business logic after successful payment.
     *
     * Called ONLY after payment confirmation
     * (gateway + webhook verified).
     *
     * Examples:
     * - Activate tenant
     * - Mark fee as paid
     * - Apply penalty clearance
     * - Unlock modules
     *
     * IMPORTANT:
     * - Must be idempotent.
     * - Should not throw unhandled exceptions.
     *
     * @param PaymentPayable $payment
     * @return void
     */
    public function markAsPaid(PaymentPayable $payment): void;
}

<?php

namespace Modules\Registration\Services;

use InvalidArgumentException;
use Modules\Shared\Models\OnlinePayments\PaymentPayable;
use Modules\Registration\Enums\RegistrationChargeType;
use Modules\Shared\Models\Option;

/**
 * Class RegistrationPaymentService
 *
 * Handles registration fee payments.
 * Amount is fetched from central options table.
 */
class RegistrationPaymentService
{
    /**
     * Calculate payable amount using option key.
     *
     * @param string $optionKey
     * @return float
     */
    public function calculateAmount(string $optionKey): float
    {
        $amount = Option::getValue($optionKey);

        if ($amount === null) {
            throw new InvalidArgumentException("Invalid registration fee key: {$optionKey}");
        }

        return (float) $amount;
    }

    /**
     * Create payment snapshot.
     *
     * Stored permanently with PaymentPayable
     * for historical accuracy.
     *
     * @param string $optionKey
     * @param string $chargeType
     * @return array<string, mixed>
     */
    public function snapshot(string $optionKey, string $chargeType): array
    {
        $amount = $this->calculateAmount($optionKey);

        return [
            'charge_type' => $chargeType,
            'option_key'  => $optionKey,
            'amount'      => $amount,
            'currency'    => 'INR',
            'total'       => $amount,
        ];
    }

    /**
     * Finalize registration payment.
     *
     * Called ONLY after payment confirmation.
     *
     * @param PaymentPayable $payment
     * @return void
     */
    public function finalize(PaymentPayable $payment): void
    {
        // Nothing complex yet, but hook exists for future
        // (ex: mark registration paid, unlock form, etc.)
    }

    /**
     * Preview registration payment.
     *
     * @param string $optionKey
     * @return array<string, mixed>
     */
    public function preview(string $optionKey): array
    {
        $amount = $this->calculateAmount($optionKey);

        return [
            'charge_type' => RegistrationChargeType::FEE->value,
            'option_key'  => $optionKey,
            'amount'      => $amount,
            'currency'    => 'INR',
        ];
    }
}

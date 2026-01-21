<?php

namespace Modules\Student\Services;

use Modules\Student\Enums\StudentChargeType;
use Modules\Student\Models\Student;
use Modules\Shared\Models\OnlinePayments\PaymentPayable;
use InvalidArgumentException;

/**
 * Class StudentPaymentService
 *
 * Handles all student fee payments.
 * Logic is decided internally using charge type.
 */
class StudentFeePaymentService
{
    /**
     * Calculate payable amount for student fee.
     */
    public function calculateAmount(
        Student $student,
        StudentChargeType $chargeType
    ): float {
        return match ($chargeType) {
            default => 0.0,
        };
    }

    /**
     * Create snapshot of student fee payment.
     */
    public function snapshot(
        Student $student,
        StudentChargeType $chargeType
    ): array {
        return match ($chargeType) {
            default => [],
        };
    }

    /**
     * Preview student fee before payment.
     */
    public function preview(
        Student $student,
        StudentChargeType $chargeType
    ): array {
        return [
            'student_id'  => $student->id,
            'charge_type' => $chargeType->value,
            'amount'      => $this->calculateAmount($student, $chargeType),
            'currency'    => 'INR',
        ];
    }

    /**
     * Execute business logic after successful payment.
     */
    public function finalize(
        Student $student,
        PaymentPayable $payment
    ): void {
        match ($payment->charge_type) {
            default => null,
        };
    }
}

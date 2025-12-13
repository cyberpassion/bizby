<?php

namespace Modules\Student\Services;

use Modules\Student\Models\StudentFee;
use Modules\Student\Models\StudentFeeTransaction;
use Modules\Student\Models\StudentFeeTransactionItem;

class FeeCalculationService
{
    /**
     * Allocate a payment transaction to outstanding dues
     */
    public function allocatePayment(StudentFeeTransaction $transaction)
    {
        $studentId = $transaction->student_id;
        $amount = $transaction->amount;

        // Get active unpaid fees for student
        $fees = StudentFee::where('student_id', $studentId)
            ->where('is_active', true)
            ->whereRaw('payable - concession > (SELECT COALESCE(SUM(amount_paid),0) FROM student_fee_transaction_items WHERE student_fee_id = student_fees.id)')
            ->orderBy('period_code')
            ->get();

        foreach ($fees as $fee) {
            $paidAlready = $fee->transactions()->sum('amount_paid');
            $due = ($fee->payable - $fee->concession) - $paidAlready;

            if ($due <= 0) continue;

            $allocate = min($amount, $due);

            StudentFeeTransactionItem::create([
                'transaction_id' => $transaction->id,
                'student_fee_id' => $fee->id,
                'amount_paid' => $allocate,
            ]);

            $amount -= $allocate;
            if ($amount <= 0) break;
        }
    }

    /**
     * Calculate student dues
     */
    public function calculateDues($studentId)
    {
        $fees = StudentFee::where('student_id', $studentId)
            ->where('is_active', true)
            ->withSum('transactions as paid_amount', 'amount_paid')
            ->get();

        $dues = [];
        foreach ($fees as $fee) {
            $dues[] = [
                'fee_id' => $fee->id,
                'fee_head_id' => $fee->fee_head_id,
                'period' => $fee->period_label,
                'payable' => $fee->payable,
                'concession' => $fee->concession,
                'paid' => $fee->paid_amount ?? 0,
                'balance' => max($fee->payable - $fee->concession - ($fee->paid_amount ?? 0), 0)
            ];
        }
        return $dues;
    }
}

<?php

namespace App\Services;

use App\Models\StudentFee;
use App\Models\FeeTransactionItem;
use App\Models\FeeTransaction;

class FeeCalculationService
{
    public function allocatePayment(FeeTransaction $transaction)
    {
        $remaining = $transaction->amount;

        // Get dues (oldest first)
        $dues = StudentFee::where('student_id', $transaction->student_id)
            ->orderBy('period_code')
            ->get();

        foreach ($dues as $fee) {

            $balance = $fee->balance; // auto-calculated accessor

            if ($balance <= 0) {
                continue; // already fully paid
            }

            if ($remaining <= 0) break;

            $pay = min($remaining, $balance);

            FeeTransactionItem::create([
                'transaction_id' => $transaction->id,
                'student_fee_id' => $fee->id,
                'amount_paid' => $pay,
            ]);

            $remaining -= $pay;
        }

        return true;
    }
}

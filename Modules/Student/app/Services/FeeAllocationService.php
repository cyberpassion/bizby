<?php

namespace Modules\Student\Services;

use Illuminate\Support\Facades\DB;
use Modules\Student\Models\StudentFee;
use Modules\Student\Models\StudentFeeTransactionItem;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class FeeAllocationService
 *
 * Responsible for allocating a StudentFeeTransaction.amount across outstanding student_fees.
 * Uses DB transactions and row locking to avoid race conditions.
 */
class FeeAllocationService
{
    /**
     * Allocate amount from a StudentFeeTransaction to outstanding fees (FIFO by period_code).
     *
     * IMPORTANT: This method expects to be called inside a DB::transaction() in the controller.
     * If you call it outside, it will start its own transaction for safety.
     *
     * @param \Modules\Student\Models\StudentFeeTransaction $transaction
     * @return void
     */
    public function allocate($transaction): void
    {
        // ensure $transaction is fresh
        $transaction->refresh();

        $studentId = $transaction->student_id;
        $amountToAllocate = (float) $transaction->amount;

        // if called outside a transaction, run in transaction and lock rows
        $outerTransaction = DB::transactionLevel() > 0;

        if (! $outerTransaction) {
            DB::transaction(function () use ($transaction, $studentId, &$amountToAllocate) {
                $this->doAllocate($transaction, $studentId, $amountToAllocate);
            }, 5);
        } else {
            $this->doAllocate($transaction, $studentId, $amountToAllocate);
        }
    }

    /**
     * Internal allocation logic. Locks student_fees rows for update to avoid double allocation.
     *
     * @param $transaction
     * @param int $studentId
     * @param float $amountToAllocate
     * @return void
     */
    protected function doAllocate($transaction, int $studentId, float &$amountToAllocate): void
    {
        // load outstanding fees and lock them for update
        /** @var Collection $fees */
        $fees = StudentFee::where('student_id', $studentId)
            ->where('is_active', true)
            ->orderBy('period_code') // FIFO oldest period_code first
            ->lockForUpdate()
            ->get();

        // eager load sum of paid amounts via relationship if defined; else calculate
        foreach ($fees as $fee) {
            // compute already paid for this fee (sum of related transaction items)
            $paid = $fee->items()->sum('amount_paid') ?? 0.0;

            // concession (if present)
            $concession = isset($fee->concession) ? (float)$fee->concession : 0.0;

            // effective payable
            $effectivePayable = max((float)$fee->payable - $concession, 0.0);

            $remaining = max($effectivePayable - $paid, 0.0);

            if ($remaining <= 0) {
                continue;
            }

            if ($amountToAllocate <= 0) {
                break;
            }

            // allocate
            $allocate = min($remaining, $amountToAllocate);

            // create transaction item
            StudentFeeTransactionItem::create([
                'transaction_id' => $transaction->id,
                'student_fee_id' => $fee->id,
                'amount_paid' => $allocate,
            ]);

            $amountToAllocate -= $allocate;
        }

        // If leftover amountToAllocate > 0, you can either:
        // - leave it as unallocated (stored in transaction.amount)
        // - or create an advance/credit record. (Not implemented by default.)
    }
}

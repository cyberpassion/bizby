<?php

namespace Modules\Student\Services;

use Illuminate\Support\Facades\DB;

use Modules\Student\Models\StudentFeeDue;
use Modules\Student\Models\StudentFeeSubmission;

class CancelStudentFeeReceiptService
{
    public function handle($submissionId)
    {
        return DB::transaction(function () use (
            $submissionId
        ) {

            /*
            |--------------------------------------------------------------------------
            | Find Submission
            |--------------------------------------------------------------------------
            */

            $submission = StudentFeeSubmission::query()
                ->with([
                    'items.due',
                ])
                ->findOrFail($submissionId);

            /*
            |--------------------------------------------------------------------------
            | Already Cancelled
            |--------------------------------------------------------------------------
            */

            if (
                $submission->submission_status
                === 'cancelled'
            ) {

                throw new \Exception(
                    'Receipt already cancelled.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Reverse Dues
            |--------------------------------------------------------------------------
            */

            foreach (
                $submission->items
                as $item
            ) {

				/*
			    |--------------------------------------------------------------------------
			    | Lock Due
    			|--------------------------------------------------------------------------
			    */

			    $due = StudentFeeDue::query()

			        ->where('id', $item->due_id)

			        ->lockForUpdate()

			        ->first();

                $due = $item->due;

                if (! $due) {
                    continue;
                }

                $newPaid =
                    max(
                        0,
                        $due->paid_amount
                        - $item->paid_amount
                    );

                $newBalance =
                    $due->amount -
                    $newPaid;

                $due->update([

                    'paid_amount' =>
                        $newPaid,

                    'balance_amount' =>
                        $newBalance,

                    'dues_status' =>
                        $newBalance <= 0
                            ? 'paid'
                            : (
                                $newPaid > 0
                                    ? 'partial'
                                    : 'unpaid'
                            ),
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Cancel Submission
            |--------------------------------------------------------------------------
            */

            $submission->update([

                'submission_status' =>
                    'cancelled',

                'cancelled_at' => now(),

                'cancelled_by' =>
                    auth()->id(),

                'cancellation_reason' =>
                    'Manual cancellation',
            ]);

            return $submission;
        });
    }
}
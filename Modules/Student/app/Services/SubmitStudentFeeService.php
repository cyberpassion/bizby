<?php

namespace Modules\Student\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Modules\Student\Models\StudentFeeDue;
use Modules\Student\Models\StudentFeeSubmission;
use Modules\Student\Models\StudentFeeSubmissionItem;

class SubmitStudentFeeService
{
    public function handle($request, $studentId)
{
    return DB::transaction(function () use (
        $request,
        $studentId
    ) {

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        if (
            empty($request->items)
        ) {

            throw new \Exception(
                'No payment items provided.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Due IDs
        |--------------------------------------------------------------------------
        */

        $dueIds = collect(
            $request->items
        )

        ->pluck('due_id')

        ->toArray();

        /*
        |--------------------------------------------------------------------------
        | Lock Dues
        |--------------------------------------------------------------------------
        */

        $dues = StudentFeeDue::query()

            ->whereIn('id', $dueIds)

            ->lockForUpdate()

            ->get()

            ->keyBy('id');

        /*
        |--------------------------------------------------------------------------
        | Totals
        |--------------------------------------------------------------------------
        */

        $grossAmount = 0;

        /*
        |--------------------------------------------------------------------------
        | Validate Amounts
        |--------------------------------------------------------------------------
        */

        foreach ($request->items as $item) {

            $due = $dues[$item['due_id']]
                ?? null;

            if (! $due) {

                throw new \Exception(
                    'Invalid due selected.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Already Paid
            |--------------------------------------------------------------------------
            */

            if (
                $due->dues_status === 'paid'
            ) {

                throw new \Exception(
                    'Due already paid.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Invalid Amount
            |--------------------------------------------------------------------------
            */

            if (
                $item['amount'] <= 0
            ) {

                throw new \Exception(
                    'Invalid payment amount.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Over Payment Protection
            |--------------------------------------------------------------------------
            */

            if (
                $item['amount'] >
                $due->balance_amount
            ) {

                throw new \Exception(
                    'Payment exceeds due balance.'
                );
            }

            $grossAmount +=
                $item['amount'];
        }

        /*
        |--------------------------------------------------------------------------
        | Submission Totals
        |--------------------------------------------------------------------------
        */

        $discountAmount =
            $request->discount_amount ?? 0;

        $fineAmount =
            $request->fine_amount ?? 0;

        $paidAmount =
            ($grossAmount + $fineAmount)
            - $discountAmount;

		/*
		|--------------------------------------------------------------------------
		| Academic Info
		|--------------------------------------------------------------------------
		*/

		$firstDue = $dues->first();

		$classTermId =
		    $firstDue?->class_term_id;

		$sectionTermId =
		    $firstDue?->section_term_id;

        /*
        |--------------------------------------------------------------------------
        | Create Submission
        |--------------------------------------------------------------------------
        */

        $submission =
            StudentFeeSubmission::create([

                'student_id' =>
                    $studentId,

                'year_id' =>
                    $request->year_id,

				'class_term_id' =>
				    $classTermId,

				'section_term_id' =>
				    $sectionTermId,

                'receipt_no' =>
                    $this->generateReceiptNo(),

                'request_uuid' =>
                    Str::uuid(),

                'receipt_date' =>
                    now(),

                'gross_amount' =>
                    $grossAmount,

                'discount_amount' =>
                    $discountAmount,

                'fine_amount' =>
                    $fineAmount,

                'paid_amount' =>
                    $paidAmount,

                'payment_mode' =>
                    $request->payment_mode,

                'transaction_reference' =>
                    $request->transaction_reference,

                'remarks' =>
                    $request->remarks,

                'submitted_by' =>
                    auth()->id(),

                'submission_status' =>
                    'success',
            ]);

        /*
        |--------------------------------------------------------------------------
        | Create Items + Update Dues
        |--------------------------------------------------------------------------
        */

        foreach ($request->items as $item) {

            $due = $dues[$item['due_id']];

            $duePaidAmount =
                $item['amount'];

            /*
            |--------------------------------------------------------------------------
            | Create Submission Item
            |--------------------------------------------------------------------------
            */

            StudentFeeSubmissionItem::create([

                'submission_id' => $submission->id,
			    'due_id' => $due->id,

			    'gross_amount' => $due->amount,

			    'discount_amount' => 0,

			    'fine_amount' => 0,

			    'paid_amount' => $duePaidAmount,

			    'balance_amount' =>
			        $due->balance_amount - $duePaidAmount,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Update Due
            |--------------------------------------------------------------------------
            */

            $newPaidAmount =

                $due->paid_amount
                +
                $duePaidAmount;

            $newBalance =

                $due->balance_amount
                -
                $duePaidAmount;

            $due->update([

                'paid_amount' =>
                    $newPaidAmount,

                'balance_amount' =>
                    $newBalance,

                'dues_status' =>

                    $newBalance <= 0

                        ? 'paid'

                        : (

                            $newPaidAmount > 0

                                ? 'partial'

                                : 'unpaid'
                        ),
            ]);
        }

        return $submission;
    });
}

    /*
    |--------------------------------------------------------------------------
    | Generate Receipt Number
    |--------------------------------------------------------------------------
    */

    protected function generateReceiptNo(): string
    {
        $latest = StudentFeeSubmission::query()
            ->latest('id')
            ->first();

        $next = $latest
            ? $latest->id + 1
            : 1;

        return 'REC-' .
            str_pad($next, 6, '0', STR_PAD_LEFT);
    }
}
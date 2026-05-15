<?php

namespace Modules\Student\Services;

use Modules\Student\Models\Student;

use Modules\Student\Models\StudentFeeDue;

use Modules\Student\Models\StudentFeeDiscount;

class RefreshStudentFeeDuesService
{
    public function handle(
        int $studentId,
        int $yearId
    ): void {

        /*
        |--------------------------------------------------------------------------
        | Remove Existing Unpaid / Partial Dues
        |--------------------------------------------------------------------------
        |
        | Never touch:
        | - paid
        | - cancelled
        |
        */

        StudentFeeDue::query()

            ->where(
                'student_id',
                $studentId
            )

            ->where(
                'year_id',
                $yearId
            )

            ->whereIn(
                'dues_status',
                [
                    'unpaid',
                    'partial',
                ]
            )

            ->delete();

        /*
        |--------------------------------------------------------------------------
        | Student
        |--------------------------------------------------------------------------
        */

        $student =
            Student::find($studentId);

        if (! $student) {

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Regenerate Dues
        |--------------------------------------------------------------------------
        */

        app(
            GenerateStudentFeeDuesService::class
        )->handle($student);

        /*
        |--------------------------------------------------------------------------
        | Discounts
        |--------------------------------------------------------------------------
        */

        $discounts =
            StudentFeeDiscount::query()

                ->where(
                    'student_id',
                    $studentId
                )

                ->where(
                    'year_id',
                    $yearId
                )

                ->get();

        if ($discounts->isEmpty()) {

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Reload Fresh Dues
        |--------------------------------------------------------------------------
        */

        $dues =
            StudentFeeDue::query()

                ->with([
                    'patternPeriod',
                ])

                ->where(
                    'student_id',
                    $studentId
                )

                ->where(
                    'year_id',
                    $yearId
                )

                ->whereIn(
                    'dues_status',
                    [
                        'unpaid',
                        'partial',
                    ]
                )

                ->get();

        /*
        |--------------------------------------------------------------------------
        | Apply Discounts
        |--------------------------------------------------------------------------
        */

        foreach ($dues as $due) {

            $waiver = 0;

            foreach (
                $discounts
                as $discount
            ) {

                /*
                |--------------------------------------------------------------------------
                | Fee Head Filter
                |--------------------------------------------------------------------------
                */

                if (

                    $discount->head_term_id

                    &&

                    $discount->head_term_id
                    !=
                    $due->head_term_id
                ) {

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Period Scope
                |--------------------------------------------------------------------------
                */

                if (

                    ! empty(
                        $discount->applicable_period_keys
                    )

                    &&

                    $due->patternPeriod

                    &&

                    ! in_array(

                        $due->patternPeriod->key,

                        $discount->applicable_period_keys
                    )
                ) {

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Fixed Amount
                |--------------------------------------------------------------------------
                */

                if ($discount->amount) {

                    $waiver +=
                        $discount->amount;
                }

                /*
                |--------------------------------------------------------------------------
                | Percentage
                |--------------------------------------------------------------------------
                */

                if ($discount->percentage) {

                    $waiver +=

                        (
                            $due->amount
                            *
                            $discount->percentage
                        ) / 100;
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Prevent Over Discount
            |--------------------------------------------------------------------------
            */

            $waiver = min(
                $waiver,
                $due->amount
            );

            /*
            |--------------------------------------------------------------------------
            | Final Balance
            |--------------------------------------------------------------------------
            */

            $balance =

                $due->amount

                -

                $waiver

                -

                $due->paid_amount;

            /*
            |--------------------------------------------------------------------------
            | Update Due
            |--------------------------------------------------------------------------
            */

            $due->update([

                'waiver_amount' =>
                    round(
                        $waiver,
                        2
                    ),

                'balance_amount' =>
                    round(
                        max(0, $balance),
                        2
                    ),
            ]);
        }
    }
}
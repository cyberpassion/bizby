<?php

namespace Modules\Student\Services;

use Carbon\Carbon;

use Modules\Student\Models\StudentFeeDue;
use Modules\Student\Models\StudentFeeStructure;
use Modules\Student\Models\StudentFeeStructureOverride;
use Modules\Student\Models\StudentFeeDiscount;

class GenerateStudentFeeDuesService
{
    public function handle($student): void
    {
        /*
        |--------------------------------------------------------------------------
        | Academic Info
        |--------------------------------------------------------------------------
        */

        $academicYear = $student

            ->currentAcademicHistory()

            ->where('is_current', true)

            ->first();

        /*
        |--------------------------------------------------------------------------
        | No Academic History
        |--------------------------------------------------------------------------
        */

        if (! $academicYear) {

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Base Structures
        |--------------------------------------------------------------------------
        */

        $baseStructures =

            StudentFeeStructure::query()

                ->with([

                    'pattern.periods',

                    'headTerm',
                ])

                ->where(
                    'year_id',
                    $academicYear->year_id
                )

                ->where(
                    'class_term_id',
                    $academicYear->class_term_id
                )

                ->where(function ($query)
                    use ($academicYear) {

                    /*
                    |--------------------------------------------------------------------------
                    | Generic Structure
                    |--------------------------------------------------------------------------
                    */

                    $query->whereNull(
                        'section_term_id'
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | Section Specific Structure
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $academicYear->section_term_id
                    ) {

                        $query->orWhere(
                            'section_term_id',
                            $academicYear->section_term_id
                        );
                    }
                })

                ->get();

        /*
        |--------------------------------------------------------------------------
        | No Structure Found
        |--------------------------------------------------------------------------
        */

        if ($baseStructures->isEmpty()) {

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Student Overrides
        |--------------------------------------------------------------------------
        */

        $overrides =

            StudentFeeStructureOverride::query()

                ->with([

                    'pattern.periods',

                    'headTerm',
                ])

                ->where(
                    'student_id',
                    $student->id
                )

                ->where(
                    'year_id',
                    $academicYear->year_id
                )

                ->get()

                ->keyBy('head_term_id');

        /*
        |--------------------------------------------------------------------------
        | Effective Structures
        |--------------------------------------------------------------------------
        |
        | Override replaces base structure.
        |
        */

        $structures =

            $baseStructures->map(function ($structure)
                use ($overrides) {

                $override =

                    $overrides->get(
                        $structure->head_term_id
                    );

                /*
                |--------------------------------------------------------------------------
                | Use Override
                |--------------------------------------------------------------------------
                */

                if ($override) {

                    return (object) [

                        'id' =>
                            $structure->id,

                        'head_term_id' =>
                            $override->head_term_id,

                        'pattern_id' =>
                            $override->pattern_id,

                        'pattern' =>
                            $override->pattern,

                        'head' =>
                            $override->head,

                        'amount' =>
                            $override->amount,

                        'amount_type' =>
                            $override->amount_type,
                    ];
                }

                /*
                |--------------------------------------------------------------------------
                | Use Base Structure
                |--------------------------------------------------------------------------
                */

                return $structure;
            });

        /*
        |--------------------------------------------------------------------------
        | Generate Dues
        |--------------------------------------------------------------------------
        */

        foreach ($structures as $structure) {

            $periods =
                $structure->pattern?->periods
                ?? collect();

            /*
            |--------------------------------------------------------------------------
            | Skip Empty Pattern
            |--------------------------------------------------------------------------
            */

            if ($periods->isEmpty()) {

                continue;
            }

            foreach ($periods as $period) {

                /*
                |--------------------------------------------------------------------------
                | Skip Old Periods
                |--------------------------------------------------------------------------
                */

                if (
                    $period->start_date &&
                    $student->admission_date
                ) {

                    if (

                        Carbon::parse(
                            $period->start_date
                        )

                        ->lt(

                            Carbon::parse(
                                $student->admission_date
                            )
                        )

                    ) {

                        continue;
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | Amount Calculation
                |--------------------------------------------------------------------------
                */

                $amount =
                    (float) $structure->amount;

					/*
|--------------------------------------------------------------------------
| Discounts
|--------------------------------------------------------------------------
*/

$discounts =

    StudentFeeDiscount::query()

        ->where(
            'student_id',
            $student->id
        )

        ->where(
            'year_id',
            $academicYear->year_id
        )

        ->get();

/*
|--------------------------------------------------------------------------
| Waiver
|--------------------------------------------------------------------------
*/

$waiver = 0;

foreach ($discounts as $discount) {

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
        $structure->head_term_id
    ) {

        continue;
    }

    /*
    |--------------------------------------------------------------------------
    | Pattern Filter
    |--------------------------------------------------------------------------
    */

    if (

        $discount->pattern_id

        &&

        $discount->pattern_id
        !=
        $structure->pattern_id
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

        ! in_array(

            $period->key,

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
                $amount
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
    $amount
);

/*
|--------------------------------------------------------------------------
| Final Balance
|--------------------------------------------------------------------------
*/

$balanceAmount =

    $amount

    -

    $waiver;
                /*
                |--------------------------------------------------------------------------
                | Total Split
                |--------------------------------------------------------------------------
                */

                if (
                    $structure->amount_type
                    === 'total'
                ) {

                    $totalPeriods = max(
                        1,
                        $periods->count()
                    );

                    $amount =
                        $structure->amount
                        / $totalPeriods;
                }

                /*
                |--------------------------------------------------------------------------
                | Create / Update Due
                |--------------------------------------------------------------------------
                */

                StudentFeeDue::updateOrCreate(

                    [

                        'student_id' =>
                            $student->id,

                        'year_id' =>
                            $academicYear->year_id,

                        'head_term_id' =>
                            $structure->head_term_id,

                        'pattern_period_id' =>
                            $period->id,
                    ],

                    [

                        /*
                        |--------------------------------------------------------------------------
                        | Academic
                        |--------------------------------------------------------------------------
                        */

                        'class_term_id' =>
                            $academicYear->class_term_id,

                        'section_term_id' =>
                            $academicYear->section_term_id,

                        /*
                        |--------------------------------------------------------------------------
                        | Structure
                        |--------------------------------------------------------------------------
                        */

                        'structure_id' =>
                            $structure->id,

                        /*
                        |--------------------------------------------------------------------------
                        | Amounts
                        |--------------------------------------------------------------------------
                        */

                        'amount' =>
                            round($amount, 2),

                        'paid_amount' => 0,

                        'waiver_amount' =>
    round($waiver, 2),

                        'fine_amount' => 0,

                        'balance_amount' =>
    round($balanceAmount, 2),

                        /*
                        |--------------------------------------------------------------------------
                        | Status
                        |--------------------------------------------------------------------------
                        */

                        'dues_status' =>
                            'unpaid',

                        'due_date' =>
                            $period->due_date,

                        /*
                        |--------------------------------------------------------------------------
                        | Snapshots
                        |--------------------------------------------------------------------------
                        */

                        'head_name' =>
                            $structure->head?->name,

                        'pattern_name' =>
                            $structure->pattern?->name,

                        'period_name' =>
                            $period->label,

                        /*
                        |--------------------------------------------------------------------------
                        | Meta
                        |--------------------------------------------------------------------------
                        */

                        'generated_at' =>
                            now(),
                    ]
                );
            }
        }
    }
}
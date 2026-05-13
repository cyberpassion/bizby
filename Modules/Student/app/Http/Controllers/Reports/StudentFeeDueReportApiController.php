<?php

namespace Modules\Student\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Student\Models\Student;
use Modules\Student\Models\StudentFeeStructure;
use Modules\Student\Models\StudentFeeStructureOverride;
use Modules\Student\Models\StudentFeeDiscount;
use Modules\Student\Models\StudentFeeSubmissionItem;

class StudentFeeDueReportApiController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Filters
        |--------------------------------------------------------------------------
        */

        $yearId        = str_replace('tenant_','',$request->year_id);

        $classTermId   = str_replace('tenant_','',$request->class_term_id);

        $sectionTermId = str_replace('tenant_','',$request->section_term_id);

        $uptoPeriod    = $request->upto_period;

        $minDueAmount  = $request->min_due_amount;

        $maxDueAmount  = $request->max_due_amount;

        $studentSearch = $request->student_search;

        /*
        |--------------------------------------------------------------------------
        | Months
        |--------------------------------------------------------------------------
        */

        $months = [
            'apr',
            'may',
            'jun',
            'jul',
            'aug',
            'sep',
            'oct',
            'nov',
            'dec',
            'jan',
            'feb',
            'mar',
        ];

        /*
        |--------------------------------------------------------------------------
        | Allowed Periods
        |--------------------------------------------------------------------------
        |
        | Supports:
        |
        | apr       => April Only
        | till-apr  => Till April
        |
        */

        $allowedPeriods = [];

        if ($uptoPeriod) {

            /*
            |--------------------------------------------------------------------------
            | Till Month
            |--------------------------------------------------------------------------
            */

            if (str_starts_with($uptoPeriod, 'till-')) {

                $targetMonth = str_replace(
                    'till-',
                    '',
                    $uptoPeriod
                );

                $targetIndex = array_search(
                    $targetMonth,
                    $months
                );

                if ($targetIndex !== false) {

                    $allowedPeriods = array_slice(
                        $months,
                        0,
                        $targetIndex + 1
                    );
                }

            } else {

                /*
                |--------------------------------------------------------------------------
                | Exact Month
                |--------------------------------------------------------------------------
                */

                $allowedPeriods = [$uptoPeriod];
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Students
        |--------------------------------------------------------------------------
        */

        $studentsQuery = Student::query()

            ->with([
			    'currentAcademicHistory.classTerm:id,name',
    			'currentAcademicHistory.sectionTerm:id,name',
			])

            ->select([
                'id',
                'name',
                'admission_number',
            ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($studentSearch) {

            $studentsQuery->where(function ($q) use ($studentSearch) {

                $q->where(
                    'name',
                    'like',
                    "%{$studentSearch}%"
                )

                ->orWhere(
                    'admission_number',
                    'like',
                    "%{$studentSearch}%"
                );
            });
        }

        $students = $studentsQuery->get();

        /*
        |--------------------------------------------------------------------------
        | Final Rows
        |--------------------------------------------------------------------------
        */

        $rows = [];

        foreach ($students as $student) {

            $history = $student->currentAcademicHistory;

            if (!$history) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Class Filter
            |--------------------------------------------------------------------------
            */

            if (
                $classTermId &&
                $classTermId !== 'all' &&
                $history->class_term_id != $classTermId
            ) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Section Filter
            |--------------------------------------------------------------------------
            */

            if (
                $sectionTermId &&
                $sectionTermId !== 'all' &&
                $history->section_term_id != $sectionTermId
            ) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Fee Structures
            |--------------------------------------------------------------------------
            */

            $baseFees = StudentFeeStructure::query()

                ->where('year_id', $yearId)

                ->where(
                    'class_term_id',
                    $history->class_term_id
                )

                ->where(
                    'section_term_id',
                    $history->section_term_id
                )

                ->with('headTerm:id,name')

                ->get();

            /*
            |--------------------------------------------------------------------------
            | Overrides
            |--------------------------------------------------------------------------
            */

            $overrides = StudentFeeStructureOverride::query()

                ->where('student_id', $student->id)

                ->whereIn(
                    'fee_structure_id',
                    $baseFees->pluck('id')
                )

                ->get()

                ->keyBy('fee_structure_id');

            /*
            |--------------------------------------------------------------------------
            | Discounts
            |--------------------------------------------------------------------------
            */

            $discounts = StudentFeeDiscount::query()

                ->where('year_id', $yearId)

                ->where(function ($q) use ($student) {

                    $q->whereNull('student_id')

                        ->orWhere(
                            'student_id',
                            $student->id
                        );
                })

                ->get();

            /*
            |--------------------------------------------------------------------------
            | Payments
            |--------------------------------------------------------------------------
            */

            $paymentItems = StudentFeeSubmissionItem::query()

                ->whereHas('submission', function ($q)
                    use ($student, $yearId) {

                    $q->where(
                        'student_id',
                        $student->id
                    )

                    ->where(
                        'year_id',
                        $yearId
                    );
                })

                ->get();

            /*
            |--------------------------------------------------------------------------
            | Payment Map
            |--------------------------------------------------------------------------
            */

            $paidMap = [];

            foreach ($paymentItems as $item) {

                foreach (
                    ($item->selected_periods ?? [])
                    as $period => $amount
                ) {

                    $paidMap
                    [$item->fee_structure_id]
                    [$period] =

                    (
                        $paidMap
                        [$item->fee_structure_id]
                        [$period]

                        ?? 0
                    ) + $amount;
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Student Totals
            |--------------------------------------------------------------------------
            */

			$studentTotalPayable = 0;

			$studentTotalDiscount = 0;

			$studentTotalPaid = 0;

			$studentTotalDue = 0;

			$duePeriods = [];

            foreach ($baseFees as $fee) {

                $periodAmounts =
                    $fee->selected_periods ?? [];

                /*
                |--------------------------------------------------------------------------
                | Apply Overrides
                |--------------------------------------------------------------------------
                */

                if ($overrides->has($fee->id)) {

                    $override =
                        $overrides[$fee->id];

                    if ($override->selected_periods) {

                        $periodAmounts =
                            array_replace(
                                $periodAmounts,
                                $override->selected_periods
                            );

                    } elseif (
                        $override->override_amount !== null
                    ) {

                        foreach (
                            $periodAmounts
                            as $p => $v
                        ) {

                            $periodAmounts[$p] =
                                $override->override_amount;
                        }
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | Period Calculation
                |--------------------------------------------------------------------------
                */

                foreach (
                    $periodAmounts
                    as $period => $amount
                ) {

                    /*
                    |--------------------------------------------------------------------------
                    | Skip Unselected Periods
                    |--------------------------------------------------------------------------
                    */

                    if (
                        !empty($allowedPeriods) &&
                        !in_array(
                            $period,
                            $allowedPeriods
                        )
                    ) {
                        continue;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Discount
                    |--------------------------------------------------------------------------
                    */

                    $discountAmount = 0;

                    foreach ($discounts as $discount) {

                        if (
                            $discount->student_fee_structure_id &&
                            $discount->student_fee_structure_id !== $fee->id
                        ) {
                            continue;
                        }

                        if (
                            $discount->applicable_periods &&
                            !isset(
                                $discount
                                ->applicable_periods[$period]
                            )
                        ) {
                            continue;
                        }

                        if ($discount->amount) {

                            $discountAmount +=
                                $discount->amount;
                        }

                        if ($discount->percentage) {

                            $discountAmount +=
                                (
                                    $amount *
                                    $discount->percentage
                                ) / 100;
                        }
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Paid
                    |--------------------------------------------------------------------------
                    */

                    $paid =
                        $paidMap[$fee->id][$period]
                        ?? 0;

                    /*
                    |--------------------------------------------------------------------------
                    | Due
                    |--------------------------------------------------------------------------
                    */

                    $due = max(
                        0,
                        $amount -
                        $discountAmount -
                        $paid
                    );

					/*
					|--------------------------------------------------------------------------
					| Running Totals
					|--------------------------------------------------------------------------
					*/

					$studentTotalPayable += $amount;

					$studentTotalDiscount += $discountAmount;

					$studentTotalPaid += $paid;

                    /*
                    |--------------------------------------------------------------------------
                    | Totals
                    |--------------------------------------------------------------------------
                    */

                    if ($due > 0) {

                        $studentTotalDue += $due;

                        $duePeriods[] = $period;
                    }
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Skip No Due
            |--------------------------------------------------------------------------
            */

            if ($studentTotalDue <= 0) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Due Range
            |--------------------------------------------------------------------------
            */

            if (
                $minDueAmount !== null &&
                $studentTotalDue < $minDueAmount
            ) {
                continue;
            }

            if (
                $maxDueAmount !== null &&
                $studentTotalDue > $maxDueAmount
            ) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Final Row
            |--------------------------------------------------------------------------
            */

            $rows[] = [

                'student_id' => $student->id,

                'student_name' => $student->name,

                'admission_number' =>
                    $student->admission_number,

                'class_term_id' =>
                    $history->class_term_id,

                'section_term_id' =>
                    $history->section_term_id,

				'class_name' =>
				    $history->classTerm?->name,

				'section_name' =>
				    $history->sectionTerm?->name,

                'total_payable' =>
				    round($studentTotalPayable, 2),

				'total_discount' =>
				    round($studentTotalDiscount, 2),

				'total_paid' =>
				    round($studentTotalPaid, 2),

				'due_amount' =>
				    round($studentTotalDue, 2),

                'due_periods' =>
                    array_values(
                        array_unique($duePeriods)
                    ),

                'due_period_count' =>
                    count(
                        array_unique($duePeriods)
                    ),
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Sort Highest Due First
        |--------------------------------------------------------------------------
        */

        usort($rows, function ($a, $b) {

            return $b['due_amount']
                <=> $a['due_amount'];
        });

        /*
        |--------------------------------------------------------------------------
        | Response
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'status' => 'success',

            'filters' => [

                'year_id' => $yearId,

                'class_term_id' => $classTermId,

                'section_term_id' => $sectionTermId,

                'upto_period' => $uptoPeriod,

                'allowed_periods' => $allowedPeriods,
            ],

            'total_students' => count($rows),

            'data' => ['data'=>$rows],
        ]);
    }
}
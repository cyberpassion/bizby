<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;

use Modules\Student\Models\Student;
use Modules\Student\Models\StudentFeeStructure;
use Modules\Student\Models\StudentFeeStructureOverride;
use Modules\Student\Models\StudentFeeDiscount;
use Modules\Student\Models\StudentFeeSubmissionItem;

class StudentFeeSummaryApiController extends Controller
{
    /**
     * Fee summary for payment screen
     *
     * GET /students/{id}/fee-summary?year_id=1
     */
    public function show(int $id, Request $request)
    {
        $yearId = $request->query('year_id');

        /* -------------------------------------------------------
         | 1️⃣ Student & academic context
         * -----------------------------------------------------*/
        $student = Student::with('currentAcademicHistory')
            ->findOrFail($id);

        if (!$student->currentAcademicHistory) {

            return response()->json([
                'status'  => 'error',
                'message' => 'Student has no current academic history',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $history = $student->currentAcademicHistory;

        /* -------------------------------------------------------
         | 2️⃣ Base fee structures
         * -----------------------------------------------------*/
        $baseFees = StudentFeeStructure::query()
            ->where('year_id', $yearId)
            ->where('class_term_id', $history->class_term_id)
            ->where('section_term_id', $history->section_term_id)
            ->select([
                'id',
                'head_term_id',
                'selected_periods',
            ])
            ->with('headTerm:id,name')
            ->get()
            ->keyBy('id');

        /* -------------------------------------------------------
         | 3️⃣ Overrides
         * -----------------------------------------------------*/
        $overrides = StudentFeeStructureOverride::query()
            ->where('student_id', $student->id)
            ->whereIn('fee_structure_id', $baseFees->keys())
            ->get()
            ->keyBy('fee_structure_id');

        /* -------------------------------------------------------
         | 4️⃣ Discounts
         * -----------------------------------------------------*/
        $discounts = StudentFeeDiscount::query()
            ->where('year_id', $yearId)
            ->where(function ($q) use ($student) {

                $q->whereNull('student_id')
                    ->orWhere('student_id', $student->id);
            })
            ->get();

        /*
        |--------------------------------------------------------------------------
        | PRE-GROUP DISCOUNTS
        |--------------------------------------------------------------------------
        */

        $discountMap = [];

        foreach ($discounts as $discount) {

            $feeId = $discount->student_fee_structure_id ?? 'all';

            $periods = $discount->applicable_periods
                ? array_keys($discount->applicable_periods)
                : ['all'];

            foreach ($periods as $period) {

                $discountMap[$feeId][$period][] = $discount;
            }
        }

        /* -------------------------------------------------------
         | 5️⃣ Payments
         * -----------------------------------------------------*/
        $paymentItems = StudentFeeSubmissionItem::query()
            ->select([
                'fee_structure_id',
                'fee_submission_id',
                'selected_periods',
            ])
            ->whereHas('submission', function ($q) use ($student, $yearId) {

                $q->where('student_id', $student->id)
                    ->where('year_id', $yearId);
            })
            ->get();

        /*
        |--------------------------------------------------------------------------
        | PRE-GROUP PAYMENTS
        |--------------------------------------------------------------------------
        */

        $paidMap = [];

        foreach ($paymentItems as $item) {

            foreach (($item->selected_periods ?? []) as $period => $amount) {

                if (!isset($paidMap[$item->fee_structure_id][$period])) {

                    $paidMap[$item->fee_structure_id][$period] = [
                        'paid' => 0,
                        'fee_submission_ids' => [],
                    ];
                }

                $paidMap[$item->fee_structure_id][$period]['paid'] += $amount;

                $paidMap[$item->fee_structure_id][$period]['fee_submission_ids'][] =
                    $item->fee_submission_id;
            }
        }

        /* -------------------------------------------------------
         | 6️⃣ Build Summary
         * -----------------------------------------------------*/
        $periods = [];

        $totals = [
            'total_fee'      => 0,
            'total_discount' => 0,
            'total_paid'     => 0,
            'total_due'      => 0,
        ];

        foreach ($baseFees as $fee) {

            $periodAmounts = $fee->selected_periods ?? [];

            /*
            |--------------------------------------------------------------------------
            | Apply Overrides
            |--------------------------------------------------------------------------
            */

            if ($overrides->has($fee->id)) {

                $override = $overrides[$fee->id];

                if ($override->selected_periods) {

                    $periodAmounts = array_replace(
                        $periodAmounts,
                        $override->selected_periods
                    );

                } elseif ($override->override_amount !== null) {

                    foreach ($periodAmounts as $p => $v) {

                        $periodAmounts[$p] = $override->override_amount;
                    }
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Process Periods
            |--------------------------------------------------------------------------
            */

            foreach ($periodAmounts as $period => $amount) {

                /*
                |--------------------------------------------------------------------------
                | Discount Calculation
                |--------------------------------------------------------------------------
                */

                $discountAmount = 0;

                $applicableDiscounts = array_merge(
                    $discountMap[$fee->id][$period] ?? [],
                    $discountMap[$fee->id]['all'] ?? [],
                    $discountMap['all'][$period] ?? [],
                    $discountMap['all']['all'] ?? [],
                );

                foreach ($applicableDiscounts as $discount) {

                    if ($discount->amount) {

                        $discountAmount += $discount->amount;
                    }

                    if ($discount->percentage) {

                        $discountAmount += (
                            $amount * $discount->percentage
                        ) / 100;
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | Payment Info
                |--------------------------------------------------------------------------
                */

                $paymentInfo = $paidMap[$fee->id][$period] ?? [
                    'paid' => 0,
                    'fee_submission_ids' => [],
                ];

                $paid = $paymentInfo['paid'];

                $due = max(
                    0,
                    $amount - $discountAmount - $paid
                );

                /*
                |--------------------------------------------------------------------------
                | Build Response
                |--------------------------------------------------------------------------
                */

                $periods[$period]['period'] ??= $period;

                $periods[$period]['items'][] = [

                    'fee_structure_id' => $fee->id,

                    'fee_head_name' => $fee->headTerm?->name ?? 'Fee',

                    'total' => round($amount, 2),

                    'discount' => round($discountAmount, 2),

                    'paid' => round($paid, 2),

                    'due' => round($due, 2),

                    'fee_submission_ids' => array_values(
                        array_unique(
                            $paymentInfo['fee_submission_ids']
                        )
                    ),
                ];

                /*
                |--------------------------------------------------------------------------
                | Totals
                |--------------------------------------------------------------------------
                */

                $totals['total_fee'] += $amount;

                $totals['total_discount'] += $discountAmount;

                $totals['total_paid'] += $paid;

                $totals['total_due'] += $due;
            }
        }

        /* -------------------------------------------------------
         | 7️⃣ Response
         * -----------------------------------------------------*/
        return response()->json([
            'status' => 'success',

            'data' => [

                'periods' => array_values($periods),

                'totals' => [

                    'total_fee' => round(
                        $totals['total_fee'],
                        2
                    ),

                    'total_discount' => round(
                        $totals['total_discount'],
                        2
                    ),

                    'total_paid' => round(
                        $totals['total_paid'],
                        2
                    ),

                    'total_due' => round(
                        $totals['total_due'],
                        2
                    ),
                ],
            ],
        ], Response::HTTP_OK);
    }
}
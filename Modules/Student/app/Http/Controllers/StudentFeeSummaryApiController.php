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
    public function show($id, Request $request)
    {
        $yearId = $request->query('year_id');

        /* -------------------------------------------------------
         | 1️⃣ Student & academic context
         * -----------------------------------------------------*/
        $student = Student::with('currentAcademicHistory')->findOrFail($id);

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
        $baseFees = StudentFeeStructure::where('year_id', $yearId)
		    ->where('class_term_id', $history->class_term_id)
    		->where('section_term_id', $history->section_term_id)
		    ->get()
		    ->keyBy('id');


        /* -------------------------------------------------------
         | 3️⃣ Overrides
         * -----------------------------------------------------*/
        $overrides = StudentFeeStructureOverride::where('student_id', $student->id)
            ->whereIn('fee_structure_id', $baseFees->keys())
            ->get()
            ->keyBy('fee_structure_id');

        /* -------------------------------------------------------
         | 4️⃣ Discounts
         * -----------------------------------------------------*/
        $discounts = StudentFeeDiscount::where('year_id', $yearId)
            ->where(function ($q) use ($student) {
                $q->whereNull('student_id')
                  ->orWhere('student_id', $student->id);
            })
            ->get();

        /* -------------------------------------------------------
         | 5️⃣ Payments (from submission_items)
         * -----------------------------------------------------*/
        $paymentItems = StudentFeeSubmissionItem::whereHas('submission', function ($q) use ($student, $yearId) {
                $q->where('student_id', $student->id)
                  ->where('year_id', $yearId);
            })
            ->get();

        // fee_id → period → paid amount
        $paidMap = [];

        foreach ($paymentItems as $item) {
            foreach (($item->selected_periods ?? []) as $period => $amount) {
                $paidMap[$item->fee_structure_id][$period] =
                    ($paidMap[$item->fee_structure_id][$period] ?? 0) + $amount;
            }
        }

        /* -------------------------------------------------------
         | 6️⃣ Build summary
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

            // Apply overrides
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

            foreach ($periodAmounts as $period => $amount) {

                /* ---------- Discount calculation ---------- */
                $discountAmount = 0;

                foreach ($discounts as $discount) {
                    if ($discount->student_fee_structure_id &&
                        $discount->student_fee_structure_id !== $fee->id) {
                        continue;
                    }

                    if ($discount->applicable_periods &&
                        !isset($discount->applicable_periods[$period])) {
                        continue;
                    }

                    if ($discount->amount) {
                        $discountAmount += $discount->amount;
                    }

                    if ($discount->percentage) {
                        $discountAmount += ($amount * $discount->percentage) / 100;
                    }
                }

                /* ---------- Paid & due ---------- */
                $paid = $paidMap[$fee->id][$period] ?? 0;
                $due  = max(0, $amount - $discountAmount - $paid);

                /* ---------- Response build ---------- */
                $periods[$period]['period'] ??= $period;
                $periods[$period]['items'][] = [
                    'fee_structure_id' => $fee->id,
                    'label'            => $fee->feeHead->name ?? 'Fee',
                    'total'            => round($amount, 2),
                    'discount'         => round($discountAmount, 2),
                    'paid'             => round($paid, 2),
                    'due'              => round($due, 2),
                ];

                /* ---------- Totals ---------- */
                $totals['total_fee']      += $amount;
                $totals['total_discount'] += $discountAmount;
                $totals['total_paid']     += $paid;
                $totals['total_due']      += $due;
            }
        }

        return response()->json([
            'status' => 'success',
            'data'   => [
                'periods' => array_values($periods),
                'totals'  => [
                    'total_fee'      => round($totals['total_fee'], 2),
                    'total_discount' => round($totals['total_discount'], 2),
                    'total_paid'     => round($totals['total_paid'], 2),
                    'total_due'      => round($totals['total_due'], 2),
                ],
            ],
        ], Response::HTTP_OK);
    }
}

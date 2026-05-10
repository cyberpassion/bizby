<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Modules\Student\Models\Student;
use Modules\Student\Models\StudentFeeSubmission;
use Modules\Student\Models\StudentFeeSubmissionItem;
use Modules\Student\Models\StudentFeeStructure;
use Illuminate\Support\Facades\DB;

class StudentFeeSubmissionApiController extends Controller
{
    /**
     * Store a new fee submission
     *
     * POST /students/{id}/fee-submissions
     */
    public function store(int $id, Request $request)
    {
        $student = Student::with('currentAcademicHistory')->findOrFail($id);

        if (!$student->currentAcademicHistory) {
            return response()->json([
                'status' => 'error',
                'message' => 'Student has no current academic history',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $history = $student->currentAcademicHistory;

        // Validate request
        $data = $request->validate([
            'year_id' => 'required|integer',
            'class_term_id' => 'required|integer',
            'section_term_id' => 'required|integer',
            'remarks' => 'nullable|string',
            'allocations' => 'required|array', // [fee_structure_id => amount]
            'periods' => 'required|array',     // [fee_structure_id => {period => amount}]
        ]);

        DB::beginTransaction();
        try {
            $totalAmount = 0;
            $totalDiscount = 0;
            $amountReceived = 0;

            // 1️⃣ Create main submission record
            $submission = StudentFeeSubmission::create([
                'student_id' => $student->id,
                'year_id' => $data['year_id'],
                'class_term_id' => $data['class_term_id'],
                'section_term_id' => $data['section_term_id'],
                'total_amount' => 0, // temporary, update later
                'total_discount' => 0,
                'amount_received' => 0,
                'remarks' => $data['remarks'] ?? null,
            ]);

            // 2️⃣ Create submission items
            foreach ($data['allocations'] as $feeId => $periodAmounts) {

			    $paidAmount = array_sum($periodAmounts);
			    $periodPaid = $data['periods'][$feeId] ?? [];

			    $fee = StudentFeeStructure::findOrFail($feeId);
			    $discountApplied = 0;

			    StudentFeeSubmissionItem::create([
			        'fee_submission_id' => $submission->id,
        			'fee_structure_id' => $feeId,
		    	    'payable_amount' => $paidAmount + $discountApplied,
        			'discount_applied' => $discountApplied,
		        	'paid_amount' => $paidAmount,
        			'selected_periods' => $periodPaid, // JSON
			    ]);

			    $totalAmount += $paidAmount + $discountApplied;
			    $totalDiscount += $discountApplied;
    			$amountReceived += $paidAmount;
			}

            // 3️⃣ Update totals in main submission
            $submission->update([
                'total_amount' => $totalAmount,
                'total_discount' => $totalDiscount,
                'amount_received' => $amountReceived,
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Fee submission saved successfully',
                'data' => $submission->load('items'),
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save fee submission: ' . $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

	public function reverse(Request $request, int $id)
	{
    	$validated = $request->validate([

	        'reason' => [
    	        'required',
        	    'string',
	        ],
    	]);

	    $submission = StudentFeeSubmission::findOrFail($id);

	    /*
    	|--------------------------------------------------------------------------
	    | Already Reversed
    	|--------------------------------------------------------------------------
	    */

	    if ($submission->fee_status === 'reversed') {

	        return response()->json([

    	        'status' => 'error',

        	    'message' =>
            	    'Fee submission already reversed.',

	        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    	}

	    /*
    |--------------------------------------------------------------------------
    | Reverse
    |--------------------------------------------------------------------------
    */

    $submission->update([

        'fee_status' => 'reversed',

        'reversed_at' => now(),

        'reversed_by' => auth()->id(),

        'reversal_reason' =>
            $validated['reason'],
    ]);

    return response()->json([

        'status' => 'success',

        'message' =>
            'Fee submission reversed successfully.',

        'data' => $submission,

    ]);
}

public function reverseFeeSubmission(
    Request $request,
    $id
)
{
    $validated = $request->validate([

        'reason' => [
            'required',
            'string',
        ],
    ]);

    $submission =
        StudentFeeSubmission::findOrFail($id);

    /*
    |--------------------------------------------------------------------------
    | Already Reversed
    |--------------------------------------------------------------------------
    */

    if (
        $submission->fee_status
        ===
        'reversed'
    ) {

        return response()->json([

            'status' => 'error',

            'message' =>
                'Fee submission already reversed.',

        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /*
    |--------------------------------------------------------------------------
    | Reverse
    |--------------------------------------------------------------------------
    */

    $submission->update([

        'fee_status' =>
            'reversed',

        'reversed_at' =>
            now(),

        'reversed_by' =>
            auth()->id(),

        'reversal_reason' =>
            $validated['reason'],
    ]);

    return response()->json([

        'status' => 'success',

        'message' =>
            'Fee submission reversed successfully.',

        'data' => $submission,

    ], Response::HTTP_OK);
}

/*
    |--------------------------------------------------------------------------
    | Fee Collection Detail
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $submission = StudentFeeSubmission::query()

            ->with([

                /*
                |--------------------------------------------------------------------------
                | Student
                |--------------------------------------------------------------------------
                */

                'student:id,name,admission_number,phone',

                /*
                |--------------------------------------------------------------------------
                | Academic
                |--------------------------------------------------------------------------
                */

                'academicYear:id,name',

                'classTerm:id,name',

                'sectionTerm:id,name',

                /*
                |--------------------------------------------------------------------------
                | Items
                |--------------------------------------------------------------------------
                */

                'items',
            ])

            ->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data'   => $submission,
        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Fee Receipt
    |--------------------------------------------------------------------------
    */

    public function receipt($id)
    {
        $submission = StudentFeeSubmission::query()

            ->with([

                'student:id,name,admission_number,phone',

                'academicYear:id,name',

                'classTerm:id,name',

                'sectionTerm:id,name',

                'items',
            ])

            ->findOrFail($id);

        /*
|--------------------------------------------------------------------------
| Month Summary
|--------------------------------------------------------------------------
*/

$months = collect($submission->items)

    ->flatMap(function ($item) {

        return collect($item->selected_periods ?? [])

            ->map(function ($amount, $period) use ($item) {

                return [

                    'month' => strtoupper($period),

                    'payable' =>
                        (float) $item->payable_amount,

                    'paid' =>
                        (float) $item->paid_amount,

                    'discount' =>
                        (float) $item->discount_applied,

                    'balance' =>
                        (float) $item->payable_amount
                        -
                        (
                            (float) $item->paid_amount
                            +
                            (float) $item->discount_applied
                        ),
                ];
            });
    })

    ->groupBy('month')

    ->map(function ($items, $month) {

        return [

            'month' => $month,

            'payable' => $items->sum('payable'),

            'paid' => $items->sum('paid'),

            'discount' => $items->sum('discount'),

            'balance' => $items->sum('balance'),
        ];
    })

    ->values();

        return response()->json([

            'status' => 'success',

            'data' => [

                /*
                |--------------------------------------------------------------------------
                | Receipt
                |--------------------------------------------------------------------------
                */

                'id' => $submission->id,

                'receipt_no' => $submission->receipt_no,

                /*
                |--------------------------------------------------------------------------
                | Student
                |--------------------------------------------------------------------------
                */

                'student_name' =>
                    $submission->student?->name,

                'admission_number' =>
                    $submission->student?->admission_number,

                'phone' =>
                    $submission->student?->phone,

                /*
                |--------------------------------------------------------------------------
                | Academic
                |--------------------------------------------------------------------------
                */

                'year_name' =>
                    $submission->academicYear?->name,

                'class_name' =>
                    $submission->classTerm?->name,

                'section_name' =>
                    $submission->sectionTerm?->name,

                /*
                |--------------------------------------------------------------------------
                | Payment
                |--------------------------------------------------------------------------
                */

                'payment_date' =>
                    optional($submission->created_at)
                        ->toDateString(),

                'payment_time' =>
                    optional($submission->created_at)
                        ->format('H:i:s'),

                'payment_mode' =>
                    $submission->payment_mode,

                'reference_no' =>
                    $submission->reference_no,

                'remark' =>
                    $submission->remark,

                /*
                |--------------------------------------------------------------------------
                | Totals
                |--------------------------------------------------------------------------
                */

                'total_payable' =>
                    $months->sum('payable'),

                'total_paid' =>
                    $months->sum('paid'),

                'total_discount' =>
                    $months->sum('discount'),

                'total_balance' =>
                    $months->sum('balance'),

                /*
                |--------------------------------------------------------------------------
                | Month Summary
                |--------------------------------------------------------------------------
                */

                'months' => $months,
            ],

        ], Response::HTTP_OK);
    }

}

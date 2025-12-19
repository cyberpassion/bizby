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
    public function store($id, Request $request)
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
}

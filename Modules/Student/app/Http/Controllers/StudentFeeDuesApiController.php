<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Modules\Student\Models\Student;
use Modules\Student\Models\StudentFeeStructure;
use Modules\Student\Models\StudentFeeSubmissionItem;
use Illuminate\Support\Facades\DB;

class StudentFeeDuesApiController extends Controller
{
    /**
     * -----------------------------------------
     * Student-wise dues (single student)
     * GET /students/{id}/fee-dues
     * -----------------------------------------
     */
    public function show($id, Request $request)
    {
        $data = $request->only([
		    'year_id',
		    'upto_period',
		]);

        $student = Student::with('currentAcademicHistory')->findOrFail($id);
        $history = $student->currentAcademicHistory;

        $upto = $data['upto_period'] ?? null;

        // 1️⃣ Expected fee (from structures)
        $structures = StudentFeeStructure::where('year_id', $data['year_id'])
            ->where('class_term_id', $history->class_term_id)
            ->where('section_term_id', $history->section_term_id)
            ->get();

        $expected = 0;

        foreach ($structures as $structure) {
            $periods = $structure->selected_periods ?? [];

            foreach ($periods as $period => $amount) {
                if ($upto && $period > $upto) continue;
                $expected += $amount;
            }
        }

        // 2️⃣ Paid amount
        $paid = StudentFeeSubmissionItem::whereHas('submission', function ($q) use ($student, $data) {
                $q->where('student_id', $student->id)
                  ->where('year_id', $data['year_id']);
            })
            ->sum('paid_amount');

        $due = max(0, $expected - $paid);

        return response()->json([
            'status' => 'success',
            'data' => [
                'student_id' => $student->id,
                'expected_amount' => $expected,
                'paid_amount' => $paid,
                'due_amount' => $due,
            ]
        ], Response::HTTP_OK);
    }

    /**
     * -----------------------------------------
     * Class / Section dues report
     * POST /students/fee-dues/report
     * -----------------------------------------
     */
    public function report(Request $request)
	{
    	$data = $request->only([
		    'year_id',
		    'class_term_id',
    		'section_term_id',
		    'upto_period',
		]);

	    $upto = $data['upto_period'] ?? null;

	    /* ----------------------------------------------------
    	 | 1️⃣ Fee structures (dynamic filters)
    	 ---------------------------------------------------- */
	    $structureQuery = StudentFeeStructure::where('year_id', $data['year_id']);

	    if (!empty($data['class_term_id'])) {
    	    $structureQuery->where('class_term_id', $data['class_term_id']);
    	}

	    if (!empty($data['section_term_id'])) {
     		$structureQuery->where('section_term_id', $data['section_term_id']);
    	}

	    $structures = $structureQuery->get();

	    $structureTotal = [];

	    foreach ($structures as $structure) {
    	    $total = 0;

        	foreach ($structure->selected_periods ?? [] as $period => $amount) {
            	if ($upto && $period > $upto) continue;
            	$total += $amount;
        	}

	        $structureTotal[$structure->id] = $total;
    	}

	    $expectedPerStudent = array_sum($structureTotal);

	    /* ----------------------------------------------------
    	 | 2️⃣ Paid data (dynamic filters)
    	 ---------------------------------------------------- */
    	$paidQuery = StudentFeeSubmissionItem::select(
	            'student_fee_submissions.student_id',
    	        DB::raw('SUM(student_fee_submission_items.paid_amount) as paid')
        	)
	        ->join(
    	        'student_fee_submissions',
        	    'student_fee_submissions.id',
            	'=',
            	'student_fee_submission_items.fee_submission_id'
        	)
	        ->where('student_fee_submissions.year_id', $data['year_id']);

	    if (!empty($data['class_term_id'])) {
    	    $paidQuery->where('student_fee_submissions.class_term_id', $data['class_term_id']);
    	}

	    if (!empty($data['section_term_id'])) {
    	    $paidQuery->where('student_fee_submissions.section_term_id', $data['section_term_id']);
    	}

	    $paidData = $paidQuery
    	    ->groupBy('student_fee_submissions.student_id')
        	->get()
        	->keyBy('student_id');

	    /* ----------------------------------------------------
    	 | 3️⃣ Students list (dynamic filters)
    	 ---------------------------------------------------- */
	    $studentsQuery = Student::whereHas('currentAcademicHistory', function ($q) use ($data) {
    	    if (!empty($data['class_term_id'])) {
        	    $q->where('class_term_id', $data['class_term_id']);
        	}

	        if (!empty($data['section_term_id'])) {
    	        $q->where('section_term_id', $data['section_term_id']);
        	}
	    });

    	$students = $studentsQuery->get();

	    /* ----------------------------------------------------
    	 | 4️⃣ Build report
    	 ---------------------------------------------------- */
	    $report = [];

	    foreach ($students as $student) {
    	    $paid = $paidData[$student->id]->paid ?? 0;

	        $report[] = [
    	        'student_id' => $student->id,
        	    'name' => $student->name,
            	'expected_amount' => $expectedPerStudent,
            	'paid_amount' => $paid,
            	'due_amount' => max(0, $expectedPerStudent - $paid),
        	];
	    }

	    return response()->json([
    	    'status' => 'success',
        	'filters' => [
            	'year_id' => $data['year_id'],
            	'class_term_id' => $data['class_term_id'] ?? 'ALL',
	            'section_term_id' => $data['section_term_id'] ?? 'ALL',
    	        'upto_period' => $upto ?? 'FULL YEAR',
        	],
	        'data' => ['data'=>$report],
    	], Response::HTTP_OK);
	}

}

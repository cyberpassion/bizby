<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

use Modules\Student\Models\Student;
use Modules\Student\Models\StudentFeeSubmission;
use Modules\Student\Models\StudentFeeSubmissionItem;
use Modules\Student\Models\StudentFeeStructure;

use Modules\Student\Services\SubmitStudentFeeService;
use Modules\Student\Services\CancelStudentFeeReceiptService;

class StudentFeeSubmissionApiController extends Controller
{
    /**
     * Store a new fee submission
     *
     * POST /students/{id}/fee-submissions
     */
    public function store(int $id, Request $request)
    {
        $submission = app(
	        SubmitStudentFeeService::class
    	)->handle($request, $id);

	    return response()->json([
    	    'status' => 'success',
        	'message' => 'Fee submitted successfully.',
        	'data' => $submission,
    	]);
    }

    /*
    |--------------------------------------------------------------------------
    | Reverse Fee Submission
    |--------------------------------------------------------------------------
    */

    public function reverse(Request $request, int $id)
    {
        $submission = app(
        	CancelStudentFeeReceiptService::class
	    )->handle($id);

	    return response()->json([
    	    'success' => true,
        	'message' => 'Receipt cancelled successfully.',
	        'data' => $submission,
    	]);
    }

    /*
    |--------------------------------------------------------------------------
    | Fee Collection Detail
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $submission =
            StudentFeeSubmission::query()

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

                    'items.due',
                ])

                ->findOrFail($id);

        return response()->json([

            'status' => 'success',

            'data' => $submission,

        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Fee Receipt
    |--------------------------------------------------------------------------
    */

    public function receipt($id)
    {
        $submission =
            StudentFeeSubmission::query()

                ->with([

                    'student:id,name,admission_number,phone',

                    'academicYear:id,name',

                    'classTerm:id,name',

                    'sectionTerm:id,name',

                    'items.due',
                ])

                ->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Month Summary
        |--------------------------------------------------------------------------
        */

        $months = $submission->items

            ->flatMap(function ($item) {

                return collect(
                    $item->due->period_name ?? []
                )

                    ->map(function (
                        $amount,
                        $period
                    ) use ($item) {

                        return [

                            'month' =>
                                strtoupper($period),

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

                    'payable' =>
                        $items->sum('payable'),

                    'paid' =>
                        $items->sum('paid'),

                    'discount' =>
                        $items->sum('discount'),

                    'balance' =>
                        $items->sum('balance'),
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

                'id' =>
                    $submission->id,

                'receipt_no' =>
                    $submission->receipt_no,

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
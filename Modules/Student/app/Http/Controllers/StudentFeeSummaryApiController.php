<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;

use Modules\Student\Models\Student;
use Modules\Student\Models\StudentFeeDue;
use Modules\Student\Models\StudentFeeStructure;

class StudentFeeSummaryApiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Fee Summary
    |--------------------------------------------------------------------------
    */

    public function show(
        int $id,
        Request $request
    ) {

        $yearId = $request->query('year_id');

        $student = Student::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Fee Structure Exists?
        |--------------------------------------------------------------------------
        */

        $hasStructure = StudentFeeStructure::query()

		    ->where('year_id', $yearId)

		    ->where(
		        'class_term_id',
        		$student->class_term_id
		    )

		    ->where(
		        'section_term_id',
        		$student->section_term_id
    		)

		    ->exists();

        /*
        |--------------------------------------------------------------------------
        | Dues
        |--------------------------------------------------------------------------
        */

        $dues = StudentFeeDue::query()

            ->where('student_id', $student->id)

            ->where('year_id', $yearId)

            ->where(
                'dues_status',
                '!=',
                'cancelled'
            )

            ->orderBy('due_date')

            ->get();

        /*
        |--------------------------------------------------------------------------
        | Has Dues?
        |--------------------------------------------------------------------------
        */

        $hasDues = $dues->count() > 0;

        /*
        |--------------------------------------------------------------------------
        | Group By Period
        |--------------------------------------------------------------------------
        */

        $periods = $dues

            ->groupBy('period_name')

            ->map(function ($items, $period) {

                return [

                    'period' => $period,

                    'items' => $items

                        ->map(function ($due) {

                            return [

                                'due_id' =>
                                    $due->id,

                                'head_name' =>
                                    $due->head_name,

                                'amount' =>
                                    round(
                                        $due->amount,
                                        2
                                    ),

                                'fine_amount' =>
                                    round(
                                        $due->fine_amount,
                                        2
                                    ),

                                'waiver_amount' =>
                                    round(
                                        $due->waiver_amount,
                                        2
                                    ),

                                'paid_amount' =>
                                    round(
                                        $due->paid_amount,
                                        2
                                    ),

                                'balance_amount' =>
                                    round(
                                        $due->balance_amount,
                                        2
                                    ),

                                'dues_status' =>
                                    $due->dues_status,

                                'due_date' =>
                                    optional(
                                        $due->due_date
                                    )->format('Y-m-d'),
                            ];
                        })

                        ->values(),
                ];
            })

            ->values();

        /*
        |--------------------------------------------------------------------------
        | Totals
        |--------------------------------------------------------------------------
        */

        $totals = [

            'total_amount' =>

                round(
                    $dues->sum('amount'),
                    2
                ),

            'total_fine' =>

                round(
                    $dues->sum('fine_amount'),
                    2
                ),

            'total_waiver' =>

                round(
                    $dues->sum('waiver_amount'),
                    2
                ),

            'total_paid' =>

                round(
                    $dues->sum('paid_amount'),
                    2
                ),

            'total_balance' =>

                round(
                    $dues->sum('balance_amount'),
                    2
                ),
        ];

        /*
        |--------------------------------------------------------------------------
        | Response
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'status' => 'success',

            'data' => [

                'has_structure' =>
                    $hasStructure,

                'has_dues' =>
                    $hasDues,

                'periods' =>
                    $periods,

                'totals' =>
                    $totals,
            ],

        ], Response::HTTP_OK);
    }
}
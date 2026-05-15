<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;

use Modules\Student\Models\Student;
use Modules\Student\Models\StudentFeeDue;

use Modules\Student\Services\GenerateStudentFeeDuesService;

class StudentFeeDueApiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Student Dues
    |--------------------------------------------------------------------------
    |
    | GET:
    | students/fee-dues/{studentId}
    |
    */

    public function studentDues(
        int $studentId,
        Request $request
    ) {

        $query = StudentFeeDue::query()

            ->with([

                'year:id,name',

                'headTerm:id,name',

                'patternPeriod:id,label,key',

                'structure:id,head_term_id,pattern_id',
            ])

            ->where('student_id', $studentId);

        /*
        |--------------------------------------------------------------------------
        | Optional Year Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('year_id')) {

            $query->where(
                'year_id',
                $request->year_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Optional Status Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('dues_status')) {

            $query->where(
                'dues_status',
                $request->dues_status
            );
        }

        $data = $query
            ->orderBy('due_date')
            ->latest('id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Summary
        |--------------------------------------------------------------------------
        */

        $summary = [

            'total_amount' =>
                $data->sum('amount'),

            'paid_amount' =>
                $data->sum('paid_amount'),

            'fine_amount' =>
                $data->sum('fine_amount'),

            'waiver_amount' =>
                $data->sum('waiver_amount'),

            'balance_amount' =>
                $data->sum('balance_amount'),
        ];

        return response()->json([

            'status' => 'success',

            'summary' => $summary,

            'data' => $data,

        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Dues Report
    |--------------------------------------------------------------------------
    |
    | POST:
    | students/fee-dues/report
    |
    */

    public function report(Request $request)
    {
        $query = StudentFeeDue::query()

            ->with([
                'student:id,name',
                'year:id,name',
                'headTerm:id,name',
            ]);

        /*
        |--------------------------------------------------------------------------
        | Filters
        |--------------------------------------------------------------------------
        */

        if ($request->filled('year_id')) {

            $query->where(
                'year_id',
                $request->year_id
            );
        }

        if ($request->filled('class_term_id')) {

            $query->where(
                'class_term_id',
                $request->class_term_id
            );
        }

        if ($request->filled('section_term_id')) {

            $query->where(
                'section_term_id',
                $request->section_term_id
            );
        }

        if ($request->filled('dues_status')) {

            $query->where(
                'dues_status',
                $request->dues_status
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Report Data
        |--------------------------------------------------------------------------
        */

        $data = $query
            ->latest()
            ->paginate(
                $request->get('per_page', 20)
            );

        /*
        |--------------------------------------------------------------------------
        | Totals
        |--------------------------------------------------------------------------
        */

        $totals = [

            'total_amount' =>
                $query->sum('amount'),

            'paid_amount' =>
                $query->sum('paid_amount'),

            'fine_amount' =>
                $query->sum('fine_amount'),

            'waiver_amount' =>
                $query->sum('waiver_amount'),

            'balance_amount' =>
                $query->sum('balance_amount'),
        ];

        return response()->json([

            'status' => 'success',

            'totals' => $totals,

            'data' => $data,

        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Carry Forward
    |--------------------------------------------------------------------------
    */

    public function carryForward(
        Request $request,
        int $studentId
    ) {

        $validated = $request->validate([

            'source_year_id' => [
                'required',
                'exists:student_academic_years,id',
            ],

            'target_year_id' => [
                'required',
                'exists:student_academic_years,id',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:1',
            ],

            'class_term_id' => [
                'required',
                'exists:terms,id',
            ],

            'section_term_id' => [
                'nullable',
                'exists:terms,id',
            ],
        ]);

        $due = StudentFeeDue::create([

            'student_id' => $studentId,

            'year_id' =>
                $validated['target_year_id'],

            'class_term_id' =>
                $validated['class_term_id'],

            'section_term_id' =>
                $validated['section_term_id'],

            /*
            |--------------------------------------------------------------------------
            | Due Info
            |--------------------------------------------------------------------------
            */

            'due_type' => 'carry_forward',

            'amount' =>
                $validated['amount'],

            'paid_amount' => 0,

            'fine_amount' => 0,

            'waiver_amount' => 0,

            'balance_amount' =>
                $validated['amount'],

            'dues_status' => 'unpaid',

            /*
            |--------------------------------------------------------------------------
            | Snapshots
            |--------------------------------------------------------------------------
            */

            'head_name' =>
                'Carry Forward',

            'pattern_name' =>
                'Carry Forward',

            'period_name' =>
                'Previous Balance',

            /*
            |--------------------------------------------------------------------------
            | Meta
            |--------------------------------------------------------------------------
            */

            'meta' => [

                'source_year_id' =>
                    $validated['source_year_id'],

                'reason' =>
                    'Previous year carry forward',
            ],

            'generated_at' => now(),
        ]);

        return response()->json([

            'status' => 'success',

            'message' =>
                'Carry forward created successfully.',

            'data' => $due,

        ], Response::HTTP_CREATED);
    }

	/*
    |--------------------------------------------------------------------------
    | Pending Dues
    |--------------------------------------------------------------------------
    |
    | GET:
    | students/fee-dues/{studentId}/pending-dues
    |
    */

    public function pendingDues(
        int $studentId,
        Request $request
    ) {

        $query = StudentFeeDue::query()

            ->with([

                'headTerm:id,name',

                'patternPeriod:id,label,key',

                'structure:id,head_term_id,pattern_id',
            ])

            ->where(
                'student_id',
                $studentId
            )

            /*
            |--------------------------------------------------------------------------
            | Only Pending
            |--------------------------------------------------------------------------
            */

            ->whereIn(
                'dues_status',
                [
                    'unpaid',
                    'partial',
                ]
            )

            ->where(
                'balance_amount',
                '>',
                0
            );

        /*
        |--------------------------------------------------------------------------
        | Optional Year Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('year_id')) {

            $query->where(
                'year_id',
                $request->year_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Optional Head Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('head_term_id')) {

            $query->where(
                'head_term_id',
                $request->head_term_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Result
        |--------------------------------------------------------------------------
        */

        $dues = $query

            ->orderBy('due_date')

            ->get();

        /*
        |--------------------------------------------------------------------------
        | Summary
        |--------------------------------------------------------------------------
        */

        $summary = [

            'total_amount' =>

                round(
                    $dues->sum('amount'),
                    2
                ),

            'total_paid' =>

                round(
                    $dues->sum('paid_amount'),
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

            'total_balance' =>

                round(
                    $dues->sum('balance_amount'),
                    2
                ),
        ];

        /*
        |--------------------------------------------------------------------------
        | Group By Period
        |--------------------------------------------------------------------------
        */

        $grouped = $dues

            ->groupBy('period_name')

            ->map(function ($items, $period) {

                return [

                    'period' => $period,

                    'items' =>

                        $items->map(function ($due) {

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

                                'paid_amount' =>
                                    round(
                                        $due->paid_amount,
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

                                'balance_amount' =>
                                    round(
                                        $due->balance_amount,
                                        2
                                    ),

                                'due_date' =>
                                    optional(
                                        $due->due_date
                                    )->toDateString(),

                                'dues_status' =>
                                    $due->dues_status,
                            ];
                        })->values(),
                ];
            })

            ->values();

        return response()->json([

            'status' => 'success',

            'summary' => $summary,

            'data' => $grouped,

        ], Response::HTTP_OK);
    }

	public function regenerateDues(
	    int $id
	) {

	    $student = Student::findOrFail($id);

	    app(
    	    GenerateStudentFeeDuesService::class
    	)->handle($student);

	    return response()->json([

	        'status' => 'success',

	        'message' =>
    	        'Dues regenerated successfully.',
    	]);
	}

}
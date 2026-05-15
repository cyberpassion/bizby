<?php

namespace Modules\Student\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Student\Models\StudentFeeDue;

class StudentFeeDefaulterReportApiController extends Controller
{
    public function index(Request $request)
    {
        $query = StudentFeeDue::query()

            ->with([

                'student:id,name,phone,father_name',

                'year:id,name',

                'classTerm:id,name',

                'sectionTerm:id,name',

                'headTerm:id,name',
            ])

            /*
            |--------------------------------------------------------------------------
            | Only Pending / Partial Dues
            |--------------------------------------------------------------------------
            */

            ->where(
                'balance_amount',
                '>',
                0
            );

        /*
        |--------------------------------------------------------------------------
        | Filters
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('year_id') &&
            $request->year_id !== 'all'
        ) {

            $query->where(
                'year_id',
                $request->year_id
            );
        }

        if (
            $request->filled('class_term_id')
        ) {

            $query->where(
                'class_term_id',
                $request->class_term_id
            );
        }

        if (
            $request->filled('section_term_id')
        ) {

            $query->where(
                'section_term_id',
                $request->section_term_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Result
        |--------------------------------------------------------------------------
        */

        $data = $query

            ->orderByDesc(
                'balance_amount'
            )

            ->paginate(
                $request->get('per_page', 20)
            )

            ->through(function ($item) {

                return [

                    /*
                    |--------------------------------------------------------------------------
                    | Student
                    |--------------------------------------------------------------------------
                    */

                    'student_id' =>
                        $item->student_id,

                    'student_name' =>
                        $item->student?->name,

                    'student_phone' =>
                        $item->student?->phone,

                    'father_name' =>
                        $item->student?->father_name,

                    /*
                    |--------------------------------------------------------------------------
                    | Academic
                    |--------------------------------------------------------------------------
                    */

                    'year_id' =>
                        $item->year_id,

                    'year_name' =>
                        $item->academicYear?->name,

                    'class_term_id' =>
                        $item->class_term_id,

                    'class_name' =>
                        $item->classTerm?->name,

                    'section_term_id' =>
                        $item->section_term_id,

                    'section_name' =>
                        $item->sectionTerm?->name,

                    /*
                    |--------------------------------------------------------------------------
                    | Fee Head
                    |--------------------------------------------------------------------------
                    */

                    'head_term_id' =>
                        $item->head_term_id,

                    'head_name' =>
                        $item->headTerm?->name,

                    /*
                    |--------------------------------------------------------------------------
                    | Amounts
                    |--------------------------------------------------------------------------
                    */

                    'gross_amount' =>
                        $item->gross_amount,

                    'discount_amount' =>
                        $item->discount_amount,

                    'fine_amount' =>
                        $item->fine_amount,

                    'paid_amount' =>
                        $item->paid_amount,

                    'balance_amount' =>
                        $item->balance_amount,

                    /*
                    |--------------------------------------------------------------------------
                    | Status
                    |--------------------------------------------------------------------------
                    */

                    'dues_status' =>
                        $item->dues_status,

                    /*
                    |--------------------------------------------------------------------------
                    | Dates
                    |--------------------------------------------------------------------------
                    */

                    'due_date' =>
                        $item->due_date,

                    'created_at' =>
                        $item->created_at,
                ];
            });

        return response()->json([

            'status' => 'success',

            'data' => $data,
        ]);
    }
}
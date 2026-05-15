<?php

namespace Modules\Student\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Student\Models\StudentFeeDiscount;

class StudentFeeDiscountReportApiController extends Controller
{
    public function index(Request $request)
    {
        $query = StudentFeeDiscount::query()

            ->with([

                'student:id,name,phone,father_name',

                'academicYear:id,name',

                'classTerm:id,name',

                'sectionTerm:id,name',

                'headTerm:id,name',
            ]);

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

        if (
            $request->filled('student_id')
        ) {

            $query->where(
                'student_id',
                $request->student_id
            );
        }

        if (
            $request->filled('head_term_id')
        ) {

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

        $data = $query

            ->latest()

            ->paginate(
                $request->get('per_page', 20)
            )

            ->through(function ($item) {

                return [

                    'id' => $item->id,

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
                    | Discount
                    |--------------------------------------------------------------------------
                    */

                    'discount_type' =>
                        $item->discount_type,

                    'discount_value' =>
                        $item->discount_value,

                    'discount_amount' =>
                        $item->discount_amount,

                    /*
                    |--------------------------------------------------------------------------
                    | Other
                    |--------------------------------------------------------------------------
                    */

                    'remarks' =>
                        $item->remarks,

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
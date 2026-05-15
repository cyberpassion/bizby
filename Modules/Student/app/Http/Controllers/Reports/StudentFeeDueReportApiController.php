<?php

namespace Modules\Student\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Student\Models\StudentFeeDue;

class StudentFeeDueReportApiController extends Controller
{
    public function index(Request $request)
    {
        $query = StudentFeeDue::query()

            ->with([
                'student:id,name,admission_number',
            ]);

        /*
        |--------------------------------------------------------------------------
        | Filters
        |--------------------------------------------------------------------------
        */

        if ($request->filled('year_id')) {

            $query->where(
                'year_id',
                str_replace(
                    'tenant_',
                    '',
                    $request->year_id
                )
            );
        }

        if ($request->filled('class_term_id')) {

            $query->where(
                'class_term_id',
                str_replace(
                    'tenant_',
                    '',
                    $request->class_term_id
                )
            );
        }

        if ($request->filled('section_term_id')) {

            $query->where(
                'section_term_id',
                str_replace(
                    'tenant_',
                    '',
                    $request->section_term_id
                )
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Only Pending
        |--------------------------------------------------------------------------
        */

        $query->where(
            'balance_amount',
            '>',
            0
        );

        /*
        |--------------------------------------------------------------------------
        | Student Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('student_search')) {

            $search = $request->student_search;

            $query->whereHas(
                'student',
                function ($q) use ($search) {

                    $q->where(
                        'name',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'admission_number',
                        'like',
                        "%{$search}%"
                    );
                }
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Group By Student
        |--------------------------------------------------------------------------
        */

        $rows = $query
            ->get()

            ->groupBy('student_id')

            ->map(function ($items) {

                $student = $items->first()?->student;

                return [

                    'student_id' =>
                        $student?->id,

                    'student_name' =>
                        $student?->name,

                    'admission_number' =>
                        $student?->admission_number,

                    'total_amount' =>
                        round(
                            $items->sum('amount'),
                            2
                        ),

                    'total_paid' =>
                        round(
                            $items->sum('paid_amount'),
                            2
                        ),

                    'total_balance' =>
                        round(
                            $items->sum('balance_amount'),
                            2
                        ),

                    'due_periods' =>

                        $items

                            ->pluck('period_name')

                            ->unique()

                            ->values(),
                ];
            })

            ->values();

        return response()->json([

            'status' => 'success',

            'total_students' =>
                $rows->count(),

            'data' => [
                'data' => $rows
            ],

        ]);
    }
}
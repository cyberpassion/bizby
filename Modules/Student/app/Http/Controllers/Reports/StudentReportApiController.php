<?php

namespace Modules\Student\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Student\Models\Student;

class StudentReportApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query()
            ->with([
                'currentAcademicHistory.academicYear:id,name',
                'currentAcademicHistory.classTerm:id,name',
                'currentAcademicHistory.sectionTerm:id,name',
            ]);

        /*
        |--------------------------------------------------------------------------
        | Student Filters
        |--------------------------------------------------------------------------
        */

        $query->when(
            $request->filled('gender'),
            fn ($q) =>
            $q->where('gender', $request->gender)
        );

        $query->when(
            $request->filled('religion'),
            fn ($q) =>
            $q->where('religion', $request->religion)
        );

        $query->when(
            $request->filled('caste'),
            fn ($q) =>
            $q->where('caste', $request->caste)
        );

        $query->when(
            $request->filled('category'),
            fn ($q) =>
            $q->where('category', $request->category)
        );

        $query->when(
            $request->filled('nationality'),
            fn ($q) =>
            $q->where('nationality', $request->nationality)
        );

        $query->when(
            $request->filled('marital_status'),
            fn ($q) =>
            $q->where('marital_status', $request->marital_status)
        );

        $query->when(
            $request->filled('status'),
            fn ($q) =>
            $q->where('status', $request->status)
        );

        /*
        |--------------------------------------------------------------------------
        | Academic Filters
        |--------------------------------------------------------------------------
        */

        $query->when(
            $request->filled('year_id'),
            fn ($q) =>
            $q->whereHas('currentAcademicHistory', function ($sub) use ($request) {
                $sub->where('year_id', $request->year_id);
            })
        );

        $query->when(
            $request->filled('class_term_id'),
            fn ($q) =>
            $q->whereHas('currentAcademicHistory', function ($sub) use ($request) {
                $sub->where('class_term_id', $request->class_term_id);
            })
        );

        $query->when(
            $request->filled('section_term_id'),
            fn ($q) =>
            $q->whereHas('currentAcademicHistory', function ($sub) use ($request) {
                $sub->where('section_term_id', $request->section_term_id);
            })
        );

        /*
        |--------------------------------------------------------------------------
        | Date Filters
        |--------------------------------------------------------------------------
        */

        $query->when(
            $request->filled('admission_date_from'),
            fn ($q) =>
            $q->whereDate(
                'admission_date',
                '>=',
                $request->admission_date_from
            )
        );

        $query->when(
            $request->filled('admission_date_to'),
            fn ($q) =>
            $q->whereDate(
                'admission_date',
                '<=',
                $request->admission_date_to
            )
        );

        $query->when(
            $request->filled('created_from'),
            fn ($q) =>
            $q->whereDate(
                'created_at',
                '>=',
                $request->created_from
            )
        );

        $query->when(
            $request->filled('created_to'),
            fn ($q) =>
            $q->whereDate(
                'created_at',
                '<=',
                $request->created_to
            )
        );

        /*
        |--------------------------------------------------------------------------
        | Sorting
        |--------------------------------------------------------------------------
        */

        $sortBy = $request->get('sort_by', 'id');

        $sortDirection = $request->get(
            'sort_direction',
            'desc'
        );

        $query->orderBy($sortBy, $sortDirection);

        /*
        |--------------------------------------------------------------------------
        | Result
        |--------------------------------------------------------------------------
        */

        $result = $query
            ->paginate($request->get('per_page', 20))
            ->through(function ($student) {

                return $student->makeHidden([
                    'current_academic_history'
                ]);
            });

        return response()->json([
            'status'  => 'success',
            'message' => 'Records fetched successfully.',
            'data'    => $result
        ], Response::HTTP_OK);
    }
}
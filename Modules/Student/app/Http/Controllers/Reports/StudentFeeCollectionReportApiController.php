<?php

namespace Modules\Student\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Student\Models\StudentFeeSubmission;
use Modules\Student\Models\StudentFeeSubmissionItem;

class StudentFeeCollectionReportApiController extends Controller
{
    public function index(Request $request)
    {
        $query = StudentFeeSubmission::query()
            ->with([
                'student:id,name,phone,father_name',

                'student.currentAcademicHistory.academicYear:id,name',
                'student.currentAcademicHistory.classTerm:id,name',
                'student.currentAcademicHistory.sectionTerm:id,name',

                'academicYear:id,name',
                'classTerm:id,name,group',
                'sectionTerm:id,name,group',
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
            $query->where('year_id', $request->year_id);
        }

        if ($request->filled('from_date')) {
            $query->whereDate(
                'created_at',
                '>=',
                $request->from_date
            );
        }

        if ($request->filled('to_date')) {
            $query->whereDate(
                'created_at',
                '<=',
                $request->to_date
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Result
        |--------------------------------------------------------------------------
        */

        $result = $query
            ->latest()
            ->paginate($request->get('per_page', 20))
            ->through(function ($item) {

                return [
                    'id' => $item->id,

                    'student_id' => $item->student_id,
                    'student_name' => $item->student?->name,
                    'student_phone' => $item->student?->phone,
                    'father_name' => $item->student?->father_name,

                    'academic_year_id' => $item->year_id,
                    'academic_year_name' => $item->student?->currentAcademicHistory?->academicYear?->name,

                    'class_term_id' => $item->class_term_id,
                    'class_name' => $item->student?->currentAcademicHistory?->classTerm?->name,

                    'section_term_id' => $item->section_term_id,
                    'section_name' => $item->student?->currentAcademicHistory?->sectionTerm?->name,

                    'total_amount' => $item->total_amount,
                    'total_discount' => $item->total_discount,
                    'amount_received' => $item->amount_received,

                    'fee_status' => $item->fee_status,
                    'remarks' => $item->remarks,

					'paid_at'	=> $item->paid_at,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => $result
        ]);
    }

    public function daily(Request $request)
    {
        $query = StudentFeeSubmission::query();

        if (
            $request->filled('year_id') &&
            $request->year_id !== 'all'
        ) {
            $query->where('year_id', $request->year_id);
        }

        if ($request->filled('from_date')) {
            $query->whereDate(
                'created_at',
                '>=',
                $request->from_date
            );
        }

        if ($request->filled('to_date')) {
            $query->whereDate(
                'created_at',
                '<=',
                $request->to_date
            );
        }

        $data = $query
            ->selectRaw('DATE(created_at) as date')
            ->selectRaw('SUM(amount_received) as total_collection')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function headWise(Request $request)
    {
        $query = StudentFeeSubmissionItem::query();

        $data = $query
            ->select('fee_structure_id')
            ->selectRaw('SUM(paid_amount) as total_paid')
            ->groupBy('fee_structure_id')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
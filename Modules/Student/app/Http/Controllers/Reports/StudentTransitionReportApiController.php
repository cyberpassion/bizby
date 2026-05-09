<?php

namespace Modules\Student\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Student\Models\StudentTransition;
use Modules\Student\Models\StudentAcademicHistory;

class StudentTransitionReportApiController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => StudentTransition::latest()->paginate(20)
        ]);
    }

    public function academicHistory($id)
    {
        $data = StudentAcademicHistory::query()
            ->where('student_id', $id)
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
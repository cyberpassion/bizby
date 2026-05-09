<?php

namespace Modules\Student\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Student\Models\StudentAcademicHistory;

class StudentStrengthReportApiController extends Controller
{
    public function index(Request $request)
    {
        $data = StudentAcademicHistory::query()
            ->select('class_term_id', 'section_term_id')
            ->selectRaw('COUNT(*) as total_students')
            ->groupBy('class_term_id', 'section_term_id')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
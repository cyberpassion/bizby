<?php

namespace Modules\Student\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Student\Models\StudentFeeSubmission;

class StudentFeeLedgerReportApiController extends Controller
{
    public function show($id)
    {
        $data = StudentFeeSubmission::query()
            ->where('student_id', $id)
            ->with('items')
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
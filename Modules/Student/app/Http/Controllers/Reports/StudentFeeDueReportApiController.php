<?php

namespace Modules\Student\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Student\Models\StudentFeeSubmission;

class StudentFeeDueReportApiController extends Controller
{
    public function index(Request $request)
    {
        $data = StudentFeeSubmission::query()
            ->select(
                'student_id',
                'total_amount',
                'total_discount',
                'amount_received'
            )
            ->selectRaw(
                '(total_amount - total_discount - amount_received) as due_amount'
            )
            ->whereRaw(
                '(total_amount - total_discount - amount_received) > 0'
            )
            ->paginate(20);

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
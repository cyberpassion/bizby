<?php

namespace Modules\Student\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Student\Models\StudentFeeSubmission;

class StudentFeeDefaulterReportApiController extends Controller
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
            ->having('due_amount', '>', 0)
            ->orderByDesc('due_amount')
            ->paginate(20);

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
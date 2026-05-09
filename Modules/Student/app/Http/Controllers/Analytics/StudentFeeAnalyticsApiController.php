<?php

namespace Modules\Student\Http\Controllers\Analytics;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Student\Models\StudentFeeSubmission;

class StudentFeeAnalyticsApiController extends Controller
{
    public function summary()
    {
        $data = StudentFeeSubmission::query()
            ->selectRaw('SUM(total_amount) as total_payable')
            ->selectRaw('SUM(total_discount) as total_discount')
            ->selectRaw('SUM(amount_received) as total_received')
            ->first();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function trends()
    {
        $data = StudentFeeSubmission::query()
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

    public function collectionVsDue()
    {
        $data = StudentFeeSubmission::query()
            ->selectRaw('SUM(amount_received) as collected')
            ->selectRaw('SUM(total_amount - total_discount - amount_received) as due')
            ->first();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
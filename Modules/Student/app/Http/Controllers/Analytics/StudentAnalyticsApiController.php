<?php

namespace Modules\Student\Http\Controllers\Analytics;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Student\Models\Student;

class StudentAnalyticsApiController extends Controller
{
    public function growth()
    {
        $data = Student::query()
            ->selectRaw('DATE(created_at) as date')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function genderDistribution()
    {
        $data = Student::query()
            ->select('gender')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('gender')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function classDistribution()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Implement using current academic history'
        ]);
    }
}
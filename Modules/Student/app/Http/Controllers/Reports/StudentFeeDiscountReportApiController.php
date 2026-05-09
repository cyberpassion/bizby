<?php

namespace Modules\Student\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Student\Models\StudentFeeDiscount;

class StudentFeeDiscountReportApiController extends Controller
{
    public function index(Request $request)
    {
        $query = StudentFeeDiscount::query();

        if ($request->filled('year_id')) {
            $query->where('year_id', $request->year_id);
        }

        return response()->json([
            'status' => 'success',
            'data' => $query
                ->latest()
                ->paginate(20)
        ]);
    }
}
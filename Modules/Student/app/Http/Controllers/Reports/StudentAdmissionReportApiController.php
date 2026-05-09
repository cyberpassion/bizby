<?php

namespace Modules\Student\Http\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Student\Models\Student;

class StudentAdmissionReportApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->filled('from_date')) {
            $query->whereDate('admission_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('admission_date', '<=', $request->to_date);
        }

        return response()->json([
            'status' => 'success',
            'data' => $query
                ->latest()
                ->paginate(20)
        ]);
    }
}
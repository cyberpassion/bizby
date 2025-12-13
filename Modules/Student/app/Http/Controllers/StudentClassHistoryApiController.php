<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Student\Models\StudentClassHistory;
use App\Http\Controllers\Controller;

class StudentClassHistoryApiController extends Controller
{
    public function index($studentId)
    {
        return StudentClassHistory::where('student_id', $studentId)
            ->orderBy('academic_year', 'desc')
            ->get();
    }

    public function promote(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'academic_level_id' => 'required|exists:academic_levels,id',
            'academic_year' => 'required|string'
        ]);

        $history = StudentClassHistory::create($data);

        return response()->json([
            'message' => 'Student promoted',
            'data' => $history
        ]);
    }
}

<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Student\Models\Student;
use Modules\Student\Models\StudentEducationHistory;

class StudentEducationHistoryApiController extends Controller
{
    public function index($studentId)
    {
        $student = Student::findOrFail($studentId);

        return response()->json([
            'success' => true,
            'message' => 'Education histories fetched successfully',
            'data' => $student->educationHistories,
        ]);
    }

    public function store(Request $request, $studentId)
    {
        $student = Student::findOrFail($studentId);

        $educationHistory = $student
            ->educationHistories()
            ->create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Education history created successfully',
            'data' => $educationHistory,
        ], 201);
    }

    public function show($studentId, $id)
    {
        $educationHistory = StudentEducationHistory::where(
            'student_id',
            $studentId
        )->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Education history fetched successfully',
            'data' => $educationHistory,
        ]);
    }

    public function update(Request $request, $studentId, $id)
    {
        $educationHistory = StudentEducationHistory::where(
            'student_id',
            $studentId
        )->findOrFail($id);

        $educationHistory->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Education history updated successfully',
            'data' => $educationHistory,
        ]);
    }

    public function destroy($studentId, $id)
    {
        $educationHistory = StudentEducationHistory::where(
            'student_id',
            $studentId
        )->findOrFail($id);

        $educationHistory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Education history deleted successfully',
        ]);
    }
}

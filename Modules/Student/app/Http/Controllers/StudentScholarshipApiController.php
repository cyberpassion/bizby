<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Student\Models\Student;
use Modules\Student\Models\StudentScholarship;

class StudentScholarshipApiController extends Controller
{
    public function index($studentId)
    {
        $student = Student::findOrFail($studentId);

        return response()->json([
            'success' => true,
            'message' => 'Scholarships fetched successfully',
            'data' => $student->scholarships,
        ]);
    }

    public function store(Request $request, $studentId)
    {
        $student = Student::findOrFail($studentId);

        $scholarship = $student
            ->scholarships()
            ->create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Scholarship created successfully',
            'data' => $scholarship,
        ], 201);
    }

    public function show($studentId, $id)
    {
        $scholarship = StudentScholarship::where(
            'student_id',
            $studentId
        )->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Scholarship fetched successfully',
            'data' => $scholarship,
        ]);
    }

    public function update(Request $request, $studentId, $id)
    {
        $scholarship = StudentScholarship::where(
            'student_id',
            $studentId
        )->findOrFail($id);

        $scholarship->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Scholarship updated successfully',
            'data' => $scholarship,
        ]);
    }

    public function destroy($studentId, $id)
    {
        $scholarship = StudentScholarship::where(
            'student_id',
            $studentId
        )->findOrFail($id);

        $scholarship->delete();

        return response()->json([
            'success' => true,
            'message' => 'Scholarship deleted successfully',
        ]);
    }
}

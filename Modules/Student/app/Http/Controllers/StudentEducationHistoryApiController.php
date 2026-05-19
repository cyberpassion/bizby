<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Student\Models\Student;
use Modules\Student\Models\StudentEducationHistory;

class StudentEducationHistoryApiController extends Controller
{
    public function index(Student $student)
    {
        return $student->educationHistories;
    }

    public function store(Request $request, Student $student)
    {
        return $student
            ->educationHistories()
            ->create($request->all());
    }

    public function show(Student $student, StudentEducationHistory $educationHistory)
    {
        return $educationHistory;
    }

    public function update(
        Request $request,
        Student $student,
        StudentEducationHistory $educationHistory
    ) {
        $educationHistory->update($request->all());

        return $educationHistory;
    }

    public function destroy(
        Student $student,
        StudentEducationHistory $educationHistory
    ) {
        $educationHistory->delete();

        return response()->json([
            'message' => 'Deleted successfully',
        ]);
    }
}

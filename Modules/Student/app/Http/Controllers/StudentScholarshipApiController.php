<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Student\Models\Student;
use Modules\Student\Models\StudentScholarship;

class StudentScholarshipApiController extends Controller
{
    public function index(Student $student)
    {
        return $student->scholarships;
    }

    public function store(Request $request, Student $student)
    {
        return $student
            ->scholarships()
            ->create($request->all());
    }

    public function show(
        Student $student,
        StudentScholarship $scholarship
    ) {
        return $scholarship;
    }

    public function update(
        Request $request,
        Student $student,
        StudentScholarship $scholarship
    ) {
        $scholarship->update($request->all());

        return $scholarship;
    }

    public function destroy(
        Student $student,
        StudentScholarship $scholarship
    ) {
        $scholarship->delete();

        return response()->json([
            'message' => 'Deleted successfully',
        ]);
    }
}

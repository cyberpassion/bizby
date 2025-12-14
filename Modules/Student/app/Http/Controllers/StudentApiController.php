<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Student\Models\Student;
use Modules\Student\Models\StudentAcademicHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use Illuminate\Http\Response;

class StudentApiController extends Controller
{
    /**
     * Store a new student with academic history
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // --- 1. Create Student using dynamic fillable ---
            $student = Student::create($request->only(Schema::getColumnListing('students')));

            // --- 2. Add Academic History ---
            StudentAcademicHistory::create([
                'student_id' => $student->id,
                'year_id' => $request->year,
                'class_term_id' => $request->class,
                'section_term_id' => $request->section,
                'is_current' => true,
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Student added successfully',
                'data' => $student->load('academicHistories')
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to add student: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Optional: List all students with current academic history
     */
    public function index()
    {
        $students = Student::with('currentAcademicHistory.academicYear')->get();

        return response()->json([
            'status' => 'success',
            'data' => $students
        ], Response::HTTP_OK);
    }
}

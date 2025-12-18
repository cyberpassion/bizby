<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use Modules\Student\Models\Student;
use Modules\Student\Models\StudentAcademicHistory;

class StudentApiController extends Controller
{
    /**
     * List all students with current academic history
     */
    public function index()
    {
        $result = Student::get();

		return response()->json([
    	    'status'  => 'success',
        	'message' => 'Records fetched successfully.',
	        'data'    => ['data'=>$result]
    	], Response::HTTP_OK);
    }

    /**
     * Store a new student with academic history
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // 1. Create student safely
            $student = Student::create(
                $request->only(Schema::getColumnListing('students'))
            );

            // 2. Create academic history
            StudentAcademicHistory::create([
                'student_id'       => $student->id,
                'year_id'          => $request->year,
                'class_term_id'    => $request->class,
                'section_term_id'  => $request->section,
                'is_current'       => true,
            ]);

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => 'Student added successfully',
                'data'    => $student->load('academicHistories')
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show a single student
     */
    public function show($id)
    {
        $student = Student::with(['currentAcademicHistory','currentAcademicHistory.classTerm','currentAcademicHistory.sectionTerm'])->find($id);

        if (!$student) {
            return response()->json([
                'status' => 'error',
                'message' => 'Student not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => 'success',
            'data' => $student
        ], Response::HTTP_OK);
    }

    /**
     * Update student basic info
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $student = Student::find($id);

            if (!$student) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Student not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update student table only
            $student->update(
                $request->only(Schema::getColumnListing('students'))
            );

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => 'Student updated successfully',
                'data'    => $student
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Change student academic placement (promote / transfer)
     */
    public function changeAcademic(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $student = Student::findOrFail($id);

            // Mark current history as old
            StudentAcademicHistory::where('student_id', $id)
                ->where('is_current', true)
                ->update(['is_current' => false]);

            // Add new academic history
            StudentAcademicHistory::create([
                'student_id'      => $student->id,
                'year_id'         => $request->year,
                'class_term_id'   => $request->class,
                'section_term_id' => $request->section,
                'is_current'      => true,
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Academic history updated'
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete student (soft delete recommended)
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $student = Student::find($id);

            if (!$student) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Student not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Optional: delete histories first
            StudentAcademicHistory::where('student_id', $id)->delete();

            $student->delete(); // soft delete if enabled

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Student deleted successfully'
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

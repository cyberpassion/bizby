<?php

namespace Modules\Student\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use Modules\Student\Models\Student;
use Modules\Student\Models\StudentAcademicHistory;

use Modules\Student\Services\GenerateStudentFeeDuesService;

class StudentApiController extends Controller
{
    /**
     * List all students with current academic history
     */
    /**
	 * List Students
	 */
	public function index(Request $request)
	{
	    $query = Student::query()
    	    ->with([
        	    'currentAcademicHistory.academicYear:id,name',
            	'currentAcademicHistory.classTerm:id,name',
            	'currentAcademicHistory.sectionTerm:id,name',
	        ]);

    	/*
	    |--------------------------------------------------------------------------
    	| Lightweight Academic Filters
    	|--------------------------------------------------------------------------
	    */

		$query->when(
		    $request->filled('year_id') &&
    		$request->year_id !== 'all',

		    fn ($q) =>
    		$q->whereHas('currentAcademicHistory', function ($sub) use ($request) {
        		$sub->where('year_id', $request->year_id);
    		})
		);

	    $query->when(
		    $request->filled('class_term_id') &&
    		$request->class_term_id !== 'all',

		    fn ($q) =>
    		$q->whereHas('currentAcademicHistory', function ($sub) use ($request) {
        		$sub->where('class_term_id', $request->class_term_id);
    		})
		);

		$query->when(
	    	$request->filled('section_term_id') &&
		    $request->section_term_id !== 'all',

		    fn ($q) =>
    		$q->whereHas('currentAcademicHistory', function ($sub) use ($request) {
        		$sub->where('section_term_id', $request->section_term_id);
    		})
		);

		$query->when(
	    	$request->filled('status') &&
		    $request->status !== 'all',

		    fn ($q) =>
    		$q->where('status', $request->status)
		);

	    /*
    	|--------------------------------------------------------------------------
	    | Lightweight Student Filters
    	|--------------------------------------------------------------------------
    	*/

	    $query->when(
		    $request->filled('status') &&
    		$request->status !== 'all',

		    fn ($q) =>
    		$q->where('status', $request->status)
		);

	    /*
    	|--------------------------------------------------------------------------
	    | Sorting
    	|--------------------------------------------------------------------------
	    */

	    $query->latest();

	    /*
	    |--------------------------------------------------------------------------
    	| Result
   		|--------------------------------------------------------------------------
	    */

	    $result = $query->paginate(
    	    $request->get('per_page', 20)
    	);

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Records fetched successfully.',
	        'data'    => $result
    	], Response::HTTP_OK);
	}

    /**
     * Store a new student with academic history
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            /*
			|--------------------------------------------------------------------------
			| Create Student
			|--------------------------------------------------------------------------
			*/

			$student = Student::create(
			    $request->only(
    			    Schema::getColumnListing('students')
    			)
			);

			/*
			|--------------------------------------------------------------------------
			| Create Academic History
			|--------------------------------------------------------------------------
			*/

			StudentAcademicHistory::create([

			    'student_id'       => $student->id,

			    'year_id'          => $request->year,

			    'class_term_id'    =>
			        explode('_', $request->class)[1] ?? null,

			    'section_term_id'  =>
			        explode('_', $request->section)[1] ?? null,

			    'is_current'       => true,
			]);

			/*
			|--------------------------------------------------------------------------
			| Reload Student
			|--------------------------------------------------------------------------
			*/

			$student->refresh();

			/*
			|--------------------------------------------------------------------------
			| Generate Dues
			|--------------------------------------------------------------------------
			*/

			app(
			    GenerateStudentFeeDuesService::class
			)->handle($student);

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
    public function show(int $id)
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
    public function update(Request $request, int $id)
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
    public function changeAcademic(Request $request, int $id)
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
    public function destroy(int $id)
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

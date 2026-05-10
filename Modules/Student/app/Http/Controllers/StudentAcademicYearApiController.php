<?php

namespace Modules\Student\Http\Controllers;

use Modules\Student\Models\StudentAcademicYear;
use Modules\Shared\Http\Controllers\SharedApiController;
use Illuminate\Http\Request;

class StudentAcademicYearApiController extends SharedApiController
{
    protected $searchable = [];

    protected function model()
    {
        return StudentAcademicYear::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }

	public function studentYears(int $id)
	{
    	$years = \Modules\Student\Models\StudentAcademicHistory::query()

	        ->with([
     	       'academicYear:id,name,start_year,end_year'
        	])

	        ->where('student_id', $id)

	        ->latest()

	        ->get()

	        ->pluck('academicYear')

	        ->unique('id')

	        ->values();

	    return response()->json([
    	    'status' => 'success',
        	'data' => $years,
   		]);
	}

}

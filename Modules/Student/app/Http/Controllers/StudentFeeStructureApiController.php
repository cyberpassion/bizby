<?php

namespace Modules\Student\Http\Controllers;

use Modules\Student\Models\StudentFeeStructure;
use Modules\Shared\Http\Controllers\SharedApiController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentFeeStructureApiController extends SharedApiController
{
    protected $searchable = [];

    protected function model()
    {
        return StudentFeeStructure::class;
    }

    protected function validationRules($id = null)
	{
    	return [
	        'year_id' => ['required', 'exists:student_academic_years,id'],
    	    'class_term_id' => ['required', 'exists:terms,id'],
        	'section_term_id' => ['required', 'exists:terms,id'],

	        'structures' => ['required', 'array', 'min:1'],

    	    'structures.*.head_term_id' => ['required', 'exists:terms,id'],
        	'structures.*.selected_periods' => ['required', 'array'],
    	];
	}

	public function store(Request $request)
	{
    	$validated = $request->validate($this->validationRules());

	    $rows = [];

	    foreach ($validated['structures'] as $structure) {
    	    $rows[] = [
        	    'year_id' => $validated['year_id'],
            	'class_term_id' => $validated['class_term_id'],
	            'section_term_id' => $validated['section_term_id'],
    	        'head_term_id' => $structure['head_term_id'],

	            // derive these if needed
    	        'frequency' => 'monthly',
        	    'amount' => array_sum($structure['selected_periods']),

	            'selected_periods' => json_encode($structure['selected_periods']),
    	        'created_at' => now(),
        	    'updated_at' => now(),
        	];
    	}

	    // ✅ Upsert to respect unique constraint
    	StudentFeeStructure::upsert(
        	$rows,
	        ['year_id', 'class_term_id', 'section_term_id', 'head_term_id'],
    	    ['frequency', 'amount', 'selected_periods', 'updated_at']
    	);

	    return response()->json([
    	    'status' => 'success',
        	'message' => 'Fee structures saved successfully'
	    ], Response::HTTP_CREATED);
	}

}

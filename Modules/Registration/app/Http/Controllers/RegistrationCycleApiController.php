<?php

namespace Modules\Registration\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Registration\Models\RegistrationCycle;
use Modules\Shared\Http\Controllers\SharedApiController;

class RegistrationCycleApiController extends SharedApiController
{
    protected function model()
    {
        return RegistrationCycle::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'registration_type_id' => 'required|exists:registration_types,id',
            'name' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|int',
        ];
    }

	public function store(Request $request)
	{
    	$request->validate([
	        'registration_type_id' => 'required|exists:registration_types,id',
    	    'name' => 'required|string',
	    ]);

	    // 🔥 CHECK IF STEPS EXIST
    	$hasSteps = \Modules\Registration\Models\RegistrationTypeStep::where(
        	'registration_type_id',
	        $request->registration_type_id
    	)->exists();

	    if (!$hasSteps) {
    	    return response()->json([
        	    'status' => 'error',
            	'message' => 'Cannot create cycle. No steps defined for this registration type.'
	        ], 422);
    	}

		// ✅ ACTUAL INSERT (you missed this)
	    $cycle = RegistrationCycle::create($request->only([
	        'registration_type_id',
    	    'name',
        	'start_date',
	        'end_date',
    	    'remark'
    	]));

	    // ✅ proceed
		return response()->json([
    	    'status' => 'success',
        	'message' => 'Registration Cycle Created Successfully.',
	        'data' =>  $cycle
    	]);
	}

}
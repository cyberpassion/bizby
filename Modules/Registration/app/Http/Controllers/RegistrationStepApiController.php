<?php

namespace Modules\Registration\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Registration\Models\RegistrationStep;
use App\Http\Controllers\Controller;

class RegistrationStepApiController extends Controller
{

	public function save(Request $request, int $id)
	{
    	$request->validate([
	        'registration_type_step_id' => 'required|integer',
    	    'data' => 'nullable|array',
	    ]);

	    $registration = \Modules\Registration\Models\Registration::findOrFail($id);

	    // prevent editing after submit
    	if ($registration->registration_status === 'submitted') {
        	return response()->json([
            	'status' => 'error',
            	'message' => 'Application already submitted'
	        ], 422);
    	}

	    $step = RegistrationStep::updateOrCreate(
    	    [
        	    'registration_id' => $id,
            	'registration_type_step_id' => $request->registration_type_step_id
	        ],
    	    [
        	    'data' => $request->data,
            	'is_completed' => true
        	]
    	);

	    return response()->json([
    	    'status' => 'success',
        	'registration_id' => $registration->id,
        	'step' => $step
    	]);
	}

	public function saveInitial(Request $request)
	{
    	$request->validate([
	        'registration_cycle_id' => 'required|integer',
    	    'registration_type_step_id' => 'required|integer',
        	'data' => 'nullable|array',
	    ]);

	    /* -----------------------------------
    	 | 1. CREATE OR FETCH REGISTRATION
    	 -----------------------------------*/
	    $registration = \Modules\Registration\Models\Registration::firstOrCreate(
    	    [
        	    'user_id' => auth()->id(),
            	'registration_cycle_id' => $request->registration_cycle_id,
	        ],
    	    [
        	    'registration_status' => 'draft',
        	]
	    );

	    /* -----------------------------------
    	 | 2. SAVE STEP
	     -----------------------------------*/
    	$step = RegistrationStep::updateOrCreate(
        	[
            	'registration_id' => $registration->id,
	            'registration_type_step_id' => $request->registration_type_step_id
    	    ],
        	[
            	'data' => $request->data,
	            'is_completed' => true
    	    ]
    	);

	    return response()->json([
    	    'status' => 'success',
        	'registration_id' => $registration->id,
	        'step' => $step
    	]);
	}

}

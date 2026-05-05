<?php

namespace Modules\Registration\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Registration\Models\RegistrationTypeStep;
use Modules\Shared\Http\Controllers\SharedApiController;

class RegistrationTypeStepApiController extends SharedApiController
{
    protected function model()
    {
        return RegistrationTypeStep::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'registration_type_id' => 'required|exists:registration_types,id',
            'step_key' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'step_order' => 'required|integer',
            'is_required' => 'boolean',
            'config' => 'nullable|array',
        ];
    }

	public function bulkSave(Request $request)
	{
    	$steps = $request->steps;

	    foreach ($steps as $index => $step) {
    	    \Modules\Registration\Models\RegistrationTypeStep::updateOrCreate(
        	    [
            	    'id' => $step['id'] ?? null,
            	],
	            [
    	            'registration_type_id' => $step['registration_type_id'],
        	        'step_key' => $step['step_key'],
            	    'title' => $step['title'],
	                'step_order' => $index + 1,
    	            'config' => $step['config'],
        	        'is_required' => true,
            	]
        	);
    	}

	    return response()->json(['status' => 'success']);
	}

}
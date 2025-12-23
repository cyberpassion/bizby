<?php

namespace Modules\Shared\Http\Controllers;

use Modules\Shared\Models\Option;
use Modules\Shared\Http\Controllers\SharedApiController;

class OptionApiController extends SharedApiController
{
	protected $searchable = ['group'];

    protected function model()
    {
        return Option::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }

	public function extraStats()
	{
    	return [];
	}

	public function show($key)
    {
        // Try ID first (numeric)
        if (is_numeric($key)) {
            $option = Option::find($key);
        } else {
            // Fetch by name / key
            $option = Option::where('name', $key)->first();
        }

        if (!$option) {
            return response()->json([
                'status' => 'error',
                'message' => 'Option not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $option,
        ]);
    }

	public function group(string $group)
	{
    	$options = Option::where('name', 'like', $group . '_%')
        	->pluck('value', 'name');

	    if ($options->isEmpty()) {
    	    return response()->json([
        	    'status' => 'error',
            	'message' => 'No options found for group',
	        ], 404);
    	}

	    return response()->json([
    	    'status' => 'success',
        	'data'   => $options,
	    ]);
	}

	public function store(\Illuminate\Http\Request $request)
	{
    	$payload = $request->except(['_token']);

	    if (empty($payload)) {
    	    return response()->json([
        	    'status'  => 'error',
            	'message' => 'No options provided',
	        ], 422);
    	}

	    $saved = [];

	    foreach ($payload as $name => $value) {
    	    // Skip invalid keys
        	if (!is_string($name) || $name === '') {
            	continue;
        	}

	        $option = Option::updateOrCreate(
    	        ['name' => $name],
        	    [
            	    'value'    => is_array($value) ? json_encode($value) : $value,
                	'autoload' => $request->input('autoload'), // optional
	            ]
    	    );

	        $saved[$name] = $option->value;
    	}

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Options saved successfully',
        	'data'    => ['data' => $saved],
    	]);
	}

}

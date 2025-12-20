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
            'data'   => ['data'=>$option],
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
        	'data'   => ['data'=>$options],
	    ]);
	}

}

<?php

namespace Modules\Shared\Http\Controllers;
use App\Http\Controllers\Controller;

class FormController extends Controller
{
	public function show($module, $name)
	{
	    // Convert module name to StudlyCase (Consultation, Student, etc.)
	    $moduleName = str($module)->studly();

	    // Full path to JSON form file
    	$path = module_path($moduleName, "Resources/forms/{$name}.json");

	    // Check if file exists
    	if (!file_exists($path)) {
        	return response()->json([
            	'status'  => false,
            	'message' => "Form '{$name}' not found in module '{$moduleName}'.",
	        ], 404);
    	}

	    // Read file
    	$json = file_get_contents($path);

	    // Decode JSON safely
    	$schema = json_decode($json, true);

	    // If JSON is invalid
    	if (json_last_error() !== JSON_ERROR_NONE) {
        	return response()->json([
            	'status'  => false,
	            'message' => "Invalid JSON in form file: {$name}.json",
    	        'error'   => json_last_error_msg(),
        	], 500);
    	}

	    // Success response
    	return response()->json([
        	'status' => true,
        	'schema' => $schema,
    	]);
	}
}
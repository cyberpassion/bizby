<?php

namespace Modules\Shared\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

abstract class SharedApiController extends Controller
{
    /**
     * Return the model class for this controller
     */
    abstract protected function model();

    /**
     * Return validation rules for store/update
     */
    abstract protected function validationRules($id = null);

    /**
     * List resources
     */
    public function index()
    {
        $model = $this->model();
        $data = $model::paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Records fetched successfully.',
            'data' => $data
        ], Response::HTTP_OK);
    }

    /**
     * Show single resource
     */
    public function show($id)
    {
        $model = $this->model()::find($id);

        if (!$model) {
            return response()->json([
                'status' => 'error',
                'message' => 'Resource not found.',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Record fetched successfully.',
            'data' => $model
        ], Response::HTTP_OK);
    }

    /**
     * Store resource
     */
    public function store(Request $request)
    {
        //$validated = $request->validate($this->validationRules());
		$validated = $request->all();
        $model = $this->model();
        $resource = $model::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Record created successfully.',
            'data' => $resource
        ], Response::HTTP_CREATED);
    }

    /**
     * Update resource
     */
    public function update(Request $request, $id)
    {
        $modelInstance = $this->model()::find($id);

        if (!$modelInstance) {
            return response()->json([
                'status' => 'error',
                'message' => 'Resource not found.',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        // Only update fillable fields
        //$data = $request->only($modelInstance->getFillable());
		$data = $request->all();

        // Validate update rules
        $validator = Validator::make($data, $this->validationRules($id));

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
                'data' => null
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $modelInstance->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Record updated successfully.',
            'data' => $modelInstance
        ], Response::HTTP_OK);
    }

    /**
     * Delete resource
     */
    public function destroy($id)
    {
        $model = $this->model()::find($id);

        if (!$model) {
            return response()->json([
                'status' => 'error',
                'message' => 'Resource not found.',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }

        $model->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Resource deleted successfully.',
            'data' => null
        ], Response::HTTP_OK);
    }

	/**
	 * Universal stats function for all modules
	 *
	 * Usage:
	 * - /api/consultation/stats
	 * - /api/students/stats
	 * - /api/fees/stats
	 *
	 * Controller can override:
	 * - fields for charts
	 * - fields for sum
	 * - custom overview
	 */
	public function stats(Request $request)
	{
    	$model = $this->model();

	    // Step 1: Basic Count
    	$total = $model::count();

	    // Step 2: Optional chart fields (you can pass via query or controller override)
    	// Example: /api/consultation/stats?charts=gender,channel
    	$chartFields = explode(',', $request->get('charts', ''));

	    $charts = [];
    	foreach ($chartFields as $field) {
        	if (!$field) continue;
        	$charts[$field] = $this->getChartCounts($model, $field);
    	}

	    // Step 3: Optional SUM fields
    	// Example: /api/consultation/stats?sum=amount,fee
    	$sumFields = explode(',', $request->get('sum', ''));

	    $sums = [];
    	foreach ($sumFields as $field) {
        	if (!$field) continue;
        	$sums[$field] = $model::sum($field);
    	}

	    // Step 4: Base overview
    	$overview = [
        	'total_records' => $total,
    	];

	    // Step 5: Allow child controller to inject extra overview
    	if (method_exists($this, 'extraStats')) {
        	$overview = array_merge($overview, $this->extraStats());
    	}

	    return response()->json([
    	    'status' => 'success',
        	'message' => 'Stats generated successfully.',
	        'data' => [
    	        'overview' => $overview,
        	    'charts' => $charts,
            	'sums' => $sums
       		]
	    ], Response::HTTP_OK);
	}

	/**
	 * Universal chart helper for all modules
	 */
	protected function getChartCounts($model, $field)
	{
    	return $model::select($field)
        	->selectRaw('COUNT(*) as total')
        	->groupBy($field)
        	->pluck('total', $field)
        	->toArray();
	}

}

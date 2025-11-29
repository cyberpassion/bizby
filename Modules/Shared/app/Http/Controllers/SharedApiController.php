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
        $validated = $request->validate($this->validationRules());
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
        $data = $request->only($modelInstance->getFillable());

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

}

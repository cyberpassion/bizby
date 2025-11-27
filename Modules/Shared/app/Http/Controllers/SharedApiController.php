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
            'success' => true,
            'data' => $data
        ], Response::HTTP_OK);
    }

    /**
     * Show single resource
     */
    public function show($id)
    {
        $model = $this->model()::with(['consultant'])->find($id);

        if (!$model) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'data' => $model
        ], Response::HTTP_OK);
    }

    /**
     * Store resource
     */
    public function store(Request $request)
    {
        $model = $this->model();
        $validated = $request->validate($this->validationRules());
        $resource = $model::create($validated);

        return response()->json([
            'success' => true,
            'data' => $resource
        ], Response::HTTP_CREATED);
    }

    /**
     * Update resource
     */
    public function update(Request $request, $id)
    {
        $model = $this->model()::find($id);

        if (!$model) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);
        }

        // Dynamic fillable
        $data = $request->only($model->getFillable());

        // Validate critical fields
        $validator = Validator::make($data, $this->validationRules($id));

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $model->update($data);

        return response()->json([
            'success' => true,
            'data' => $model
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
                'success' => false,
                'message' => 'Resource not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $model->delete();

        return response()->json([
            'success' => true,
            'message' => 'Resource deleted successfully'
        ], Response::HTTP_OK);
    }
}

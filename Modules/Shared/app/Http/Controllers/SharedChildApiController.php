<?php

namespace Modules\Shared\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

abstract class SharedChildApiController extends Controller
{
    /**
     * Required:
     * parentModel(): return Lead::class, Tenant::class, etc.
     * childModel(): return LeadFollowup::class, TenantUser::class, etc.
     * validationRules(): return validation array
     */
    abstract protected function parentModel();
    abstract protected function childModel();
    abstract protected function validationRules($id = null);

    /**
     * Helper to get parent by ID
     */
    protected function getParent($parentId)
    {
        $parent = $this->parentModel()::find($parentId);

        if (!$parent) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Parent resource not found.',
                'data'    => null
            ], Response::HTTP_NOT_FOUND);
        }

        return $parent;
    }

    /**
     * List child resources
     */
    public function index($parentId, Request $request)
    {
        $parent = $this->parentModel()::find($parentId);

        if (!$parent) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Parent resource not found.',
                'data'    => null
            ], Response::HTTP_NOT_FOUND);
        }

        $relationName = $this->relationName();

        $data = $parent->$relationName()->paginate(20);

        return response()->json([
            'status'  => 'success',
            'message' => 'Child records fetched successfully.',
            'data'    => $data
        ], Response::HTTP_OK);
    }

    /**
     * Show a single child record
     */
    public function show($parentId, $childId)
    {
        $parent = $this->parentModel()::find($parentId);
        if (!$parent) return $this->parentNotFound();

        $child = $this->childModel()::where($this->parentKey(), $parentId)->find($childId);

        if (!$child) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Child resource not found.',
                'data'    => null
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Child record fetched successfully.',
            'data'    => $child
        ], Response::HTTP_OK);
    }

    /**
     * Store child resource
     */
    public function store($parentId, Request $request)
    {
        $parent = $this->parentModel()::find($parentId);
        if (!$parent) return $this->parentNotFound();

        $data = $request->all();

        // attach parent foreign key
        $data[$this->parentKey()] = $parentId;

        $validator = Validator::make($data, $this->validationRules());

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
                'data'    => null
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $child = $this->childModel()::create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Child record created successfully.',
            'data'    => $child
        ], Response::HTTP_CREATED);
    }

    /**
     * Update child resource
     */
    public function update($parentId, $childId, Request $request)
    {
        $parent = $this->parentModel()::find($parentId);
        if (!$parent) return $this->parentNotFound();

        $child = $this->childModel()::where($this->parentKey(), $parentId)->find($childId);

        if (!$child) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Child resource not found.',
                'data'    => null
            ], Response::HTTP_NOT_FOUND);
        }

        $data = $request->all();
        $validator = Validator::make($data, $this->validationRules($childId));

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
                'data'    => null
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $child->update($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Child record updated successfully.',
            'data'    => $child
        ], Response::HTTP_OK);
    }

    /**
     * Delete child resource
     */
    public function destroy($parentId, $childId)
    {
        $parent = $this->parentModel()::find($parentId);
        if (!$parent) return $this->parentNotFound();

        $child = $this->childModel()::where($this->parentKey(), $parentId)->find($childId);

        if (!$child) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Child resource not found.',
                'data'    => null
            ], Response::HTTP_NOT_FOUND);
        }

        $child->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Child resource deleted successfully.',
            'data'    => null
        ], Response::HTTP_OK);
    }

    /**
     * Parent key helper
     * Defaults to: lead_id, tenant_id etc.
     */
    protected function parentKey()
    {
        return strtolower(class_basename($this->parentModel())) . '_id';
    }

    /**
     * Relation name must match model relation
     * Controller can override if needed
     */
    protected function relationName()
    {
        return Str::plural(strtolower(class_basename($this->childModel())));
    }

    /**
     * reusable parent not found response
     */
    protected function parentNotFound()
    {
        return response()->json([
            'status'  => 'error',
            'message' => 'Parent resource not found.',
            'data'    => null
        ], Response::HTTP_NOT_FOUND);
    }
}

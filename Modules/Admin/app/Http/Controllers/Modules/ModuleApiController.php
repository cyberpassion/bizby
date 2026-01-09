<?php

namespace Modules\Admin\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\Modules\Module;

class ModuleApiController extends Controller
{
    /**
     * List all modules in the catalog.
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data'   => Module::orderBy('name')->get(),
        ]);
    }

    /**
     * Create a new module.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'key'         => 'required|string|unique:modules,key',
            'name'        => 'required|string',
            'description' => 'nullable|string',
            'price'       => 'nullable|numeric|min:0',
            'is_billable' => 'boolean',
            'is_core'     => 'boolean',
        ]);

        $module = Module::create($data);

        return response()->json([
            'status' => 'success',
            'data'   => $module,
        ], 201);
    }

    /**
     * Update module details.
     */
    public function update(Request $request, int $id)
    {
        $module = Module::findOrFail($id);

        $data = $request->validate([
            'name'        => 'sometimes|required|string',
            'description' => 'nullable|string',
            'price'       => 'nullable|numeric|min:0',
            'is_billable' => 'boolean',
            'is_core'     => 'boolean',
        ]);

        $module->update($data);

        return response()->json([
            'status' => 'success',
            'data'   => $module,
        ]);
    }

	public function show(int $id)
	{
    	$module = Module::findOrFail($id);

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Record fetched successfully.',
        	'data'    => $module,
	    ]);
	}

    /**
     * Toggle module active status.
     */
    public function toggle(int $id)
    {
        $module = Module::findOrFail($id);

        $module->update([
            'is_active' => ! $module->is_active,
        ]);

        return response()->json([
            'status' => 'success',
            'data'   => [
                'id'        => $module->id,
                'is_active'=> $module->is_active,
            ],
        ]);
    }
}

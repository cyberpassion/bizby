<?php

namespace Modules\Admin\Http\Controllers\Addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\Addons\Addon;

class AddonApiController extends Controller
{
    /**
     * List all addons in the catalog.
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data'   => Addon::orderBy('name')->get(),
        ]);
    }

    /**
     * Create a new addon.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'key'           => 'required|string|unique:addons,key',
            'name'          => 'required|string',
            'description'   => 'nullable|string',
            'price'         => 'nullable|numeric|min:0',
            'billing_cycle' => 'required|in:monthly,yearly',
        ]);

        $addon = Addon::create($data);

        return response()->json([
            'status' => 'success',
            'data'   => $addon,
        ], 201);
    }

    /**
     * Update addon details.
     */
    public function update(Request $request, int $id)
    {
        $addon = Addon::findOrFail($id);

        $data = $request->validate([
            'name'          => 'sometimes|required|string',
            'description'   => 'nullable|string',
            'price'         => 'nullable|numeric|min:0',
            'billing_cycle' => 'in:monthly,yearly',
        ]);

        $addon->update($data);

        return response()->json([
            'status' => 'success',
            'data'   => $addon,
        ]);
    }

    /**
     * Show addon details.
     */
    public function show(int $id)
    {
        $addon = Addon::findOrFail($id);

        return response()->json([
            'status'  => 'success',
            'message' => 'Record fetched successfully.',
            'data'    => $addon,
        ]);
    }

    /**
     * Toggle addon active status.
     */
    public function toggle(int $id)
    {
        $addon = Addon::findOrFail($id);

        $addon->update([
            'is_active' => ! $addon->is_active,
        ]);

        return response()->json([
            'status' => 'success',
            'data'   => [
                'id'         => $addon->id,
                'is_active'  => $addon->is_active,
            ],
        ]);
    }
}

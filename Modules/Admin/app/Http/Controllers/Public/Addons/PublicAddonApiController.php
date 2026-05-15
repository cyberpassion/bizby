<?php

namespace Modules\Admin\Http\Controllers\Public\Addons;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Admin\Models\Addons\Addon;

class PublicAddonApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Addon::query()
            ->where('is_active', 1);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        return response()->json([
            'success' => true,
            'data' => $query
                ->latest()
                ->paginate(20)
        ]);
    }

    public function show($id)
    {
        $addon = Addon::where('is_active', 1)
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $addon
        ]);
    }
}
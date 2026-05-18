<?php

namespace Modules\Admin\Http\Controllers\Public\Modules;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\Modules\Module;

class PublicModuleApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Module::query()
            ->where('is_active', 1);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        return response()->json([
            'success' => true,
            'data' => $query
                ->latest()
                ->paginate(50),
        ]);
    }

    public function show($id)
    {
        $module = Module::where('is_active', 1)
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $module,
        ]);
    }
}

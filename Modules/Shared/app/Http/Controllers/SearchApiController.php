<?php

namespace Modules\Shared\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Shared\Services\SearchRegistry;

class SearchApiController extends Controller
{
    public function search(Request $request, string $module)
    {
        $query = trim((string) $request->query('q'));

        if ($query === '') {
            return response()->json([
                'status'  => 'error',
                'message' => 'Search query missing',
            ], 422);
        }

        $handler = SearchRegistry::resolve($module);

        if (!$handler || !is_callable($handler)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Invalid module',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $handler($query, $request), // ✅ CALLABLE
        ]);
    }
}

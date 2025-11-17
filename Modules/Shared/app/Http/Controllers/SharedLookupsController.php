<?php

namespace Modules\Shared\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Shared\Services\LookupRegistry;

class SharedLookupsController extends Controller
{
    public function get($key)
    {
        $data = LookupRegistry::get($key);

        if ($data === null) {
            return response()->json([
                'status' => false,
                'message' => "Lookup '{$key}' not found"
            ], 404);
        }

        return response()->json([
            'status' => true,
            'key' => $key,
            'data' => $data
        ]);
    }
}

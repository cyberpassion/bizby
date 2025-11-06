<?php

namespace Modules\Shared\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Shared\Services\SharedResourceService;

class SharedResourceController extends Controller
{
    public function get($key)
    {
        $options = SharedResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
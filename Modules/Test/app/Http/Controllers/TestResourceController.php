<?php

namespace Modules\Test\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Test\Services\TestResourceService;

class TestResourceController extends Controller
{
    public function get($key)
    {
        $options = TestResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
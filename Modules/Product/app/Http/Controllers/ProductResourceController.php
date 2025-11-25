<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Product\Services\ProductResourceService;

class ProductResourceController extends Controller
{
    public function get($key)
    {
        $options = ProductResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
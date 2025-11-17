<?php

namespace Modules\Saleservice\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Saleservice\Services\SaleserviceResourceService;

class SaleserviceResourceController extends Controller
{
    public function get($key)
    {
        $options = SaleserviceResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
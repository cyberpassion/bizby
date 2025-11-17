<?php

namespace Modules\Vendor\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Vendor\Services\VendorResourceService;

class VendorResourceController extends Controller
{
    public function get($key)
    {
        $options = VendorResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
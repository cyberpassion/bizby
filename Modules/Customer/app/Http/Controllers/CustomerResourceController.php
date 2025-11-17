<?php

namespace Modules\Customer\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Customer\Services\CustomerResourceService;

class CustomerResourceController extends Controller
{
    public function get($key)
    {
        $options = CustomerResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
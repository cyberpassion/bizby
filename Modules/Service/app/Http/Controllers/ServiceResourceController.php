<?php

namespace Modules\Service\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Service\Services\ServiceResourceService;

class ServiceResourceController extends Controller
{
    public function get($key)
    {
        $options = ServiceResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
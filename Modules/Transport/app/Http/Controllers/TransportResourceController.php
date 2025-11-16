<?php

namespace Modules\Transport\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Transport\Services\TransportResourceService;

class TransportResourceController extends Controller
{
    public function get($key)
    {
        $options = TransportResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
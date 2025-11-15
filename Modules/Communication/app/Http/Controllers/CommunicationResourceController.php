<?php

namespace Modules\Communication\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Communication\Services\CommunicationResourceService;

class CommunicationResourceController extends Controller
{
    public function get($key)
    {
        $options = CommunicationResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
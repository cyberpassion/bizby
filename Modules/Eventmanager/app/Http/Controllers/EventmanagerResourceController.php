<?php

namespace Modules\Eventmanager\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Eventmanager\Services\EventmanagerResourceService;

class EventmanagerResourceController extends Controller
{
    public function get($key)
    {
        $options = EventmanagerResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
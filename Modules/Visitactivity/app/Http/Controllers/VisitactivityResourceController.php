<?php

namespace Modules\Visitactivity\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Visitactivity\Services\VisitactivityResourceService;

class VisitactivityResourceController extends Controller
{
    public function get($key)
    {
        $options = VisitactivityResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
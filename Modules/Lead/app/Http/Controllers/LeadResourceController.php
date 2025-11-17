<?php

namespace Modules\Lead\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Lead\Services\LeadResourceService;

class LeadResourceController extends Controller
{
    public function get($key)
    {
        $options = LeadResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
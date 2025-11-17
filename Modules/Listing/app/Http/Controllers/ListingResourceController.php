<?php

namespace Modules\Listing\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Listing\Services\ListingResourceService;

class ListingResourceController extends Controller
{
    public function get($key)
    {
        $options = ListingResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
<?php

namespace Modules\Subscription\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Subscription\Services\SubscriptionResourceService;

class SubscriptionResourceController extends Controller
{
    public function get($key)
    {
        $options = SubscriptionResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
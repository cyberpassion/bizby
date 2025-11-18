<?php

namespace Modules\Booking\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Booking\Services\BookingResourceService;

class BookingResourceController extends Controller
{
    public function get($key)
    {
        $options = BookingResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
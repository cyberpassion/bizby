<?php

namespace Modules\Leaveapplication\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Leaveapplication\Services\LeaveapplicationResourceService;

class LeaveapplicationResourceController extends Controller
{
    public function get($key)
    {
        $options = LeaveapplicationResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
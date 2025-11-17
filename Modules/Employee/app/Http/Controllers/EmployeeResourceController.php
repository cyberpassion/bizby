<?php

namespace Modules\Employee\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\eEmployee\Services\EmployeeResourceService;

class EmployeeResourceController extends Controller
{
    public function get($key)
    {
        $options = EmployeeResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
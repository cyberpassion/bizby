<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Admin\Services\AdminResourceService;

class AdminResourceController extends Controller
{
    public function get($key)
    {
        $options = AdminResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
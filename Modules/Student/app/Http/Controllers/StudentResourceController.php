<?php

namespace Modules\Student\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Student\Services\StudentResourceService;

class StudentResourceController extends Controller
{
    public function get($key)
    {
        $options = StudentResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
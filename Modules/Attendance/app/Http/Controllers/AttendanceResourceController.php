<?php

namespace Modules\Attendance\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Attendance\Services\AttendanceResourceService;

class AttendanceResourceController extends Controller
{
    public function get($key)
    {
        $options = AttendanceResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
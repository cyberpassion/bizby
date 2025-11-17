<?php

namespace Modules\Timetable\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Timetable\Services\TimetableResourceService;

class TimetableResourceController extends Controller
{
    public function get($key)
    {
        $options = TimetableResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
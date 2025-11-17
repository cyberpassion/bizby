<?php

namespace Modules\Meetingmanager\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Meetingmanager\Services\MeetingmanagerResourceService;

class MeetingmanagerResourceController extends Controller
{
    public function get($key)
    {
        $options = MeetingmanagerResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
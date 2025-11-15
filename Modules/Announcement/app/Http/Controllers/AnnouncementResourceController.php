<?php

namespace Modules\Announcement\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Announcement\Services\AnnouncementResourceService;

class AnnouncementResourceController extends Controller
{
    public function get($key)
    {
        $options = AnnouncementResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
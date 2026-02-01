<?php

namespace Modules\Shared\Http\Controllers\Navigations;

use Illuminate\Routing\Controller;
use Modules\Shared\Services\Navigations\NavigationService;

class NavigationApiController extends Controller
{
    public function sidebar()
    {
        return response()->json(['data' => NavigationService::sidebar()]);
    }

    public function header()
    {
        return response()->json(['data' => NavigationService::header()]);
    }

    public function module($module)
    {
        return response()->json(['data' => NavigationService::module($module)]);
    }

    public function item($module, $id)
    {
        return response()->json(['data' => NavigationService::item($module, $id)]);
    }
}

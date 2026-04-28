<?php
namespace Modules\Shared\Http\Controllers\Navigations;

use Modules\Shared\Services\Navigations\NavigationService;
use Illuminate\Http\Response;

class NavigationApiController
{
    public function sidebar()
    {
		return response()->json([
            'status' => 'success',
            'message' => 'Sidebar fetched successfully.',
            'data' => NavigationService::sidebar()
        ], Response::HTTP_OK);
    }

    public function header()
    {
		return response()->json([
            'status' => 'success',
            'message' => 'Header fetched successfully.',
            'data' => NavigationService::header()
        ], Response::HTTP_OK);
    }

    public function module(string $module)
    {
		return response()->json([
            'status' => 'success',
            'message' => 'Module fetched successfully.',
            'data' => NavigationService::module($module)
        ], Response::HTTP_OK);
    }

    public function item(string $module, string $action, string|int|null $id = null)
    {
        return response()->json([
            'status'  => 'success',
            'message' => 'Item fetched successfully.',
            'data'    => NavigationService::item($module, $action, $id),
        ], Response::HTTP_OK);
    }
}

<?php

namespace Modules\Library\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Library\Services\LibraryResourceService;

class LibraryResourceController extends Controller
{
    public function get($key)
    {
        $options = LibraryResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
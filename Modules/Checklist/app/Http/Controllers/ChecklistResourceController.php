<?php

namespace Modules\Checklist\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Checklist\Services\ChecklistResourceService;

class ChecklistResourceController extends Controller
{
    public function get($key)
    {
        $options = ChecklistResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
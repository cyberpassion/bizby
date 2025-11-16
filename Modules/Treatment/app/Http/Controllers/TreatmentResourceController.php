<?php

namespace Modules\Treatment\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Treatment\Services\TreatmentResourceService;

class TreatmentResourceController extends Controller
{
    public function get($key)
    {
        $options = TreatmentResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
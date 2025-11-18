<?php

namespace Modules\Survey\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Survey\Services\SurveyResourceService;

class SurveyResourceController extends Controller
{
    public function get($key)
    {
        $options = SurveyResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
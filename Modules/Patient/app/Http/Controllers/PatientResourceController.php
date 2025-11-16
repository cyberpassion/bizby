<?php

namespace Modules\Patient\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Patient\Services\PatientResourceService;

class PatientResourceController extends Controller
{
    public function get($key)
    {
        $options = PatientResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
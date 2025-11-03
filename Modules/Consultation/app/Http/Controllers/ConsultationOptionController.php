<?php

namespace Modules\Consultation\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Consultation\Services\ConsultationOptionService;

class ConsultationOptionController extends Controller
{
    public function get($key)
    {
        $options = ConsultationOptionService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
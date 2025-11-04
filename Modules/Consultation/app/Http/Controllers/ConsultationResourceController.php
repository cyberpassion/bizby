<?php

namespace Modules\Consultation\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Consultation\Services\ConsultationResourceService;

class ConsultationResourceController extends Controller
{
    public function get($key)
    {
        $options = ConsultationResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
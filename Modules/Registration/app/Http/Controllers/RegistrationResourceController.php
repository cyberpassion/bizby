<?php

namespace Modules\Registration\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Registration\Services\RegistrationResourceService;

class RegistrationResourceController extends Controller
{
    public function get($key)
    {
        $options = RegistrationResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
<?php

namespace Modules\Signup\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Signup\Services\SignupResourceService;

class SignupResourceController extends Controller
{
    public function get($key)
    {
        $options = SignupResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
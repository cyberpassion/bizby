<?php

namespace Modules\Contact\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Contact\Services\ContactResourceService;

class ContactResourceController extends Controller
{
    public function get($key)
    {
        $options = ContactResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
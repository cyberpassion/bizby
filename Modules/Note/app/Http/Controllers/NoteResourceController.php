<?php

namespace Modules\Note\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Note\Services\NoteResourceService;

class NoteResourceController extends Controller
{
    public function get($key)
    {
        $options = NoteResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
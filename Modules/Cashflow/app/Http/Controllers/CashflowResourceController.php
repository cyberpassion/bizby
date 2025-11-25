<?php

namespace Modules\Cashflow\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Cashflow\Services\CashflowResourceService;

class CashflowResourceController extends Controller
{
    public function get($key)
    {
        $options = CashflowResourceService::get($key);

        if (!$options) {
            return response()->json(['error' => 'Invalid key'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $options,
        ]);
    }
}
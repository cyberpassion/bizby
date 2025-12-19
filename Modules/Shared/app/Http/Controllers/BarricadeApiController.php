<?php

namespace Modules\Shared\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Modules\Shared\Services\BarricadeService;

class BarricadeApiController extends Controller
{
    public function get(string $key)
    {
        $result = BarricadeService::evaluate($key);

        return response()->json(['status'=>'success', 'data' => $result], Response::HTTP_OK);
    }
}

<?php

namespace Modules\Shared\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Shared\Services\AI\AIOrchestrator;
use Modules\Shared\Services\AI\AIService;

class AIApiController extends Controller
{
    public function ask(Request $request, AIService $ai)
    {
        $request->validate([
            'prompt' => 'required|string',
        ]);

        $response = app(AIOrchestrator::class)
            ->handle(
                $request->prompt,
                auth()->user()
            );

        return response()->json($response);
    }
}

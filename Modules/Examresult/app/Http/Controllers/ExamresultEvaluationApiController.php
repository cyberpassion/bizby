<?php

namespace Modules\Examresult\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Examresult\Models\ExamresultEvaluation;

class ExamresultEvaluationApiController extends Controller
{
    /**
     * List evaluations
     * Optional: ?group_code=2024_ANNUAL
     */
    public function index(Request $request)
    {
        $query = ExamresultEvaluation::query();

        if ($request->filled('group_code')) {
            $query->where('group_code', $request->group_code);
        }

        return response()->json([
            'status' => 'success',
            'data' => $query
                ->with('components')
                ->orderBy('sequence')
                ->get(),
        ]);
    }

    /**
     * Show single evaluation with components
     */
    public function show($id)
    {
        $evaluation = ExamresultEvaluation::with('components')
            ->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $evaluation,
        ]);
    }
}

<?php

namespace Modules\Examresult\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Examresult\Models\ExamresultEvaluation;
use Modules\Examresult\Models\ExamresultEvaluationResult;

class ExamresultResultApiController extends Controller
{
    /**
     * Get results for a single evaluation
     */
    public function evaluationResults($evaluationId)
    {
        $results = ExamresultEvaluationResult::where('evaluation_id', $evaluationId)
            ->with(['component', 'entity'])
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $results,
        ]);
    }

    /**
     * Get combined results using group_code (annual report input)
     */
    public function groupResults(Request $request)
    {
        $request->validate([
            'group_code' => 'required|string',
        ]);

        $evaluationIds = ExamresultEvaluation::where(
            'group_code',
            $request->group_code
        )->pluck('id');

        $results = ExamresultEvaluationResult::whereIn(
                'evaluation_id',
                $evaluationIds
            )
            ->with(['component', 'entity'])
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $results,
        ]);
    }
}

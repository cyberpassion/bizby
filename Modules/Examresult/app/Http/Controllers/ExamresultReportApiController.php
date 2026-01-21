<?php

namespace Modules\Examresult\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Examresult\Models\ExamresultEvaluationResult;

class ExamresultReportApiController extends Controller
{
    public function student($id)
    {
        return ExamresultEvaluationResult::where('entity_id', $id)
            ->with(['evaluation', 'component'])
            ->get();
    }

    public function evaluationSummary($id)
    {
        return ExamresultEvaluationResult::where('evaluation_id', $id)
            ->selectRaw('
                entity_id,
                SUM(score) as total_score,
                SUM(max_score) as total_max
            ')
            ->groupBy('entity_id')
            ->get();
    }

    public function topPerformers($id)
    {
        return ExamresultEvaluationResult::where('evaluation_id', $id)
            ->orderByDesc('score')
            ->limit(10)
            ->get();
    }

    public function entity($type, $id)
    {
        return ExamresultEvaluationResult::where('entity_type', $type)
            ->where('entity_id', $id)
            ->with(['evaluation','component'])
            ->get();
    }

    public function progress()
    {
        return ExamresultEvaluationResult::selectRaw('
            entity_id,
            AVG(score) as avg_score
        ')
        ->groupBy('entity_id')
        ->get();
    }
}

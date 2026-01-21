<?php

namespace Modules\Examresult\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Examresult\Models\ExamresultEvaluationResult;

class ExamresultResultApiController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'evaluation_id' => 'required|integer',
            'evaluation_component_id' => 'nullable|integer',
            'entity_id' => 'required|integer',
            'entity_type' => 'required|string',
            'score' => 'nullable|numeric',
            'max_score' => 'nullable|numeric',
            'grade' => 'nullable|string',
            'result_status' => 'nullable|string',
        ]);

        return ExamresultEvaluationResult::updateOrCreate(
            [
                'evaluation_id' => $data['evaluation_id'],
                'evaluation_component_id' => $data['evaluation_component_id'] ?? null,
                'entity_id' => $data['entity_id'],
                'entity_type' => $data['entity_type'],
            ],
            $data
        );
    }

    public function bulkStore(Request $request)
    {
        $items = $request->validate([
            'items' => 'required|array',
            'items.*.evaluation_id' => 'required',
            'items.*.entity_id' => 'required',
            'items.*.entity_type' => 'required',
        ])['items'];

        foreach ($items as $item) {
            ExamresultEvaluationResult::updateOrCreate(
                [
                    'evaluation_id' => $item['evaluation_id'],
                    'evaluation_component_id' => $item['evaluation_component_id'] ?? null,
                    'entity_id' => $item['entity_id'],
                    'entity_type' => $item['entity_type'],
                ],
                $item
            );
        }

        return ['status' => 'ok'];
    }

    public function evaluationResults($id)
    {
        return ExamresultEvaluationResult::where('evaluation_id', $id)
            ->with(['component', 'entity'])
            ->get();
    }

    public function groupResults(Request $request)
    {
        $evaluationIds = \Modules\Examresult\Models\ExamresultEvaluation::where(
            'group_code', $request->group_code
        )->pluck('id');

        return ExamresultEvaluationResult::whereIn('evaluation_id', $evaluationIds)
            ->with(['component', 'entity'])
            ->get();
    }

    public function import(Request $request)
    {
        return ['status' => 'import not implemented yet'];
    }

    public function export(Request $request)
    {
        return ['status' => 'export not implemented yet'];
    }
}

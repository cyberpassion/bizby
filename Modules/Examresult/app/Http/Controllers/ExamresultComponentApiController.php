<?php

namespace Modules\Examresult\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Examresult\Models\ExamresultEvaluationComponent;

class ExamresultComponentApiController extends Controller
{
    public function store(Request $request, $evaluationId)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'code' => 'nullable|string',
            'max_score' => 'nullable|numeric',
            'meta' => 'nullable|array',
        ]);

        return ExamresultEvaluationComponent::create([
            ...$data,
            'evaluation_id' => $evaluationId
        ]);
    }

    public function update(Request $request, $id)
    {
        $component = ExamresultEvaluationComponent::findOrFail($id);

        $component->update($request->only([
            'name','code','max_score','meta'
        ]));

        return $component;
    }

    public function destroy($id)
    {
        ExamresultEvaluationComponent::findOrFail($id)->delete();
        return ['status' => 'deleted'];
    }
}

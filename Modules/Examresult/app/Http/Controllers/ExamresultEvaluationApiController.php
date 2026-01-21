<?php

namespace Modules\Examresult\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Examresult\Models\ExamresultEvaluation;

class ExamresultEvaluationApiController extends Controller
{
    public function index(Request $request)
    {
        $q = ExamresultEvaluation::query();

        if ($request->filled('group_code')) {
            $q->where('group_code', $request->group_code);
        }

        return $q->with('components')
            ->orderBy('sequence')
            ->get();
    }

    public function show($id)
    {
        return ExamresultEvaluation::with('components')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'type' => 'nullable|string',
            'group_code' => 'nullable|string',
            'sequence' => 'nullable|integer',
            'evaluation_date' => 'nullable|date',
            'meta' => 'nullable|array',
        ]);

        return ExamresultEvaluation::create($data);
    }

    public function update(Request $request, $id)
    {
        $evaluation = ExamresultEvaluation::findOrFail($id);

        $evaluation->update($request->only([
            'name','type','group_code','sequence','evaluation_date','meta'
        ]));

        return $evaluation;
    }

    public function destroy($id)
    {
        ExamresultEvaluation::findOrFail($id)->delete();
        return response()->json(['status' => 'deleted']);
    }

    public function lock($id)
    {
        $evaluation = ExamresultEvaluation::findOrFail($id);
        $evaluation->status = 'locked';
        $evaluation->save();

        return ['status' => 'locked'];
    }

    public function recalculate($id)
    {
        // hook for future grade/rank logic
        return ['status' => 'recalculated'];
    }
}

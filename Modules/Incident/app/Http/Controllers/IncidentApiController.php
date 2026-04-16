<?php

namespace Modules\Incident\Http\Controllers;

use Modules\Incident\Models\Incident;
use Modules\Shared\Http\Controllers\SharedApiController;

class IncidentApiController extends SharedApiController
{
    protected function model()
    {
        return Incident::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'center_id' => 'required|exists:centers,id',
            'type' => 'required|string',
            'location' => 'required|string',
            'severity' => 'required|in:Low,Medium,High,Critical',
            'incident_date' => 'required|date',
            'incident_time' => 'required',
        ];
    }

    protected function allowedCharts(): array
    {
        return [
            'type',
            'severity',
            'status',
            'center_id',
            'incident_date',
        ];
    }

    protected function defaultMetrics(): array
    {
        return [
            'total_records',
        ];
    }

    protected function defaultAggregates(): array
    {
        return [
            'count:severity=Low',
            'count:severity=Medium',
            'count:severity=High',
            'count:severity=Critical',
        ];
    }

    protected function defaultGroups(): array
    {
        return [
            'type',
            'severity',
            'status',
            'center_id',
            'incident_date',
        ];
    }

    public function extraStats()
    {
        return [];
    }

	public function byCenter($center_id, \Illuminate\Http\Request $request)
	{
    	$request->merge([
	        'center_id' => $center_id
    	]);

	    return $this->index($request);
	}

	public function byType($type, \Illuminate\Http\Request $request)
	{
	    $request->merge([
    	    'type' => $type
    	]);

	    return $this->index($request);
	}
}
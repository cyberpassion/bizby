<?php

namespace Modules\Incident\Http\Controllers;

use Modules\Incident\Models\Incident;
use Modules\Shared\Http\Controllers\SharedApiController;

use Illuminate\Support\Facades\DB;

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

	public function addLog(int $id, \Illuminate\Http\Request $request)
	{
    	$incident = Incident::findOrFail($id);

	    $log = \Modules\Incident\Models\IncidentLog::create([
    	    'tenant_id' => tenant('id'),
        	'incident_id' => $incident->id,
	        'event' => $request->input('event', 'comment'),
    	    'notes' => $request->input('notes'),
        	'user_id' => auth()->id(),
    	]);

	    return response()->json([
    	    'status' => 'success',
        	'message' => 'Log added successfully',
        	'data' => $log
    	]);
	}

	public function logs(int $id)
	{
    	$logs = \Modules\Incident\Models\IncidentLog::where('incident_id', $id)
        	->latest()
        	->get();

	    return response()->json([
    	    'status' => 'success',
        	'data' => $logs
	    ]);
	}

	public function resolve(int $id, \Illuminate\Http\Request $request)
	{
    	$incident = Incident::findOrFail($id);

	    $incident->update([
    	    'status' => '4',
        	'resolved_at' => now(),
	    ]);

	    \Modules\Incident\Models\IncidentLog::create([
    	    'tenant_id' => tenant('id'),
        	'incident_id' => $incident->id,
	        'event' => 'resolved',
    	    'notes' => $request->input('notes'),
        	'user_id' => auth()->id(),
	    ]);

	    return response()->json([
    	    'status' => 'success',
        	'message' => 'Incident resolved',
        	'data' => $incident
	    ]);
	}

	public function close(int $id, \Illuminate\Http\Request $request)
	{
    	$incident = Incident::findOrFail($id);

	    DB::beginTransaction();

	    try {

	        // create closure record
    	    \Modules\Incident\Models\IncidentClosure::create([
        	    'tenant_id' => tenant('id'),
            	'incident_id' => $incident->id,
	            'resolution_summary' => $request->resolution_summary,
    	        'root_cause' => $request->root_cause,
        	    'preventive_measures' => $request->preventive_measures,
            	'closed_by' => auth()->id(),
        	]);

	        // update incident
    	    $incident->update([
        	    'status' => '5',
            	'closed_at' => now(),
	        ]);

	        // log
    	    \Modules\Incident\Models\IncidentLog::create([
        	    'tenant_id' => tenant('id'),
            	'incident_id' => $incident->id,
	            'event' => 'closed',
    	        'notes' => $request->resolution_summary,
        	    'user_id' => auth()->id(),
        	]);

	        DB::commit();

	        return response()->json([
    	        'status' => 'success',
        	    'message' => 'Incident closed successfully'
        	]);

	    } catch (\Exception $e) {
    	    DB::rollBack();
        	throw $e;
    	}
	}

	public function closeData(int $id)
	{
    	$logs = \Modules\Incident\Models\IncidentClosure::where('incident_id', $id)
        	->first();

	    return response()->json([
    	    'status' => 'success',
        	'data' => $logs
	    ]);
	}

}
<?php

namespace Modules\Note\Http\Controllers;

use Modules\Note\Models\NoteThread;
use Modules\Shared\Http\Controllers\SharedApiController;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NoteThreadApiController extends SharedApiController
{
    protected $searchable = ['subject', 'type', 'status'];

    protected function model()
    {
        return NoteThread::class;
    }

	/*
    |--------------------------------------------------------------------------
    | Store override (IMPORTANT)
    |--------------------------------------------------------------------------
    */
	public function store(Request $request)
	{
    	$data = $request->validate([
	        'type'        => 'nullable|string',
    	    'subject'     => 'nullable|string',
        	'status'      => 'nullable|in:open,in_progress,resolved,closed',
        	'priority'    => 'nullable|in:low,medium,high',
        	'is_internal' => 'boolean',

	        'participants' => 'required|array|min:1',
    	    'participants.*' => 'required|string',
    	]);

	    return DB::transaction(function () use ($data) {

	        // ✅ extract participants
    	    $rawParticipants = $data['participants'];
        	unset($data['participants']);

	        // ✅ create thread
    	    $thread = NoteThread::create($data);

	        foreach ($rawParticipants as $p) {

	            if (!str_contains($p, '_')) {
    	            continue;
        	    }

	            [$type, $id] = explode('_', $p);

	            $thread->participants()->create([
    	            'participant_id'   => (int) $id,
        	        'participant_type' => $type, // ✅ JUST STRING (morphMap handles it)
            	]);
        	}

	        return response()->json([
    	        'status' => 'success',
        	    'message' => 'Thread created successfully.',
            	'data' => $thread->load('participants')
	        ], 201);
    	});
	}

    protected function validationRules($id = null)
    {
        return [
            'type'        => 'nullable|string',
            'subject'     => 'nullable|string',
            'status'      => 'nullable|in:open,in_progress,resolved,closed',
            'priority'    => 'nullable|in:low,medium,high',
            'is_internal' => 'boolean',
        ];
    }

    protected function allowedCharts(): array
    {
        return [
            'type',
            'status',
            'priority',
            'is_internal',
            'created_at',
        ];
    }

    protected function defaultMetrics(): array
    {
        return ['total_records'];
    }

    protected function defaultAggregates(): array
    {
        return [
            'count:status=open',
            'count:status=resolved',
        ];
    }

    protected function defaultGroups(): array
    {
        return [
            'status',
            'priority',
            'is_internal',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Extra filters
    |--------------------------------------------------------------------------
    */

    public function internal(\Illuminate\Http\Request $request)
    {
        $request->merge(['is_internal' => true]);
        return $this->index($request);
    }

    public function external(\Illuminate\Http\Request $request)
    {
        $request->merge(['is_internal' => false]);
        return $this->index($request);
    }
}
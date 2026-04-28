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
		'message' 	  => 'required|string',
        'status'      => 'nullable|in:open,in_progress,resolved,closed',
        'priority'    => 'nullable|in:low,medium,high',
        'is_internal' => 'boolean',

        // context
        'context_type' => 'nullable|string',
        'context_id'   => 'nullable|integer',

        // assignee
        'assignee_type' => 'required|string',
        'assignee_id'   => 'required|integer',

        // watchers
        'watchers'   => 'nullable|array',
        'watchers.*' => 'string',
    ]);

    return DB::transaction(function () use ($request, $data) {

        // ✅ let base controller handle polymorphic parsing
        $data = $this->parsePolymorphicFields($data);

        // ✅ create thread
        $thread = NoteThread::create($data);

		// 👉 ADD HERE (right after thread is created)

	    // 1) dedupe watchers
    	$watchers = collect($request->watchers ?? [])->unique();

	    // 2) enforce single assignee (safety; mostly relevant on update/reassign)
    	$thread->participants()
        	->where('role', 'assignee')
        	->delete();

        // 🔥 BUILD PARTICIPANTS HERE
        $participants = [];

        // initiator
        $participants[] = [
            'role' => 'initiator',
            'participant_id' => auth()->id(),
            'participant_type' => get_class(auth()->user()),
        ];

        // assignee
        $participants[] = [
            'role' => 'assignee',
            'participant_id' => $data['assignee_id'],
            'participant_type' => $data['assignee_type'],
        ];

        // watchers
        foreach ($request->watchers ?? [] as $w) {
            [$type, $id] = explode('_', $w);

            $participants[] = [
                'role' => 'watcher',
                'participant_id' => (int) $id,
                'participant_type' => $type,
            ];
        }

        // ✅ save participants
        foreach ($participants as $p) {
            $thread->participants()->create($p);
        }

        // ✅ create first message (VERY IMPORTANT – you missed this)
        $note = \Modules\Note\Models\Note::create([
            'note_thread_id' => $thread->id,
            'message'        => $request->message,
            'message_type'   => 'text',
            'sender_id'      => auth()->id(),
            'sender_type'    => get_class(auth()->user()),
        ]);

        // ✅ update thread meta
        $thread->update([
            'last_message'    => $note->message,
            'last_message_at' => now(),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Thread created successfully.',
            'data'    => $thread->load('participants', 'notes')
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

	public function assignedToMe()
{
    return NoteThread::assignedToMe()
        ->with(['assignee.participant','context'])
        ->latest()
        ->paginate(20);
}

public function myInbox()
{
    return NoteThread::involvingMe()
        ->with(['assignee.participant','context'])
        ->latest()
        ->paginate(20);
}

}
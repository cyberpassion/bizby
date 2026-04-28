<?php

namespace Modules\Note\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Note\Models\Note;
use Modules\Note\Models\NoteThread;
use Modules\Shared\Http\Controllers\SharedApiController;
use Illuminate\Support\Facades\DB;

class NoteApiController extends SharedApiController
{
    protected function model()
    {
        return Note::class;
    }

	/*
    |--------------------------------------------------------------------------
    | Store override (IMPORTANT)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
	{
    	$data = $request->validate([
	        'note_thread_id' => 'required|exists:note_threads,id',
    	    'message'        => 'required|string',
        	'message_type'   => 'nullable|in:text,system,attachment',
	    ]);

	    return DB::transaction(function () use ($data) {

	        // ✅ ensure user is part of thread
    	    $thread = NoteThread::findOrFail($data['note_thread_id']);

	        $isParticipant = $thread->participants()
    	        ->where('participant_id', auth()->id())
        	    ->where('participant_type', get_class(auth()->user()))
            	->exists();

	        if (!$isParticipant) {
    	        abort(403, 'Not allowed to post in this thread');
        	}

	        // ✅ create note
    	    $note = Note::create([
        	    ...$data,
            	'sender_id'   => auth()->id(),
            	'sender_type' => get_class(auth()->user()),
	        ]);

	        // ✅ update thread meta
    	    $thread->update([
        	    'last_message'    => $note->message,
            	'last_message_at' => now(),
	        ]);

	        // ✅ mark sender as read
    	    $thread->participants()
        	    ->where('participant_id', auth()->id())
            	->where('participant_type', get_class(auth()->user()))
            	->update(['last_read_at' => now()]);

	        return response()->json([
    	        'status'  => 'success',
        	    'message' => 'Message sent successfully.',
            	'data'    => $note->load('sender')
	        ]);
    	});
	}

    protected function validationRules($id = null)
    {
        return [
            'note_thread_id' => 'required|exists:note_threads,id',
            'message'        => 'nullable|string',
            'message_type'   => 'nullable|in:text,system,attachment',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Get messages by thread
    |--------------------------------------------------------------------------
    */
    public function byThread($threadId, Request $request)
	{
    	$thread = NoteThread::findOrFail($threadId);

	    // ✅ authorization
    	$thread->participants()
	        ->where('participant_id', auth()->id())
    	    ->where('participant_type', get_class(auth()->user()))
        	->exists() || abort(403);

	    // ✅ mark as read
    	$thread->participants()
        	->where('participant_id', auth()->id())
	        ->where('participant_type', get_class(auth()->user()))
    	    ->update(['last_read_at' => now()]);

	    return $thread->notes()
    	    ->with('sender')
        	->latest()
        	->paginate(20);
	}
}
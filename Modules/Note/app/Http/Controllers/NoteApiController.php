<?php

namespace Modules\Note\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Note\Models\Note;
use Modules\Note\Models\NoteThread;
use Modules\Shared\Http\Controllers\SharedApiController;

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
        $data = $request->all();

        $note = Note::create([
            ...$data,
            'sender_id'   => auth()->id(),
            'sender_type' => get_class(auth()->user()),
        ]);

        // Update thread metadata
        NoteThread::where('id', $note->note_thread_id)->update([
            'last_message'    => $note->message,
            'last_message_at' => now(),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Message sent successfully.',
            'data'    => $note
        ]);
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
        return Note::where('note_thread_id', $threadId)
            ->latest()
            ->paginate(20);
    }
}
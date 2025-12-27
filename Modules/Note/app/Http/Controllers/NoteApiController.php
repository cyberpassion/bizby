<?php

namespace Modules\Note\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Note\Models\Note;
use Modules\Note\Models\NoteThread;

class NoteApiController extends Controller
{
    /**
     * Send a message
     */
    public function store(Request $request, NoteThread $noteThread)
    {
        $data = $request->validate([
            'sender_id'     => 'required',
            'sender_type'   => 'required|string',
            'receiver_id'   => 'required',
            'receiver_type' => 'required|string',
            'message'       => 'nullable|string',
            'message_type'  => 'nullable|string',
            'meta'          => 'nullable|array',
        ]);

        $note = $noteThread->messages()->create($data);

        $noteThread->update([
            'last_message_at' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'data'   => $note,
        ], 201);
    }

    /**
     * Mark message as read
     */
    public function markRead(Note $note)
    {
        $note->update([
            'read_at' => now(),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Message marked as read',
        ]);
    }
}

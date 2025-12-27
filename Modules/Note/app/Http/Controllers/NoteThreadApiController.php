<?php

namespace Modules\Note\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Note\Models\NoteThread;

class NoteThreadApiController extends Controller
{
    /**
     * List threads for a participant
     */
    public function index(Request $request)
    {
        $request->validate([
            'participant_id'   => 'required',
            'participant_type' => 'required|string',
        ]);

        $threads = NoteThread::where(function ($q) use ($request) {
                $q->where('participant_one_id', $request->participant_id)
                  ->where('participant_one_type', $request->participant_type);
            })
            ->orWhere(function ($q) use ($request) {
                $q->where('participant_two_id', $request->participant_id)
                  ->where('participant_two_type', $request->participant_type);
            })
            ->orderByDesc('last_message_at')
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $threads,
        ]);
    }

    /**
     * Create a new thread (or reuse existing)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'participant_one_id'   => 'required',
            'participant_one_type' => 'required|string',
            'participant_two_id'   => 'required',
            'participant_two_type' => 'required|string',
            'type'                 => 'nullable|string',
            'subject'              => 'nullable|string',
        ]);

        $thread = NoteThread::firstOrCreate([
            'participant_one_id'   => $data['participant_one_id'],
            'participant_one_type' => $data['participant_one_type'],
            'participant_two_id'   => $data['participant_two_id'],
            'participant_two_type' => $data['participant_two_type'],
        ], $data);

        return response()->json([
            'status' => 'success',
            'data'   => $thread,
        ], 201);
    }

    /**
     * Show thread with messages
     */
    public function show(NoteThread $noteThread)
    {
        return response()->json([
            'status' => 'success',
            'data'   => $noteThread->load('messages'),
        ]);
    }
}

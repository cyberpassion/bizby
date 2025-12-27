<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attendance\Models\AttendanceSession;

class AttendanceSessionApiController extends Controller
{
    /**
     * List attendance sessions
     * Optional filters:
     * ?type=day|lecture
     * ?date=2025-01-15
     */
    public function index(Request $request)
    {
        $query = AttendanceSession::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('date')) {
            $query->where('session_date', $request->date);
        }

        return response()->json([
            'status' => 'success',
            'data' => $query
                ->withCount('attendances')
                ->latest('session_date')
                ->paginate(20),
        ]);
    }

    /**
     * Create attendance session
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'type'         => 'required|string',
            'session_date' => 'required|date',
            'start_time'   => 'nullable',
            'end_time'     => 'nullable',
            'context'      => 'nullable|string',
            'reference'    => 'nullable|string',
        ]);

        $session = AttendanceSession::create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Attendance session created',
            'data'    => $session,
        ], 201);
    }

    /**
     * Show single session with attendances
     */
    public function show(AttendanceSession $attendanceSession)
    {
        return response()->json([
            'status' => 'success',
            'data' => $attendanceSession->load('attendances.entity'),
        ]);
    }
}

<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attendance\Services\AttendanceService;
use Modules\Attendance\Models\AttendanceSession;

class AttendanceSessionApiController extends Controller
{
    public function __construct(private AttendanceService $service) {}

    public function index(Request $request)
    {
        return AttendanceSession::query()
            ->when($request->date, fn($q) => $q->whereDate('session_date', $request->date))
            ->when($request->type, fn($q) => $q->where('type', $request->type))
            ->latest()
            ->paginate(50);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|string',
            'mode' => 'nullable|string',
            'session_date' => 'required|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'context' => 'nullable|string',
            'reference' => 'nullable|string',
        ]);

        $session = $this->service->createSession($data, $request->user());

        return response()->json($session, 201);
    }

    public function show(AttendanceSession $attendanceSession)
    {
        return $attendanceSession->load('attendances');
    }
}

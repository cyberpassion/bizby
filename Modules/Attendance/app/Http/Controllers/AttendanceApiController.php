<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attendance\Models\Attendance;
use Modules\Attendance\Models\AttendanceSession;
use Modules\Attendance\Services\AttendanceService;

class AttendanceApiController extends Controller
{
    public function __construct(private AttendanceService $service) {}

    public function mark(Request $request, AttendanceSession $session)
    {
        $data = $request->validate([
            'entity_id' => 'required|integer',
            'entity_type' => 'required|string',
            'attendance_status' => 'required|string',
            'in_time' => 'nullable',
            'out_time' => 'nullable',
            'source' => 'nullable|string',
            'code' => 'nullable|string',
            'reason' => 'nullable|string',
        ]);

        return $this->service->markAttendance($session, $data);
    }

    public function bulk(Request $request, AttendanceSession $session)
    {
        $items = $request->validate([
            'items' => 'required|array',
            'items.*.entity_id' => 'required',
            'items.*.entity_type' => 'required',
            'items.*.attendance_status' => 'required',
        ])['items'];

        $this->service->bulkMark($session, $items);

        return response()->json(['status' => 'ok']);
    }

    public function punch(Request $request, Attendance $attendance)
    {
        $data = $request->validate([
            'type' => 'required|in:in,out',
            'time' => 'required',
        ]);

        return $this->service->punch($attendance, $data['type'], $data['time']);
    }

    public function selfPunch(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:in,out',
            'time' => 'required',
        ]);

        return $this->service->selfPunch(
            $request->user(),
            $data['type'],
            $data['time']
        );
    }
}

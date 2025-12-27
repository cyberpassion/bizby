<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attendance\Models\Attendance;
use Modules\Attendance\Models\AttendanceSession;

class AttendanceApiController extends Controller
{
    /**
     * Mark attendance for a session
     */
    public function store(Request $request, AttendanceSession $attendanceSession)
    {
        $data = $request->validate([
            'entity_id'   => 'required|integer',
            'entity_type' => 'required|string',
            'status'      => 'required|string',
            'in_time'     => 'nullable',
            'out_time'    => 'nullable',
            'code'        => 'nullable|string',
            'reason'      => 'nullable|string',
        ]);

        $attendance = $attendanceSession
            ->attendances()
            ->create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Attendance marked',
            'data'    => $attendance,
        ], 201);
    }

    /**
     * Update attendance
     */
    public function update(Request $request, Attendance $attendance)
    {
        $attendance->update($request->all());

        return response()->json([
            'status'  => 'success',
            'message' => 'Attendance updated',
            'data'    => $attendance,
        ]);
    }

    /**
     * Delete attendance entry
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Attendance deleted',
        ]);
    }
}

<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Attendance\Models\Attendance;
use Modules\Attendance\Models\AttendanceSession;
use Modules\Attendance\Services\AttendanceService;

class AttendanceApiController extends Controller
{
    public function __construct(private AttendanceService $service) {}

    public function mark(Request $request, $sessionId)
	{
    	// 1. Resolve session WITH tenant filter
	    $session = AttendanceSession::where('id', $sessionId)
    	    ->where('tenant_id', tenant()->id)
        	->firstOrFail();

	    // 2. Validate input
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

	    // 3. Force tenant into service data
    	$data['tenant_id'] = tenant()->id;

	    $response = $this->service->markAttendance($session, $data);

		return response()->json([
    	    'status'  => 'success',
        	'message' => 'Saved Successfully.',
	        'data'    => $response
    	], Response::HTTP_OK);
	}

    public function bulk(Request $request, $sessionId)
	{
    	$session = AttendanceSession::where('id', $sessionId)
	        ->where('tenant_id', tenant()->id)
    	    ->firstOrFail();

	    $items = $request->validate([
    	    'items' => 'required|array',
        	'items.*.entity_id' => 'required',
	        'items.*.entity_type' => 'required',
    	    'items.*.attendance_status' => 'required',
	    ])['items'];

	    $response = $this->service->bulkMark($session, $items);

		return response()->json([
    	    'status'  => 'success',
        	'message' => 'Saved Successfully.',
	        'data'    => $response
    	], Response::HTTP_OK);
	}

    public function punch(Request $request, $attendanceId)
	{
    	$attendance = Attendance::where('id', $attendanceId)
	        ->where('tenant_id', tenant()->id)
    	    ->firstOrFail();

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

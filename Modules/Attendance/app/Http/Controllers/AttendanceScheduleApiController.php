<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Attendance\Models\AttendanceSchedule;
use Modules\Attendance\Services\AttendanceService;
use \Modules\Attendance\Models\AttendanceSession;

class AttendanceScheduleApiController extends Controller
{
    public function __construct(private AttendanceService $service) {}

    public function index()
    {
		$response = AttendanceSchedule::where('tenant_id', tenant()->id)->get();
		return response()->json([
    	    'status'  => 'success',
        	'message' => 'Fetched Successfully.',
	        'data'    => $response
    	], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|string',
            'weekdays' => 'required|array',
            'start_time' => 'required',
            'end_time' => 'required',
            'starts_from' => 'required|date',
            'ends_on' => 'nullable|date',
            'context' => 'nullable|string',
            'reference' => 'nullable|string',
        ]);

        $data['tenant_id'] = tenant()->id;

		$response = $this->service->createSchedule($data);
		return response()->json([
    	    'status'  => 'success',
        	'message' => 'Saved Successfully.',
	        'data'    => $response
    	], Response::HTTP_OK);

    }

	public function update(Request $request, $id)
	{
    	$schedule = AttendanceSchedule::where('tenant_id', tenant()->id)
	        ->findOrFail($id);

	    $payload = $request->validate([
    	    'type'        => 'nullable|string',
        	'weekdays'    => 'nullable|array',
	        'weekdays.*'  => 'integer|min:1|max:7',
    	    'start_time'  => 'nullable',
        	'end_time'    => 'nullable',
	        'starts_from' => 'nullable|date',
    	    'ends_on'     => 'nullable|date',
        	'context'     => 'nullable|string',
	        'reference'   => 'nullable|string',
    	    'is_active'   => 'nullable|boolean',
    	]);

	    /*
    	|--------------------------------------------------------------------------
	    | Prevent invalid time logic
    	|--------------------------------------------------------------------------
	    */

	    if (isset($payload['start_time']) && isset($payload['end_time'])) {
    	    if ($payload['start_time'] >= $payload['end_time']) {
        	    abort(422, 'End time must be after start time.');
        	}
    	}

	    $schedule->update($payload);

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Schedule updated successfully.',
        	'data'    => $schedule->fresh()
	    ], Response::HTTP_OK);
	}

	public function destroy($id)
	{
    	$schedule = AttendanceSchedule::where('tenant_id', tenant()->id)
	        ->findOrFail($id);

	    /*
    	|--------------------------------------------------------------------------
	    | Protect sessions with real data
    	|--------------------------------------------------------------------------
    	*/

	    $hasLockedSessions = AttendanceSession::where(
    	        'attendance_schedule_id',
        	    $schedule->id
	        )
    	    ->where('tenant_id', tenant()->id)
        	->where(function ($q) {
            	$q->whereDate('session_date', '<', today())
              	->orWhereHas('attendances');
	        })
    	    ->exists();

	    if ($hasLockedSessions) {
    	    abort(422, 'Cannot delete schedule with past or attended sessions.');
    	}

	    /*
    	|--------------------------------------------------------------------------
	    | Delete safe future sessions
    	|--------------------------------------------------------------------------
	    */

	    AttendanceSession::where('tenant_id', tenant()->id)
    	    ->where('attendance_schedule_id', $schedule->id)
        	->delete();

	    $schedule->delete();

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Schedule deleted successfully.'
	    ], Response::HTTP_OK);
	}

    public function generate(Request $request, $id)
	{
    	$payload = validator($request->all(), [
	        'start' => 'nullable|date',
    	    'end'   => 'nullable|date|after_or_equal:start',
    	])->validate();

	    $schedule = AttendanceSchedule::where('tenant_id', tenant()->id)
    	    ->findOrFail($id);

	    $response = $this->service->generateSessions(
    	    $schedule,
        	$payload['start'] ?? null,
        	$payload['end'] ?? null
	    );

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Generated Successfully.',
        	'data'    => $response
	    ]);
	}

    public function rebuild(Request $request, $id)
	{
    	$payload = validator($request->all(), [
	        'start' => 'nullable|date',
    	    'end'   => 'nullable|date|after_or_equal:start',
    	])->validate();

	    $schedule = AttendanceSchedule::where('tenant_id', tenant()->id)
    	    ->findOrFail($id);

	    $response = $this->service->rebuildFutureSessions(
    	    $schedule,
        	$payload['start'] ?? null,
	        $payload['end'] ?? null
    	);

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Rebuilt Successfully.',
        	'data'    => $response
	    ]);
	}

}

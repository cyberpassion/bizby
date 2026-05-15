<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Attendance\Models\AttendanceWeeklyOff;
use Modules\Attendance\Services\AttendanceService;

class AttendanceWeeklyOffApiController extends Controller
{
    public function __construct(private AttendanceService $service) {}

    public function index()
	{
    	$response = AttendanceWeeklyOff::where(
	        'tenant_id',
    	    tenant()->id
    	)->get();

	    /*
    	|--------------------------------------------------------------------------
	    | WEEKDAY LOOKUP
    	|--------------------------------------------------------------------------
	    */

	    $lookupResponse = app(
    	    \Modules\Shared\Http\Controllers\LookupsApiController::class
	    )->get("attendance.weekdays");

	    $weekdays = $lookupResponse->getData(true)['data'] ?? [];

	    /*
    	|--------------------------------------------------------------------------
	    | APPLY LABEL
    	|--------------------------------------------------------------------------
	    */

	    $response = $response->map(function ($row) use ($weekdays) {
	        $row->weekday_label =
    	        $weekdays[$row->weekday]
        	    ?? $row->weekday;

	        return $row;
    	});

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Fetched Successfully.',
	        'data'    => [
    	        'data' => $response
        	]
	    ], Response::HTTP_OK);
	}

    public function store(Request $request)
    {
        $data = $request->validate([
            'weekday' => 'required|integer|min:1|max:7',
            'context' => 'nullable|string'
        ]);

        $data['tenant_id'] = tenant()->id;

		$response = $this->service->createWeeklyOff($data);
		return response()->json([
    	    'status'  => 'success',
        	'message' => 'Saved Successfully.',
	        'data'    => $response
    	], Response::HTTP_OK);

    }

    public function destroy($id)
    {
        AttendanceWeeklyOff::where('tenant_id', tenant()->id)->findOrFail($id)->delete();

		return response()->json([
    	    'status'  => 'success',
        	'message' => 'Deleted Successfully.',
	        'data'    => []
    	], Response::HTTP_OK);

    }
}

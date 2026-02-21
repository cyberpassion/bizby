<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Attendance\Models\AttendanceHoliday;
use Modules\Attendance\Services\AttendanceService;

class AttendanceHolidayApiController extends Controller
{
    public function __construct(private AttendanceService $service) {}

    public function index()
    {
        $response = AttendanceHoliday::where('tenant_id', tenant()->id)->get();
		return response()->json([
    	    'status'  => 'success',
        	'message' => 'Fetched Successfully.',
	        'data'    => ['data'=>$response]
    	], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'name' => 'required|string',
            'context' => 'nullable|string'
        ]);

        $data['tenant_id'] = tenant()->id;

		$response = $this->service->createHoliday($data);

		return response()->json([
    	    'status'  => 'success',
        	'message' => 'Saved Successfully.',
	        'data'    => $response
    	], Response::HTTP_OK);

    }

    public function destroy($id)
    {
        AttendanceHoliday::where('tenant_id', tenant()->id)->findOrFail($id)->delete();

		return response()->json([
    	    'status'  => 'success',
        	'message' => 'Saved Successfully.',
	        'data'    => []
    	], Response::HTTP_OK);

    }
}

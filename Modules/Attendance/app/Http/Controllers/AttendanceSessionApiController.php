<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attendance\Services\AttendanceService;
use Modules\Attendance\Models\AttendanceSession;
use Illuminate\Http\Response;

class AttendanceSessionApiController extends Controller
{
    public function __construct(private AttendanceService $service) {}

    public function index(Request $request)
	{
	    $response = AttendanceSession::where('tenant_id', tenant()->id)
    	    ->when($request->date, fn($q) => $q->whereDate('session_date', $request->date))
        	->when($request->type, fn($q) => $q->where('type', $request->type))
        	->latest()
        	->paginate(50);
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
            'mode' => 'nullable|string',
            'session_date' => 'required|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'context' => 'nullable|string',
            'reference' => 'nullable|string',
        ]);

        $session = $this->service->createSession($data, $request->user());

		return response()->json([
    	    'status'  => 'success',
        	'message' => 'Records created successfully.',
	        'data'    => $session
    	], Response::HTTP_OK);
    }

    public function show($id)
	{
	    $session = AttendanceSession::where('id', $id)
    	    ->where('tenant_id', tenant()->id)
        	->firstOrFail();

		$response = $session->load('attendances');
		return response()->json([
    	    'status'  => 'success',
        	'message' => 'Fetched Successfully.',
	        'data'    => $response
    	], Response::HTTP_OK);

	}

}

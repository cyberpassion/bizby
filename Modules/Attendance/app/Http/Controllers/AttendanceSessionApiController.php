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
			'batch_ids' => 'nullable|array',
		    'batch_ids.*' => 'exists:attendance_batches,id'
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

	public function batches($sessionId)
	{
    	$session = AttendanceSession::where('tenant_id', tenant()->id)
	        ->with([
    	        'batches' => function ($q) {
        	        $q->select('attendance_batches.id', 'name', 'code');
            	}
	        ])
    	    ->findOrFail($sessionId);

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Batches fetched successfully.',
	        'data'    => $session->batches
    	], Response::HTTP_OK);
	}

	public function participants($sessionId)
	{
    	$session = AttendanceSession::where('tenant_id', tenant()->id)
	        ->with([
    	        'batches.participants'
        	])
	        ->findOrFail($sessionId);

	    $participants = $session->batches
    	    ->flatMap(fn ($batch) => $batch->participants)
        	->unique('id') // important if same user in multiple batches
        	->values();

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Participants fetched successfully.',
        	'data'    => $participants
    	]);
	}

}

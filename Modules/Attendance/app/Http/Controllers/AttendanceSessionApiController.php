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
			->with(['batches'])
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

	public function today(Request $request)
	{
    	$response = AttendanceSession::query()
	        ->where('tenant_id', tenant()->id)
    	    ->whereDate('session_date', today())

	        /*
    	    |--------------------------------------------------------------------------
        	| Optional filters
        	|--------------------------------------------------------------------------
	        */

	        ->when(
    	        $request->type,
        	    fn ($q) => $q->where('type', $request->type)
        	)

	        ->when(
    	        $request->mode,
        	    fn ($q) => $q->where('mode', $request->mode)
        	)

	        /*
    	    |--------------------------------------------------------------------------
	        | Ordering
    	    |--------------------------------------------------------------------------
        	*/

	        ->orderBy('start_time')
    	    ->paginate(50);

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Today sessions fetched successfully.',
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

    public function show(int $id)
	{
	    $session = AttendanceSession::where('id', $id)
    	    ->where('tenant_id', tenant()->id)
			->with(['batches'])
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

	public function participants(int $sessionId)
	{
    	$session = AttendanceSession::where('tenant_id', tenant()->id)
	        ->with([
    	        'participants'
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

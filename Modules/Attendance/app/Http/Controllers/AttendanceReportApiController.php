<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attendance\Models\Attendance;
use Illuminate\Http\Response;

class AttendanceReportApiController extends Controller
{

	public function index(Request $request)
    {
        $query = Attendance::query()
            ->where('tenant_id', tenant()->id)
            ->with(['session','entity']);

        /* ----------------------------------------
         | Date filters
         * --------------------------------------*/

        if ($request->filled('date')) {
            $query->whereHas('session', fn ($q) =>
                $q->whereDate('session_date', $request->date)
            );
        }

        if ($request->filled('month')) {
            $query->whereHas('session', fn ($q) =>
                $q->whereBetween('session_date', [
                    $request->month . '-01',
                    now()->parse($request->month)->endOfMonth()->toDateString()
                ])
            );
        }

        if ($request->filled('from_date')) {
            $query->whereHas('session', fn ($q) =>
                $q->whereBetween('session_date', [
                    $request->from_date,
                    $request->to_date ?? $request->from_date
                ])
            );
        }

        /* ----------------------------------------
         | Entity filters
         * --------------------------------------*/

        if ($request->filled('entity_type')) {
            $query->where('entity_type', $request->entity_type);
        }

        if ($request->filled('entity_id')) {
            $query->where('entity_id', $request->entity_id);
        }

        /* ----------------------------------------
         | Attendance filters
         * --------------------------------------*/

        if ($request->filled('attendance_status')) {
            $query->where('attendance_status', $request->attendance_status);
        }

        /* ----------------------------------------
         | Session filters
         * --------------------------------------*/

        if ($request->filled('session_type')) {
            $query->whereHas('session', fn ($q) =>
                $q->where('type', $request->session_type)
            );
        }

        if ($request->filled('context')) {
            $query->whereHas('session', fn ($q) =>
                $q->where('context', $request->context)
            );
        }

        $data = $query->latest()->get();

		return response()->json([
    	    'status'  => 'success',
        	'message' => 'Fetched successfully.',
	        'data'    => $data
    	], Response::HTTP_OK);

    }

    public function daily(Request $request)
	{
    	$date = $request->date ?? now()->toDateString();

	    $data = Attendance::where('tenant_id', tenant()->id)
    	    ->with('session')
        	->whereHas('session', fn($q) =>
            	$q->where('tenant_id', tenant()->id)
              	->whereDate('session_date', $date)
        	)->get();

		return response()->json([
    	    'status'  => 'success',
        	'message' => 'Fetched successfully.',
	        'data'    => $data
    	], Response::HTTP_OK);

	}

    public function monthly(Request $request)
	{
    	$month = $request->month ?? now()->format('Y-m');

	    $data = Attendance::where('tenant_id', tenant()->id)
    	    ->whereHas('session', fn($q) =>
        	    $q->where('tenant_id', tenant()->id)
            	  ->whereBetween('session_date', [
                	  $month . '-01',
                  	now()->parse($month)->endOfMonth()->toDateString()
              	])
	        )->get();

		return response()->json([
    	    'status'  => 'success',
        	'message' => 'Fetched successfully.',
	        'data'    => $data
    	], Response::HTTP_OK);

	}

    public function entity(string $type, int $id)
	{
    	$data = Attendance::where('tenant_id', tenant()->id)
	        ->where('entity_type', $type)
    	    ->where('entity_id', $id)
        	->with('session')
        	->latest()
        	->get();

		return response()->json([
    	    'status'  => 'success',
        	'message' => 'Fetched successfully.',
	        'data'    => $data
    	], Response::HTTP_OK);

	}

}

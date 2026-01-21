<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attendance\Models\Attendance;

class AttendanceReportApiController extends Controller
{
    public function daily(Request $request)
	{
    	$date = $request->date ?? now()->toDateString();

	    return Attendance::where('tenant_id', tenant()->id)
    	    ->with('session')
        	->whereHas('session', fn($q) =>
            	$q->where('tenant_id', tenant()->id)
              	->whereDate('session_date', $date)
        	)->get();
	}

    public function monthly(Request $request)
	{
    	$month = $request->month ?? now()->format('Y-m');

	    return Attendance::where('tenant_id', tenant()->id)
    	    ->whereHas('session', fn($q) =>
        	    $q->where('tenant_id', tenant()->id)
            	  ->whereBetween('session_date', [
                	  $month . '-01',
                  	now()->parse($month)->endOfMonth()->toDateString()
              	])
	        )->get();
	}

    public function entity(string $type, int $id)
	{
    	return Attendance::where('tenant_id', tenant()->id)
	        ->where('entity_type', $type)
    	    ->where('entity_id', $id)
        	->with('session')
        	->latest()
        	->get();
	}

}

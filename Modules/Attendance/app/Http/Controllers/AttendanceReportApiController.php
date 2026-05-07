<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;

use Modules\Attendance\Models\Attendance;
use Modules\Attendance\Models\AttendanceSession;
use Modules\Attendance\Models\AttendanceBatch;

class AttendanceReportApiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Generic Report
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = Attendance::query()
            ->where('tenant_id', tenant()->id)
            ->with(['session', 'entity']);

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
                    now()
                        ->parse($request->month)
                        ->endOfMonth()
                        ->toDateString()
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
            $query->where(
                'entity_type',
                $request->entity_type
            );
        }

        if ($request->filled('entity_id')) {
            $query->where(
                'entity_id',
                $request->entity_id
            );
        }

        /* ----------------------------------------
         | Attendance filters
         * --------------------------------------*/

        if ($request->filled('attendance_status')) {
            $query->where(
                'attendance_status',
                $request->attendance_status
            );
        }

        /* ----------------------------------------
         | Session filters
         * --------------------------------------*/

        if ($request->filled('session_type')) {
            $query->whereHas('session', fn ($q) =>
                $q->where(
                    'type',
                    $request->session_type
                )
            );
        }

        if ($request->filled('context')) {
            $query->whereHas('session', fn ($q) =>
                $q->where(
                    'context',
                    $request->context
                )
            );
        }

        $data = $query
            ->latest()
            ->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Fetched successfully.',
            'data'    => ['data' => $this->transformAttendance($data)]
        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Daily Report
    |--------------------------------------------------------------------------
    */

    public function daily(Request $request)
    {
        $date = $request->date
            ?? now()->toDateString();

        $data = Attendance::where(
                'tenant_id',
                tenant()->id
            )
            ->with(['session', 'entity'])
            ->whereHas('session', fn ($q) =>
                $q->whereDate(
                    'session_date',
                    $date
                )
            )
            ->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Daily report fetched successfully.',
            'date'    => $date,
            'data'    => ['data' => $this->transformAttendance($data)]
        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Today Report
    |--------------------------------------------------------------------------
    */

    public function today()
    {
        $data = Attendance::where(
                'tenant_id',
                tenant()->id
            )
            ->with(['session', 'entity'])
            ->whereHas('session', fn ($q) =>
                $q->whereDate(
                    'session_date',
                    now()->toDateString()
                )
            )
            ->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Today attendance fetched successfully.',
            'data'    => ['data' => $this->transformAttendance($data)]
        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Monthly Report
    |--------------------------------------------------------------------------
    */

    public function monthly(Request $request)
	{
    	$request->validate([
        	'year'  => 'nullable|integer|min:2000|max:2100',
	        'month' => 'nullable|string|size:2|in:01,02,03,04,05,06,07,08,09,10,11,12',
    	]);

	    $year = (int) (
		    $request->year
    		?? now()->year
		);

		$month = (int) (
		    $request->month
		    ?? now()->format('m')
		);

	    $startDate = now()
    	    ->setYear($year)
        	->setMonth($month)
	        ->startOfMonth()
    	    ->toDateString();

	    $endDate = now()
    	    ->setYear($year)
        	->setMonth($month)
	        ->endOfMonth()
    	    ->toDateString();

	    $data = Attendance::where(
    	        'tenant_id',
        	    tenant()->id
	        )
    	    ->with(['session', 'entity'])
        	->whereHas('session', fn ($q) =>
            	$q->whereBetween(
                	'session_date',
                	[$startDate, $endDate]
            	)
        	)
	        ->get();

	    return response()->json([
    	    'status'  => 'success',
	        'message' => 'Monthly report fetched successfully.',
	        'year'    => $year,
	        'month'   => $month,
	        'from'    => $startDate,
	        'to'      => $endDate,
	        'data'    => [
    	        'data' => $this->transformAttendance($data)
        	]
	    ], Response::HTTP_OK);
	}

    /*
    |--------------------------------------------------------------------------
    | Entity Report
    |--------------------------------------------------------------------------
    */

    public function entity(
        string $type,
        int $id
    ) {
        $data = Attendance::where(
                'tenant_id',
                tenant()->id
            )
            ->where('entity_type', $type)
            ->where('entity_id', $id)
            ->with(['session', 'entity'])
            ->latest()
            ->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Entity report fetched successfully.',
            'data'    => ['data' => $this->transformAttendance($data)]
        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Batch Report
    |--------------------------------------------------------------------------
    */

    public function batch(int $batchId)
    {
        $batch = AttendanceBatch::where(
                'tenant_id',
                tenant()->id
            )
            ->with([
                'participants'
            ])
            ->findOrFail($batchId);

        $participantIds = $batch->participants
            ->pluck('participant_id');

        $data = Attendance::where(
                'tenant_id',
                tenant()->id
            )
            ->whereIn(
                'entity_id',
                $participantIds
            )
            ->with(['session', 'entity'])
            ->latest()
            ->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Batch report fetched successfully.',
            'batch'   => $batch,
            'data'    => ['data' => $this->transformAttendance($data)]
        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Session Report
    |--------------------------------------------------------------------------
    */

    public function session(int $sessionId)
    {
        $session = AttendanceSession::where(
                'tenant_id',
                tenant()->id
            )
            ->with([
                'attendances.entity'
            ])
            ->findOrFail($sessionId);

        return response()->json([
            'status'  => 'success',
            'message' => 'Session report fetched successfully.',
            'data'    => $session
        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Absent Report
    |--------------------------------------------------------------------------
    */

    public function absent(Request $request)
    {
        $data = Attendance::where(
                'tenant_id',
                tenant()->id
            )
            ->where(
                'attendance_status',
                'absent'
            )
            ->with(['session', 'entity'])
            ->latest()
            ->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Absent report fetched successfully.',
            'data'    => ['data' => $this->transformAttendance($data)]
        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Late Report
    |--------------------------------------------------------------------------
    */

    public function late(Request $request)
    {
        $data = Attendance::where(
                'tenant_id',
                tenant()->id
            )
            ->where(
                'attendance_status',
                'late'
            )
            ->with(['session', 'entity'])
            ->latest()
            ->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Late report fetched successfully.',
            'data'    => ['data' => $this->transformAttendance($data)]
        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Analysis Report
    |--------------------------------------------------------------------------
    */

    public function analysis(Request $request)
    {
        $data = Attendance::selectRaw('
                attendance_status,
                COUNT(*) as total
            ')
            ->where(
                'tenant_id',
                tenant()->id
            )
            ->groupBy('attendance_status')
            ->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Attendance analysis fetched successfully.',
            'data'    => ['data' => $this->transformAttendance($data)]
        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Attendance Percentage
    |--------------------------------------------------------------------------
    */

    public function percentage(Request $request)
    {
        $entityType = $request->entity_type;
        $entityId   = $request->entity_id;

        $query = Attendance::where(
            'tenant_id',
            tenant()->id
        );

        if ($entityType) {
            $query->where(
                'entity_type',
                $entityType
            );
        }

        if ($entityId) {
            $query->where(
                'entity_id',
                $entityId
            );
        }

        $total = (clone $query)->count();

        $present = (clone $query)
            ->where(
                'attendance_status',
                'present'
            )
            ->count();

        $percentage = $total > 0
            ? round(($present / $total) * 100, 2)
            : 0;

        return response()->json([
            'status'      => 'success',
            'message'     => 'Attendance percentage fetched successfully.',
            'total'       => $total,
            'present'     => $present,
            'percentage'  => $percentage
        ], Response::HTTP_OK);
    }

	private function transformAttendance($items)
{
    return $items->map(function ($item) {

        return [
            'id' => $item->id,

            /*
            |--------------------------------------------------------------------------
            | Session
            |--------------------------------------------------------------------------
            */

            'session_date' => optional($item->session)
                ->session_date,

            'session_type' => optional($item->session)
                ->type,

            /*
            |--------------------------------------------------------------------------
            | Participant
            |--------------------------------------------------------------------------
            */

            'participant_name' => optional($item->entity)
                ->name,

            'entity_type' => $item->entity_type,

            'entity_id' => $item->entity_id,

            /*
            |--------------------------------------------------------------------------
            | Attendance
            |--------------------------------------------------------------------------
            */

            'attendance_status' => $item->attendance_status,

            'in_time' => $item->in_time,

            'out_time' => $item->out_time,

            'code' => $item->code,

            'reason' => $item->reason,
        ];
    });
}

}
<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Attendance\Models\AttendanceCalendarDay;
use Modules\Attendance\Services\AttendanceService;

class AttendanceCalendarDayApiController extends Controller
{
    public function __construct(private AttendanceService $service) {}

    /*
    |--------------------------------------------------------------------------
    | List Overrides
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $response = AttendanceCalendarDay::where('tenant_id', tenant()->id)
            ->latest('date')
            ->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Overrides fetched successfully.',
            'data'    => ['data'=>$response]
        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Create Override
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $data = $request->validate([
            'date'     => 'required|date',
            'day_type' => 'required|string',
            'reason'   => 'nullable|string',
            'context'  => 'nullable|string'
        ]);

        $data['tenant_id'] = tenant()->id;

        $override = $this->service->createCalendarOverride($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Calendar override saved successfully.',
            'data'    => $override
        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Override (Safe Partial Update)
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $override = AttendanceCalendarDay::where('tenant_id', tenant()->id)
            ->findOrFail($id);

        $payload = $request->validate([
            'date'     => 'nullable|date',
            'day_type' => 'nullable|string',
            'reason'   => 'nullable|string',
            'context'  => 'nullable|string'
        ]);

        $updated = $this->service->updateCalendarOverride($override, $payload);

        return response()->json([
            'status'  => 'success',
            'message' => 'Calendar override updated successfully.',
            'data'    => $updated
        ], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Override
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $override = AttendanceCalendarDay::where('tenant_id', tenant()->id)
            ->findOrFail($id);

        $override->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Calendar override removed successfully.'
        ], Response::HTTP_OK);
    }
}

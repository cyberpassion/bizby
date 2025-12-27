<?php

namespace Modules\Leaveapplication\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Leaveapplication\Models\Leaveapplication;

class LeaveapplicationApiController extends Controller
{
    /**
     * List leave applications
     */
    public function index(Request $request)
    {
        $query = Leaveapplication::query();

        if ($request->filled('approval_status')) {
            $query->where('approval_status', $request->approval_status);
        }

        if ($request->filled('entity_id') && $request->filled('entity_type')) {
            $query->where('entity_id', $request->entity_id)
                  ->where('entity_type', $request->entity_type);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $query->latest()->paginate(20),
        ]);
    }

    /**
     * Store new leave application
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'entity_id'   => 'required',
            'entity_type' => 'required|string',

            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',

            'type'        => 'nullable|string',
            'session_ref' => 'nullable|string',

            'leave_code' => 'nullable|string',
            'reason'     => 'nullable|string',

            'affects_attendance' => 'boolean',
        ]);

        $leave = Leaveapplication::create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Leave application submitted',
            'data'    => $leave,
        ], 201);
    }

    /**
     * Show single leave application
     */
    public function show(Leaveapplication $leaveapplication)
    {
        return response()->json([
            'status' => 'success',
            'data'   => $leaveapplication,
        ]);
    }

    /**
     * Approve leave
     */
    public function approve(Leaveapplication $leaveapplication, Request $request)
    {
        $leaveapplication->update([
            'approval_status' => 'approved',
            'approved_at'     => now(),
            // approved_by_* can be set from auth user
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Leave approved',
        ]);
    }

    /**
     * Reject leave
     */
    public function reject(Leaveapplication $leaveapplication)
    {
        $leaveapplication->update([
            'approval_status' => 'rejected',
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Leave rejected',
        ]);
    }

    /**
     * Cancel leave
     */
    public function destroy(Leaveapplication $leaveapplication)
    {
        $leaveapplication->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Leave cancelled',
        ]);
    }
}

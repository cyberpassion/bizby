<?php

namespace Modules\Lead\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Lead\Models\Lead;
use Modules\Lead\Models\LeadFollowup;

class LeadFollowupApiController extends Controller
{
    /**
     * List followups for a lead
     */
    public function index(Lead $lead)
    {
        return response()->json([
            'status' => 'success',
            'data' => $lead->followups,
        ]);
    }

    /**
     * Store new followup
     */
    public function store(Request $request, Lead $lead)
    {
        $data = $request->validate([
            'contact_date' => 'required|date',
            'mode' => 'nullable|string',
            'response' => 'nullable|string',
            'remark' => 'nullable|string',
            'next_followup_date' => 'nullable|date',
        ]);

        $followup = $lead->followups()->create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Follow-up added successfully',
            'data' => $followup,
        ], 201);
    }

    /**
     * Update followup
     */
    public function update(Request $request, LeadFollowup $followup)
    {
        $followup->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Follow-up updated successfully',
            'data' => $followup,
        ]);
    }

    /**
     * Delete followup
     */
    public function destroy(LeadFollowup $followup)
    {
        $followup->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Follow-up deleted successfully',
        ]);
    }
}

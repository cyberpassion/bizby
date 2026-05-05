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
    public function index(int $id)
    {
        $lead = Lead::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $lead->followups,
        ]);
    }

    /**
     * Store new followup
     */
    public function store(Request $request, int $id)
    {
        $lead = Lead::findOrFail($id);

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
     * Update followup (shallow)
     */
    public function update(Request $request, int $id)
    {
        $followup = LeadFollowup::findOrFail($id);

        $followup->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Follow-up updated successfully',
            'data' => $followup,
        ]);
    }

    /**
     * Delete followup (shallow)
     */
    public function destroy(int $id)
    {
        $followup = LeadFollowup::findOrFail($id);

        $followup->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Follow-up deleted successfully',
        ]);
    }
}
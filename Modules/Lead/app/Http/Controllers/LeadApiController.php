<?php

namespace Modules\Lead\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Lead\Models\Lead;

class LeadApiController extends Controller
{
    /**
     * List leads
     */
    public function index(Request $request)
    {
        $query = Lead::query();

        if ($request->filled('stage_id')) {
            $query->where('stage_id', $request->stage_id);
        }

        if ($request->filled('source_id')) {
            $query->where('source_id', $request->source_id);
        }

        return response()->json([
            'status' => 'success',
            'data' => $query
                ->withCount('followups')
                ->latest()
                ->paginate(20),
        ]);
    }

    /**
     * Store new lead
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'lead_code' => 'required|unique:leads,lead_code',
            'name' => 'required|string',
            'mobile' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        $lead = Lead::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Lead created successfully',
            'data' => $lead,
        ], 201);
    }

    /**
     * Show lead with followups
     */
    public function show(Lead $lead)
    {
        return response()->json([
            'status' => 'success',
            'data' => $lead->load('followups'),
        ]);
    }

    /**
     * Update lead
     */
    public function update(Request $request, Lead $lead)
    {
        $lead->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Lead updated successfully',
            'data' => $lead,
        ]);
    }

    /**
     * Delete lead
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Lead deleted successfully',
        ]);
    }
}

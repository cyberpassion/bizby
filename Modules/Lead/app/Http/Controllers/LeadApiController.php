<?php

namespace Modules\Lead\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Lead\Models\Lead;
use Illuminate\Support\Facades\DB;

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
            'name' => 'required|string',
            'mobile' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

		$lead = DB::transaction(function () use ($data) {
		    $lead = Lead::create($data);

		    $lead->update([
        		'lead_code' => 'LEAD-' . str_pad($lead->id, 5, '0', STR_PAD_LEFT),
		    ]);

		    return $lead;
		});

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

	public function mandatoryFields() {
		return response()->json([
            'status' => 'success',
            'message' => 'Lead deleted successfully',
			'data'	=>	[]
        ]);
	}

}

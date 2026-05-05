<?php

namespace Modules\Lead\Http\Controllers;

use Modules\Lead\Models\Lead;
use Modules\Shared\Http\Controllers\SharedApiController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LeadApiController extends SharedApiController
{
    protected $searchable = [
        'name',
        'mobile',
        'email',
    ];

    /**
     * Bind model
     */
    protected function model()
    {
        return Lead::class;
    }

    /**
     * Validation rules
     */
    protected function validationRules($id = null)
	{
    	return [
	        'name'   => 'required|string|max:255',
    	    'mobile' => 'nullable|string|max:20',
        	'email'  => 'nullable|email|max:255',

	        'contact_person' => 'nullable|string|max:255',
    	    'district' => 'nullable|string|max:255',
	        'state' => 'nullable|string|max:255',
    	    'pincode' => 'nullable|string|max:20',
        	'website' => 'nullable|string|max:255',
        	'business_type' => 'nullable|string|max:255',

	        'category_id' => 'nullable|integer',
    	    'source_id' => 'nullable',
        	'stage_id' => 'nullable|string|max:255',

    	    'assigned_to_id' => 'nullable|integer',
	        'assigned_to_type' => 'nullable|string',

	        'generated_by_id' => 'nullable|integer',
    	    'generated_by_type' => 'nullable|string',

	        'is_existing_client' => 'nullable|boolean',
    	    'place' => 'nullable|string|max:255',
        	'next_followup_date' => 'nullable|date',
    	];
	}

    /* ======================================================
     | STORE (custom logic: lead_code)
     ====================================================== */
    public function store(Request $request)
	{
    	$validated = $request->validate($this->validationRules());

	    $lead = DB::transaction(function () use ($validated) {

	        $lead = Lead::create($validated);

	        $lead->update([
    	        'lead_code' => 'LEAD-' . str_pad($lead->id, 3, '0', STR_PAD_LEFT),
        	]);

	        return $lead;
    	});

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Lead created successfully',
        	'data'    => $lead,
	    ], 201);
	}

    /* ======================================================
     | SHOW (with followups)
     ====================================================== */
    public function show(int $id)
    {
        $lead = Lead::with('followups')->find($id);

        if (!$lead) {
            return response()->json([
                'status' => 'error',
                'message' => 'Resource not found.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Record fetched successfully.',
            'data'    => $lead,
        ]);
    }

    /* ======================================================
     | EXTRA ENDPOINT
     ====================================================== */
    public function mandatoryFields()
    {
        return response()->json([
            'status'  => 'success',
            'message' => 'Mandatory fields fetched',
            'data'    => []
        ]);
    }

    /* ======================================================
     | GRAPHS CONFIG
     ====================================================== */
    protected function allowedCharts(): array
	{
    	return [
	        'stage_id',
    	    'source_id',
        	'category_id',
	        'state',
    	    'district',
        	'is_existing_client',
        	'created_at',
	    ];
	}

    /* ======================================================
     | DEFAULT METRICS
     ====================================================== */
    protected function defaultMetrics(): array
    {
        return [
            'total_records',
        ];
    }

    /* ======================================================
     | DEFAULT AGGREGATES
     ====================================================== */
    protected function defaultAggregates(): array
    {
		return [
	        'count:is_existing_client=1',
    	    'count:is_existing_client=0',
			'count:stage_id=1',
	    ];
    }

    /* ======================================================
     | DEFAULT GROUPS
     ====================================================== */
    protected function defaultGroups(): array
	{
    	return [
	        'stage_id',
    	    'source_id',
        	'category_id',
        	'is_existing_client',
	    ];
	}
}
<?php

namespace Modules\Lead\Http\Controllers;

use Modules\Lead\Models\Lead;
use Modules\Shared\Http\Controllers\SharedApiController;
use Illuminate\Support\Facades\DB;

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

            'stage_id'  => 'nullable|string|max:255',
            'source_id' => 'nullable|integer',
        ];
    }

    /* ======================================================
     | STORE (custom logic: lead_code)
     ====================================================== */
    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate($this->validationRules());

        $lead = DB::transaction(function () use ($validated) {
            $lead = Lead::create($validated);

            $lead->update([
                'lead_code' => 'LEAD-' . str_pad($lead->id, 5, '0', STR_PAD_LEFT),
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
    public function show($id)
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
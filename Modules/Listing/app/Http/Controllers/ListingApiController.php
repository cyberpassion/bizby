<?php

namespace Modules\Listing\Http\Controllers;

use Modules\Listing\Models\Listing;
use Modules\Shared\Http\Controllers\SharedApiController;

class ListingApiController extends SharedApiController
{
    protected $searchable = [
        'business_name',
        'phone',
        'email',
        'city',
        'state'
    ];

    protected function model()
    {
        return Listing::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'business_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',

            'category_id' => 'nullable|integer',

            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',

            'is_verified' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',

            'valid_till' => 'nullable|date',

            'slug' => 'nullable|string|unique:listings,slug,' . $id,
        ];
    }

    /* ================= CHARTS ================= */

    protected function allowedCharts(): array
    {
        return [
            'category_id',
            'state',
            'city',
            'is_verified',
            'is_featured',
            'created_at',
        ];
    }

    /* ================= METRICS ================= */

    protected function defaultMetrics(): array
    {
        return [
            'total_records',
        ];
    }

    /* ================= AGGREGATES ================= */

    protected function defaultAggregates(): array
    {
        return [];
    }

    /* ================= GROUPS ================= */

    protected function defaultGroups(): array
    {
        return [
            'category_id',
            'state',
            'is_verified',
        ];
    }

	public function showPublic($id)
	{
    	$listing = Listing::findOrFail($id);

	    return response()->json([
    	    'status' => 'success',
        	'data' => $listing
	    ]);
	}

}
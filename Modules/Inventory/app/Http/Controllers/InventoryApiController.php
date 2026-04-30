<?php

namespace Modules\Inventory\Http\Controllers;

use Modules\Inventory\Models\InventoryItem;
use Modules\Shared\Http\Controllers\SharedApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryApiController extends SharedApiController
{
    protected $searchable = ['code', 'unit'];

    /**
     * Model binding
     */
    protected function model()
    {
        return InventoryItem::class;
    }

    /**
     * Validation rules
     */
    protected function validationRules($id = null)
    {
        return [
            'code' => 'nullable|string|max:100|unique:inventory_items,code,' . $id,

            'minimum_threshold' => 'nullable|numeric|min:0',
            'maximum_threshold' => 'nullable|numeric|min:0',

            'center_id' => 'nullable|integer',
            'product_id' => 'nullable|integer',

            'status' => 'nullable|boolean',

            'notes' => 'nullable|string',
        ];
    }

	/*
    |--------------------------------------------------------------------------
    | OVERRIDE INDEX (IMPORTANT)
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
	{
    	// Normalize "all" → null (cleaner logic)
	    $request->merge([
    	    'status'    => $request->status === 'all' ? null : $request->status,
        	'center_id' => $request->center_id === 'all' ? null : $request->center_id,
        	'search'    => $request->search === 'all' ? null : $request->search,
	    ]);

	    $query = InventoryItem::query()
    	    ->leftJoin('products', 'products.id', '=', 'inventory_items.product_id')
        	->select(
            	'inventory_items.*',
            	'products.name as product_id_label'
	        );

	    /*
    	|--------------------------------------------------------------------------
    	| Filters
    	|--------------------------------------------------------------------------
    	*/

	    if ($request->filled('status')) {
    	    $query->where('inventory_items.status', $request->status);
    	}

	    if ($request->filled('center_id')) {
    	    $query->where('inventory_items.center_id', $request->center_id);
    	}

	    if ($request->filled('search')) {
    	    $search = $request->search;

	        $query->where(function ($q) use ($search) {
    	        $q->where('inventory_items.code', 'like', "%{$search}%")
        	      ->orWhere('products.name', 'like', "%{$search}%");
	        });
    	}

	    /*
    	|--------------------------------------------------------------------------
	    | Stock Status (Computed)
    	|--------------------------------------------------------------------------
    	*/
	    $query->addSelect(\Illuminate\Support\Facades\DB::raw("
    	    CASE
        	    WHEN inventory_items.current_stock = 0 THEN 'out_of_stock'
            	WHEN inventory_items.current_stock <= inventory_items.minimum_threshold THEN 'low_stock'
            	ELSE 'in_stock'
	        END as stock_status
    	"));

	    /*
    	|--------------------------------------------------------------------------
    	| Sorting + Pagination
	    |--------------------------------------------------------------------------
    	*/
	    $data = $query
    	    ->orderBy('inventory_items.id', 'desc')
        	->paginate($request->get('limit', 20));

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Records fetched successfully.',
        	'data'    => $data
    	]);
	}

    /* ======================================================
     | GRAPHS CONFIG
     ====================================================== */
    protected function allowedCharts(): array
    {
        return [
            'unit',           // Liters / Units etc.
            'center_id',      // Center-wise stock
            'status',         // Active / Inactive
            'created_at',     // Date-wise trend
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
            'sum:current_stock',   // total stock across items
        ];
    }

    /* ======================================================
     | DEFAULT GROUPING
     ====================================================== */
    protected function defaultGroups(): array
    {
        return [
            'unit',
            'center_id',
            'status',
        ];
    }
}
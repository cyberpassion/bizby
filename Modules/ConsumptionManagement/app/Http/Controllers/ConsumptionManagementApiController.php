<?php

namespace Modules\ConsumptionManagement\Http\Controllers;

use Modules\ConsumptionManagement\Models\ConsumableTransaction;
use Modules\Shared\Http\Controllers\SharedApiController;

use Modules\ConsumptionManagement\Models\ConsumableStock;

class ConsumptionManagementApiController extends SharedApiController
{
    protected function model()
    {
        return ConsumableTransaction::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'center_id' => 'required|exists:centers,id',
            'mode' => 'required|in:refill,consumption',
            'type' => 'required|string',
            'quantity' => 'required|numeric|min:0',
            'entry_datetime' => 'required|date',
            'user' => 'required|string',
        ];
    }

    protected function allowedCharts(): array
    {
        return [
            'mode',
            'type',
            'center_id',
            'entry_datetime',
        ];
    }

    protected function defaultMetrics(): array
    {
        return [
            'total_records',
        ];
    }

    protected function defaultAggregates(): array
    {
        return [
            'count:mode=refill',
            'count:mode=consumption',
        ];
    }

    protected function defaultGroups(): array
    {
        return [
            'mode',
            'type',
            'center_id',
        ];
    }

    public function extraStats()
    {
        return [];
    }

	public function stockSummary()
	{
    	$stocks = ConsumableStock::query()
	        ->select('type', 'quantity', 'unit', 'low_threshold')
    	    ->orderBy('type')
        	->get();

	    $lowStock = $stocks->filter(function ($item) {
    	    return $item->low_threshold !== null 
        	    && $item->quantity <= $item->low_threshold;
	    })->values();

	    return response()->json([
    	    'status' => 'success',
        	'message' => 'Stock summary fetched successfully',
	        'data' => [
    	        'stocks' => $stocks,
        	    'low_stock_items' => $lowStock,
        	]
    	]);
	}
}
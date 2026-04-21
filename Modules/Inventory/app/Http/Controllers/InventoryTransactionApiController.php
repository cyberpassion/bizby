<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Models\InventoryItem;
use Modules\Inventory\Models\InventoryTransaction;

use Illuminate\Http\Response;

class InventoryTransactionApiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Superset Endpoint
    |--------------------------------------------------------------------------
    */
    public function transaction(Request $request, $itemId)
    {
        $request->validate([
            'type'     => 'required|in:in,out,adjustment,transfer',
            'quantity' => 'required|numeric|min:0.01',
            'remark'   => 'nullable|string'
        ]);

        return $this->handle($request, $itemId, $request->type);
    }

    /*
    |--------------------------------------------------------------------------
    | Dedicated Endpoints
    |--------------------------------------------------------------------------
    */
    public function stockIn(Request $request, $itemId)
    {
        return $this->handle($request, $itemId, 'in');
    }

    public function stockOut(Request $request, $itemId)
    {
        return $this->handle($request, $itemId, 'out');
    }

    public function adjust(Request $request, $itemId)
    {
        return $this->handle($request, $itemId, 'adjustment');
    }

    public function transfer(Request $request, $itemId)
    {
        return $this->handle($request, $itemId, 'transfer');
    }

    /*
    |--------------------------------------------------------------------------
    | Transaction List
    |--------------------------------------------------------------------------
    */
    public function index($itemId)
    {
        $result = InventoryTransaction::where('inventory_item_id', $itemId)
            ->latest()
            ->paginate(10);
		return response()->json([
    	    'status'  => 'success',
        	'message' => 'Records fetched successfully.',
	        'data'    => $result
    	], Response::HTTP_OK);
    }

    /*
    |--------------------------------------------------------------------------
    | Core Handler (IMPORTANT)
    |--------------------------------------------------------------------------
    */
    private function handle(Request $request, $itemId, $type)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:0.01',
        ]);

        $item = InventoryItem::findOrFail($itemId);

        $before = $item->current_stock ?? 0;
        $qty = $request->quantity;

        // Calculate stock
        if ($type === 'in') {
            $after = $before + $qty;

        } elseif ($type === 'out') {

            if ($before < $qty) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Insufficient stock'
                ], 422);
            }

            $after = $before - $qty;

        } elseif ($type === 'adjustment') {
            $after = $qty;

        } elseif ($type === 'transfer') {
            // Extend later for multi-location transfer
            $after = $before;

        } else {
            return response()->json([
                'status'  => 'error',
                'message' => 'Invalid transaction type'
            ], 400);
        }

        DB::transaction(function () use ($request, $item, $before, $after, $qty, $type) {

            InventoryTransaction::create([
                'tenant_id'         => auth()->user()->tenant_id ?? null,
                'inventory_item_id' => $item->id,
                'type'              => $type,
                'quantity'          => $qty,
                'stock_before'      => $before,
                'stock_after'       => $after,
                'reference_type'    => $request->reference_type ?? 'manual',
                'reference_id'      => $request->reference_id ?? null,
                'center_id'         => $item->center_id,
                'created_by'        => auth()->id(),
                'remark'            => $request->remark ?? null,
            ]);

            $item->update([
                'current_stock' => $after
            ]);
        });

        return response()->json([
            'status'  => 'success',
            'message' => 'Transaction successful',
            'data'    => [
                'before' => $before,
                'after'  => $after
            ]
        ]);
    }

	public function store(Request $request)
	{
    	$request->validate([
        	'inventory_item_id' => 'required|exists:inventory_items,id',
	        'type'              => 'required|in:in,out,adjustment,transfer',
    	    'quantity'          => 'required|numeric|min:0.01',
        	'remark'            => 'nullable|string'
	    ]);

	    $resource = $this->handle(
    	    $request,
        	$request->inventory_item_id,
        	$request->type
    	);

		return response()->json([
            'status' => 'success',
            'message' => 'Record created successfully.',
            'data' => $resource
        ], Response::HTTP_CREATED);
	}

}
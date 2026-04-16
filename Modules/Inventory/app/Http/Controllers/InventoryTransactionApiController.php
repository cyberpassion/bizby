<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Inventory\Models\InventoryItem;
use Modules\Inventory\Models\InventoryTransaction;

class InventoryTransactionApiController extends Controller
{
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

    public function index($itemId)
    {
        return InventoryTransaction::where('inventory_item_id', $itemId)
            ->latest()
            ->paginate(10);
    }

    private function handle(Request $request, $itemId, $type)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:0.01',
        ]);

        $item = InventoryItem::findOrFail($itemId);

        $before = $item->current_stock;
        $qty = $request->quantity;

        if ($type === 'in') {
            $after = $before + $qty;
        } elseif ($type === 'out') {
            if ($before < $qty) {
                return response()->json(['message' => 'Insufficient stock'], 400);
            }
            $after = $before - $qty;
        } elseif ($type === 'adjustment') {
            $after = $qty;
        } else {
            $after = $before; // transfer logic extend later
        }

        $transaction = InventoryTransaction::create([
            'tenant_id' => auth()->user()->tenant_id ?? null,
            'inventory_item_id' => $item->id,
            'type' => $type,
            'quantity' => $qty,
            'stock_before' => $before,
            'stock_after' => $after,
            'center_id' => $item->center_id,
            'created_by' => auth()->id(),
            'remark' => $request->remark,
        ]);

        $item->update([
            'current_stock' => $after
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Transaction successful.',
            'data' => $transaction
        ]);
    }
}
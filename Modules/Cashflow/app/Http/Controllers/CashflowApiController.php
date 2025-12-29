<?php

namespace Modules\Cashflow\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cashflow\Models\Cashflow;

class CashflowApiController extends Controller
{
    /**
     * List cashflows
     * Filters:
     * ?direction=in|out
     * ?category=fee
     * ?from=2025-01-01&to=2025-01-31
     */
    public function index(Request $request)
    {
        $query = Cashflow::query();

        if ($request->filled('direction')) {
            $query->where('direction', $request->direction);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('transaction_date', [
                $request->from,
                $request->to,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $query->latest('transaction_date')->paginate(20),
        ]);
    }

    /**
     * Store a new cashflow entry
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'direction'        => 'required|in:in,out',
            'amount'           => 'required|numeric|min:0',
            'currency'         => 'nullable|string|max:10',
            'transaction_date' => 'required|date',

            'category'     => 'nullable|string',
            'sub_category' => 'nullable|string',
            'payment_mode' => 'nullable|string',
            'reference_no' => 'nullable|string',

            'party_id'   => 'nullable|integer',
            'party_type' => 'nullable|string',

            'related_to_id'   => 'nullable|integer',
            'related_to_type' => 'nullable|string',

            'description' => 'nullable|string',
            'meta'        => 'nullable|array',
        ]);

        $cashflow = Cashflow::create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Cashflow entry created',
            'data'    => $cashflow,
        ], 201);
    }

    /**
     * Show single cashflow
     */
    public function show(Cashflow $cashflow)
    {
        return response()->json([
            'status' => 'success',
            'data'   => $cashflow,
        ]);
    }

    /**
     * Update cashflow
     */
    public function update(Request $request, Cashflow $cashflow)
    {
        $cashflow->update($request->all());

        return response()->json([
            'status'  => 'success',
            'message' => 'Cashflow updated',
            'data'    => $cashflow,
        ]);
    }

    /**
     * Delete cashflow (soft delete)
     */
    public function destroy(Cashflow $cashflow)
    {
        $cashflow->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Cashflow deleted',
        ]);
    }
}

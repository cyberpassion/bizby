<?php

namespace Modules\Asset\Http\Controllers;

use Modules\Asset\Models\Asset;
use Modules\Shared\Http\Controllers\SharedApiController;

class AssetApiController extends SharedApiController
{
    protected $searchable = ['name', 'asset_code', 'type', 'status'];
	protected $with = ['center'];

    /**
     * Model binding
     */
    protected function model()
    {
        return Asset::class;
    }

    /**
     * Validation rules
     */
    protected function validationRules($id = null)
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',

            'asset_code' => 'nullable|string|unique:assets,asset_code,' . $id,

            'serial_number' => 'nullable|string|max:100',

            'purchase_date' => 'nullable|date',
            'purchase_cost' => 'nullable|numeric',

            'center_id' => 'nullable|integer',
            'assigned_to' => 'nullable|integer',

            'status' => 'nullable|in:active,repair,not_working,disposed',

            'last_service_date' => 'nullable|date',
            'next_service_date' => 'nullable|date',

            'notes' => 'nullable|string',
        ];
    }

    /* ======================================================
     | GRAPHS CONFIG
     ====================================================== */
    protected function allowedCharts(): array
    {
        return [
            'type',             // Truck / Equipment
            'status',           // Active / Repair etc.
            'center_id',        // Location-wise
            'assigned_to',      // User-wise
            'purchase_date',    // Time trend
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
            'count:status=active',
            'count:status=repair',
            'count:status=not_working',
        ];
    }

    /* ======================================================
     | DEFAULT GROUPING
     ====================================================== */
    protected function defaultGroups(): array
    {
        return [
            'type',
            'status',
            'center_id',
        ];
    }

    /* ======================================================
     | EXTRA ENDPOINTS (as per your routes)
     ====================================================== */

    // 📜 Asset History (basic for now)
    public function history($id)
    {
        $asset = Asset::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Asset history fetched.',
            'data' => [
                'asset' => $asset,
                'history' => [] // extend later (logs, assignments, maintenance)
            ]
        ]);
    }

    // 👤 Assign Asset
    public function assign(\Illuminate\Http\Request $request, $id)
    {
        $request->validate([
            'assigned_to' => 'required|integer',
        ]);

        $asset = Asset::findOrFail($id);

        $asset->update([
            'assigned_to' => $request->assigned_to
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Asset assigned successfully.',
            'data' => $asset
        ]);
    }

    // 🔁 Transfer Asset (center change)
    public function transfer(\Illuminate\Http\Request $request, $id)
    {
        $request->validate([
            'center_id' => 'required|integer',
        ]);

        $asset = Asset::findOrFail($id);

        $asset->update([
            'center_id' => $request->center_id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Asset transferred successfully.',
            'data' => $asset
        ]);
    }

    // 🛠️ Maintenance Update
    public function maintenance(\Illuminate\Http\Request $request, $id)
    {
        $request->validate([
            'last_service_date' => 'required|date',
            'next_service_date' => 'nullable|date',
        ]);

        $asset = Asset::findOrFail($id);

        $asset->update([
            'last_service_date' => $request->last_service_date,
            'next_service_date' => $request->next_service_date,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Maintenance updated successfully.',
            'data' => $asset
        ]);
    }

    // 🔄 Status Update
    public function updateStatus(\Illuminate\Http\Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,repair,not_working,disposed',
        ]);

        $asset = Asset::findOrFail($id);

        $asset->update([
            'status' => $request->status
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Status updated successfully.',
            'data' => $asset
        ]);
    }
}
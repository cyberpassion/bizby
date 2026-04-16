<?php

namespace Modules\Inventory\Http\Controllers;

use Modules\Inventory\Models\InventoryItem;
use Modules\Shared\Http\Controllers\SharedApiController;

class InventoryApiController extends SharedApiController
{
    protected $searchable = ['name', 'code', 'unit'];

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
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100|unique:inventory_items,code,' . $id,
            'unit' => 'required|string|max:50',

            'minimum_threshold' => 'nullable|numeric|min:0',
            'maximum_threshold' => 'nullable|numeric|min:0',

            'center_id' => 'nullable|integer',
            'product_id' => 'nullable|integer',

            'status' => 'nullable|in:active,inactive',

            'notes' => 'nullable|string',
        ];
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
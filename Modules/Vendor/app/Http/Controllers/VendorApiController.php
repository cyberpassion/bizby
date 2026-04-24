<?php

namespace Modules\Vendor\Http\Controllers;

use Modules\Vendor\Models\Vendor;
use Modules\Shared\Http\Controllers\SharedApiController;

class VendorApiController extends SharedApiController
{
    protected function model()
    {
        return Vendor::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'vendor_code' => 'nullable|string|max:255|unique:vendors,vendor_code,' . $id,
            'vendor_type' => 'nullable|string|max:64',

            // Person fields (from commonPersonFields)
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',

            // Vendor specific
            'vendor_gstin' => 'nullable|string|max:255',
            'vendor_pan' => 'nullable|string|max:255',

            'state' => 'nullable|string|max:64',
            'place' => 'nullable|string|max:255',

            'incentive_percentage' => 'nullable|numeric',
        ];
    }

    protected function allowedCharts(): array
    {
        return [
            'vendor_type',
            'state',
            'status', // from commonSaasFields
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
            'count:status=Active',
            'count:status=Inactive',
        ];
    }

    protected function defaultGroups(): array
    {
        return [
            'vendor_type',
        ];
    }

    public function extraStats()
    {
        return [];
    }
}
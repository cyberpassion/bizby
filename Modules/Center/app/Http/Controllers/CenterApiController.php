<?php

namespace Modules\Center\Http\Controllers;

use Modules\Center\Models\Center;
use Modules\Shared\Http\Controllers\SharedApiController;

class CenterApiController extends SharedApiController
{
    protected function model()
    {
        return Center::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'name' => 'required|string',
            'location' => 'required|string',
            'contact' => 'required|string',
        ];
    }

    protected function allowedCharts(): array
    {
        return [
            'status',
            'capacity',
        ];
    }

    protected function defaultMetrics(): array
    {
        return [
            'total_records',
            'active_records',
            'inactive_records',
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
            'status',
        ];
    }

    public function extraStats()
    {
        return [];
    }
}
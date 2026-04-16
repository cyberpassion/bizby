<?php

namespace Modules\Maintenance\Http\Controllers;

use Modules\Maintenance\Models\Maintenance;
use Modules\Shared\Http\Controllers\SharedApiController;

class MaintenanceApiController extends SharedApiController
{
    protected function model()
    {
        return Maintenance::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'center_id' => 'required|exists:centers,id',
            'asset' => 'required|string',
            'issue_type' => 'required|string',
            'description' => 'required|string',
            'reported_date' => 'required|date',
        ];
    }

    protected function allowedCharts(): array
    {
        return [
            'issue_type',
            'status',
            'center_id',
            'reported_date',
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
            'count:status=Open',
            'count:status=In Progress',
            'count:status=Completed',
        ];
    }

    protected function defaultGroups(): array
    {
        return [
            'issue_type',
            'status',
            'center_id',
        ];
    }

    public function extraStats()
    {
        return [];
    }
}
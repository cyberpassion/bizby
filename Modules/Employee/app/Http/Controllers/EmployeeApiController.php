<?php

namespace Modules\Employee\Http\Controllers;

use Modules\Employee\Models\Employee;
use Modules\Shared\Http\Controllers\SharedApiController;

class EmployeeApiController extends SharedApiController
{
    protected function model()
    {
        return Employee::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'name'              => 'sometimes|required|string|max:255',
            'email'             => 'sometimes|required|email|unique:employees,email,' . $id,
            'phone_number'      => 'nullable|string|max:20',
            'employee_type'     => 'nullable|string|max:255',
            'designation'       => 'nullable|string|max:255',
            'date_of_joining'   => 'nullable|date',
            'date_of_relieving' => 'nullable|date|after_or_equal:date_of_joining',
            'remarks'           => 'nullable|string'
        ];
    }

    /**
     * Charts available for dashboard
     */
    protected function allowedCharts(): array
    {
        return [
            'status',
            'gender',
            'employee_type',
            'designation',
        ];
    }

    /**
     * Default KPI metrics
     */
    protected function defaultMetrics(): array
    {
        return [
            'total_records',
            'active_records',
            'inactive_records',
            'new_this_month',
        ];
    }

    /**
     * Aggregates (for cards / summary)
     */
    protected function defaultAggregates(): array
    {
        return [
            'count:gender=M',
            'count:gender=F',
            'count:status=Active',
            'count:status=Inactive',
        ];
    }

    /**
     * Grouping (for charts)
     */
    protected function defaultGroups(): array
    {
        return [
            'status',
            'gender',
        ];
    }

    /**
     * Custom stats (extra dashboard data)
     */
    public function extraStats()
    {
        return [
            'male_employees'   => Employee::where('gender', 'M')->count(),
            'female_employees' => Employee::where('gender', 'F')->count(),
            'active_employees' => Employee::where('status', 'Active')->count(),
            'inactive_employees' => Employee::where('status', 'Inactive')->count(),
            'recent_joinings'  => Employee::whereMonth('date_of_joining', now()->month)->count(),

            // Optional: salary insight (if numeric)
            // 'total_salary' => Employee::sum('current_salary'),
        ];
    }
}
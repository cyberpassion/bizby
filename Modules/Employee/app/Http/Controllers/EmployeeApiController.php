<?php

namespace Modules\Employee\Http\Controllers;

use Modules\Employee\Models\Employee;
use Modules\Shared\Http\Controllers\SharedApiController;
use Illuminate\Http\Response;

class EmployeeApiController extends SharedApiController
{
    protected function model()
    {
        return Employee::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'name' 			=> 'sometimes|required|string|max:255',
            'email'      	=> 'sometimes|required|email|unique:employees,email,' . $id,
            'phone_number'	=> 'nullable|string|max:20',
            'remarks'    	=> 'nullable|string'
        ];
    }

	public function stats()
	{

		// Overview
		$totalEmployees = Employee::count();
		$onlineEmployees = Employee::where('channel', 'online')->count();
		$inPersonEmployees = Employee::where('channel', 'in-person')->count();

		$overview = [
			'total_employees' => $totalEmployees,
			'online_employees' => $onlineEmployees,
			'in_person_employees' => $inPersonEmployees,
		];

		// Chart data - Employees by mode
		// Generate multiple charts easily
		$charts = [
    		'channel' => $this->getChartCounts('channel'),
    		'employee_type' => $this->getChartCounts('consultant_type'),
		    'status' => $this->getChartCounts('status'),   // example
		];

		$data = array_merge(["overview" => $overview], ["charts" => $charts]);

		return response()->json([
            'status' => 'success',
            'message' => 'Record fetched successfully.',
            'data' => $data
        ], Response::HTTP_OK);
	}

	public function getChartCounts($field) {
	    return Employee::select($field)
    	    ->selectRaw('COUNT(*) as total')
        	->groupBy($field)
        	->pluck('total', $field)
        	->toArray();
	}

}

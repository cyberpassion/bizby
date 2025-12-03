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

	public function extraStats()
	{
    	return [
       		'male_employees' => Employee::where('gender', 'M')->count(),
        	'female_employees' => Employee::where('gender', 'F')->count(),
        	'revenue_total' => 500000
    	];
	}

}

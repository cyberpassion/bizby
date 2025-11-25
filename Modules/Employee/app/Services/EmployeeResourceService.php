<?php

namespace Modules\Employee\Services;

class EmployeeResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Employee';
        $moduleName = $pg = 'employee';
        $res = null;

        switch ($key) {

			case 'employee/create':
			case 'employee/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'employee_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

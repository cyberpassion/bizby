<?php

namespace Modules\Patient\Services;

class PatientResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Patient';
        $moduleName = $pg = 'patient';
        $res = null;

        switch ($key) {

			case 'patient/create':
			case 'patient/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'patient_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}
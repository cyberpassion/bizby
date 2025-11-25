<?php

namespace Modules\Treatment\Services;

class TreatmentResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Treatment';
        $moduleName = $pg = 'treatment';
        $res = null;

        switch ($key) {

			case 'treatment/create':
			case 'treatment/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'treatment_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

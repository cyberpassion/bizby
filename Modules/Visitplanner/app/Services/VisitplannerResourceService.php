<?php

namespace Modules\Visitplanner\Services;

class VisitplannerResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Visitplanner';
        $moduleName = $pg = 'visitplanner';
        $res = null;

        switch ($key) {

			case 'visitplanner/create':
			case 'visitplanner/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'visitplanner_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

<?php

namespace Modules\Visitactivity\Services;

class VisitactivityResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Visitactivity';
        $moduleName = $pg = 'visitactivity';
        $res = null;

        switch ($key) {

			case 'visitactivity/create':
			case 'visitactivity/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'visitactivity_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

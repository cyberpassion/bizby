<?php

namespace Modules\Eventmanager\Services;

class EventmanagerResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Eventmanager';
        $moduleName = $pg = 'eventmanager';
        $res = null;

        switch ($key) {

			case 'eventmanager/create':
			case 'eventmanager/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'eventmanager_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

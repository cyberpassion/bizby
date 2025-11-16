<?php

namespace Modules\Service\Services;

class ServiceResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Service';
        $moduleName = $pg = 'service';
        $res = null;

        switch ($key) {

			case 'service/create':
			case 'service/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'service_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

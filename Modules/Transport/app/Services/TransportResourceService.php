<?php

namespace Modules\Transport\Services;

class TransportResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Transport';
        $moduleName = $pg = 'transport';
        $res = null;

        switch ($key) {

			case 'transport/create':
			case 'transport/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'transport_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

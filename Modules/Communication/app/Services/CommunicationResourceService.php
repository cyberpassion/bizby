<?php

namespace Modules\Communication\Services;

class CommunicationResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Communication';
        $moduleName = $pg = 'communication';
        $res = null;

        switch ($key) {

			case 'communication/create':
			case 'communication/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'communication_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

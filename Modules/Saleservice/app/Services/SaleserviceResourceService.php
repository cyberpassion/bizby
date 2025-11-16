<?php

namespace Modules\Saleservice\Services;

class SaleserviceResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Saleservice';
        $moduleName = $pg = 'saleservice';
        $res = null;

        switch ($key) {

			case 'saleservice/create':
			case 'saleservice/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'saleservice_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

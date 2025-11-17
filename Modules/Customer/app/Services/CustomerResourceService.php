<?php

namespace Modules\Customer\Services;

class CustomerResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Customer';
        $moduleName = $pg = 'customer';
        $res = null;

        switch ($key) {

			case 'customer/create':
			case 'customer/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'customer_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

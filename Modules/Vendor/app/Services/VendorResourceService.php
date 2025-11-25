<?php

namespace Modules\Vendor\Services;

class VendorResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Vendor';
        $moduleName = $pg = 'vendor';
        $res = null;

        switch ($key) {

			case 'vendor/create':
			case 'vendor/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'vendor_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

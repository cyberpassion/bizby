<?php

namespace Modules\Listing\Services;

class ListingResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Listing';
        $moduleName = $pg = 'listing';
        $res = null;

        switch ($key) {

			case 'listing/create':
			case 'listing/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'listing_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}
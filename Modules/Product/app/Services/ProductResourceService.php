<?php

namespace Modules\Product\Services;

class ProductResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Product';
        $moduleName = $pg = 'product';
        $res = null;

        switch ($key) {

			case 'product/create':
			case 'product/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'product_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

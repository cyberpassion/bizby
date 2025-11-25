<?php

namespace Modules\Admin\Services;

class AdminResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Admin';
        $moduleName = $pg = 'admin';
        $res = null;

        switch ($key) {

			case 'admin/create':
			case 'admin/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'admin_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

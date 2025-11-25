<?php

namespace Modules\Leaveapplication\Services;

class LeaveapplicationResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Leaveapplication';
        $moduleName = $pg = 'leaveapplication';
        $res = null;

        switch ($key) {

			case 'leaveapplication/create':
			case 'leaveapplication/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'leaveapplication_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

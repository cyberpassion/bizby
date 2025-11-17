<?php

namespace Modules\Signup\Services;

class SignupResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Signup';
        $moduleName = $pg = 'signup';
        $res = null;

        switch ($key) {

			case 'signup/create':
			case 'signup/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'signup_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

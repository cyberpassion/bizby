<?php

namespace Modules\Registration\Services;

class RegistrationResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Registration';
        $moduleName = $pg = 'registration';
        $res = null;

        switch ($key) {

			case 'registration/create':
			case 'registration/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'registration_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}
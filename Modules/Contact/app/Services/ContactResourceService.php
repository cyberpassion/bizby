<?php

namespace Modules\Contact\Services;

class ContactResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Contact';
        $moduleName = $pg = 'contact';
        $res = null;

        switch ($key) {

			case 'contact/create':
			case 'contact/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'contact_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

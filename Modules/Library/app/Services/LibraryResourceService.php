<?php

namespace Modules\Library\Services;

class LibraryResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Library';
        $moduleName = $pg = 'library';
        $res = null;

        switch ($key) {

			case 'library/create':
			case 'library/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'library_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

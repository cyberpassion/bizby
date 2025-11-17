<?php

namespace Modules\Test\Services;

class TestResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Test';
        $moduleName = $pg = 'test';
        $res = null;

        switch ($key) {

			case 'test/create':
			case 'test/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'test_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}
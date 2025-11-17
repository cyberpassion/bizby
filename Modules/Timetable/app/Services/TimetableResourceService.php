<?php

namespace Modules\Timetable\Services;

class TimetableResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Timetable';
        $moduleName = $pg = 'timetable';
        $res = null;

        switch ($key) {

			case 'timetable/create':
			case 'timetable/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'timetable_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

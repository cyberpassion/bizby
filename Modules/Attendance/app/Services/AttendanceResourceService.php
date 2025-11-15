<?php

namespace Modules\Attendance\Services;

class AttendanceResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Attendance';
        $moduleName = $pg = 'attendance';
        $res = null;

        switch ($key) {

			case 'attendance/create':
			case 'attendance/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'attendance_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

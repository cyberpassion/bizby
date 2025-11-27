<?php

namespace Modules\Student\Services;

class StudentResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Student';
        $moduleName = $pg = 'student';
        $res = null;

        switch ($key) {

			case 'student/create':
			case 'student/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'student_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

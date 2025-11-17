<?php

namespace Modules\Examresult\Services;

class ExamresultResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Examresult';
        $moduleName = $pg = 'examresult';
        $res = null;

        switch ($key) {

			case 'examresult/create':
			case 'examresult/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'examresult_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

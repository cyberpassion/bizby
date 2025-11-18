<?php

namespace Modules\Checklist\Services;

class ChecklistResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Checklist';
        $moduleName = $pg = 'checklist';
        $res = null;

        switch ($key) {

			case 'checklist/create':
			case 'checklist/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'checklist_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

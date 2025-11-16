<?php

namespace Modules\Lead\Services;

class LeadResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Lead';
        $moduleName = $pg = 'lead';
        $res = null;

        switch ($key) {

			case 'lead/create':
			case 'lead/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'lead_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

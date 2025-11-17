<?php

namespace Modules\Consultation\Services;

class ConsultationResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Consultation';
        $moduleName = $pg = 'consultation';
        $res = null;

        switch ($key) {

			case 'consultation/create':
			case 'consultation/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					//'consultation_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

<?php

namespace Modules\Survey\Services;

class SurveyResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Survey';
        $moduleName = $pg = 'survey';
        $res = null;

        switch ($key) {

			case 'survey/create':
			case 'survey/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'survey_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

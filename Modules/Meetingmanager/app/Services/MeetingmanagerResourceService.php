<?php

namespace Modules\Meetingmanager\Services;

class MeetingmanagerResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Meetingmanager';
        $moduleName = $pg = 'meetingmanager';
        $res = null;

        switch ($key) {

			case 'meetingmanager/create':
			case 'meetingmanager/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'meetingmanager_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

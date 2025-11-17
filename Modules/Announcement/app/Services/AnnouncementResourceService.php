<?php

namespace Modules\Announcement\Services;

class AnnouncementResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Announcement';
        $moduleName = $pg = 'announcement';
        $res = null;

        switch ($key) {

			case 'announcement/create':
			case 'announcement/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'announcement_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

<?php

namespace Modules\Note\Services;

class NoteResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Note';
        $moduleName = $pg = 'note';
        $res = null;

        switch ($key) {

			case 'note/create':
			case 'note/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'note_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

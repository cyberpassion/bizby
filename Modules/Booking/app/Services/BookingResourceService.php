<?php

namespace Modules\Booking\Services;

class BookingResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Booking';
        $moduleName = $pg = 'booking';
        $res = null;

        switch ($key) {

			case 'booking/create':
			case 'booking/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'booking_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

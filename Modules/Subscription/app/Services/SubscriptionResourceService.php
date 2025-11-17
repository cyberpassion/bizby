<?php

namespace Modules\Subscription\Services;

class SubscriptionResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Subscription';
        $moduleName = $pg = 'subscription';
        $res = null;

        switch ($key) {

			case 'subscription/create':
			case 'subscription/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'subscription_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

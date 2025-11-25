<?php

namespace Modules\Cashflow\Services;

class CashflowResourceService
{
    public static function get($key)
    {
        $moduleLabel = 'Cashflow';
        $moduleName = $pg = 'cashflow';
        $res = null;

        switch ($key) {

			case 'cashflow/create':
			case 'cashflow/update':
				$res = [
        	    	'patient_name'      => 'required|string|max:255',
					'cashflow_with'	=> 'required|string|max:255',
				];
				break;

        }

        return $res;
    }
}

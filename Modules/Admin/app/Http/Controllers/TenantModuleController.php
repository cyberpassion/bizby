<?php

namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Models\TenantModule;
use Modules\Shared\Http\Controllers\SharedApiController;

class TenantModuleController extends SharedApiController
{
    protected function model()
    {
        return TenantModule::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }

	public function extraStats()
	{
    	return [
       		'premium_plan' => TenantModule::where('plan', 'premium')->count()
    	];
	}

}

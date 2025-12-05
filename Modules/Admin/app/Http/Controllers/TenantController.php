<?php

namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Models\Tenant;
use Modules\Shared\Http\Controllers\SharedApiController;

class TenantController extends SharedApiController
{
    protected function model()
    {
        return Tenant::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }

	public function extraStats()
	{
    	return [
       		'premium_plan' => Tenant::where('plan', 'premium')->count()
    	];
	}

}

<?php

namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Models\TenantUser;
use Modules\Shared\Http\Controllers\SharedApiController;

class TenantUserController extends SharedApiController
{
    protected function model()
    {
        return TenantUser::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }

	public function extraStats()
	{
    	return [
       		'premium_plan' => TenantUser::where('plan', 'premium')->count()
    	];
	}

}

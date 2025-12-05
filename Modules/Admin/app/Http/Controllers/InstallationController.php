<?php

namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Models\Installation;
use Modules\Shared\Http\Controllers\SharedApiController;

class InstallationController extends SharedApiController
{
    protected function model()
    {
        return Installation::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }

	public function extraStats()
	{
    	return [
       		'premium_plan' => Installation::where('plan', 'premium')->count()
    	];
	}

}

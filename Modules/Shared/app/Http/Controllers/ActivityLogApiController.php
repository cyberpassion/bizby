<?php

namespace Modules\Shared\Http\Controllers;

use Modules\Shared\Models\ActivityLog;
use Modules\Shared\Http\Controllers\SharedApiController;

class ActivityLogApiController extends SharedApiController
{
	protected $searchable = ['group'];

    protected function model()
    {
        return ActivityLog::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }

	public function extraStats()
	{
    	return [];
	}

}

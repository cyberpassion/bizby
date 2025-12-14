<?php

namespace Modules\Shared\Http\Controllers;

use Modules\Shared\Models\Option;
use Modules\Shared\Http\Controllers\SharedApiController;

class OptionApiController extends SharedApiController
{
	protected $searchable = ['group'];

    protected function model()
    {
        return Option::class;
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

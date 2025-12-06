<?php

namespace Modules\Shared\Http\Controllers;

use Modules\Shared\Models\Term;
use Modules\Shared\Http\Controllers\SharedApiController;

class TermApiController extends SharedApiController
{
	protected $searchable = ['group'];

    protected function model()
    {
        return Term::class;
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

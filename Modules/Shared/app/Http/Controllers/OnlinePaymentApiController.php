<?php

namespace Modules\Shared\Http\Controllers;

use Modules\Shared\Models\OnlinePayment;
use Modules\Shared\Http\Controllers\SharedApiController;

class OnlinePaymentApiController extends SharedApiController
{
	protected $searchable = [];

    protected function model()
    {
        return OnlinePayment::class;
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

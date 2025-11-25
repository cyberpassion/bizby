<?php

namespace Modules\Customer\Http\Controllers;

use Modules\Customer\Models\Customer;
use Modules\Shared\Http\Controllers\SharedApiController;

class CustomerApiController extends SharedApiController
{
    protected function model()
    {
        return Customer::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

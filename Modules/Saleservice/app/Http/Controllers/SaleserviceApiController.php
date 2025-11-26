<?php

namespace Modules\Saleservice\Http\Controllers;

use Modules\Saleservice\Models\Saleservice;
use Modules\Shared\Http\Controllers\SharedApiController;

class SaleserviceApiController extends SharedApiController
{
    protected function model()
    {
        return Saleservice::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

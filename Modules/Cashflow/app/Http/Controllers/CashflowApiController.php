<?php

namespace Modules\Cashflow\Http\Controllers;

use Modules\Cashflow\Models\Cashflow;
use Modules\Shared\Http\Controllers\SharedApiController;

class CashflowApiController extends SharedApiController
{
    protected function model()
    {
        return Cashflow::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

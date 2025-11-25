<?php

namespace Modules\Employee\Http\Controllers;

use Modules\Employee\Models\Employee;
use Modules\Shared\Http\Controllers\SharedApiController;

class EmployeeApiController extends SharedApiController
{
    protected function model()
    {
        return Employee::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

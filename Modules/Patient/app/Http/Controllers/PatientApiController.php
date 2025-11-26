<?php

namespace Modules\Patient\Http\Controllers;

use Modules\Patient\Models\Patient;
use Modules\Shared\Http\Controllers\SharedApiController;

class PatientApiController extends SharedApiController
{
    protected function model()
    {
        return Patient::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

<?php

namespace Modules\Registration\Http\Controllers;

use Modules\Registration\Models\Registration;
use Modules\Shared\Http\Controllers\SharedApiController;

class RegistrationApiController extends SharedApiController
{
    protected function model()
    {
        return Registration::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

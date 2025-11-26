<?php

namespace Modules\Signup\Http\Controllers;

use Modules\Signup\Models\Signup;
use Modules\Shared\Http\Controllers\SharedApiController;

class SignupApiController extends SharedApiController
{
    protected function model()
    {
        return Signup::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

<?php

namespace Modules\Student\Http\Controllers;

use Modules\Student\Models\Student;
use Modules\Shared\Http\Controllers\SharedApiController;

class StudentApiController extends SharedApiController
{
    protected function model()
    {
        return Student::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

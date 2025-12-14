<?php

namespace Modules\Student\Http\Controllers;

use Modules\Student\Models\StudentAcademicYear;
use Modules\Shared\Http\Controllers\SharedApiController;
use Illuminate\Http\Request;

class StudentAcademicYearApiController extends SharedApiController
{
    protected $searchable = [];

    protected function model()
    {
        return StudentAcademicYear::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

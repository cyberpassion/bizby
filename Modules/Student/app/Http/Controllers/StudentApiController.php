<?php

namespace Modules\Student\Http\Controllers;

use Modules\Student\Models\Student;
use Modules\Shared\Http\Controllers\SharedApiController;
use Illuminate\Http\Request;

class StudentApiController extends SharedApiController
{
    protected $searchable = ['name', 'mobile', 'academic_year'];

    protected function model()
    {
        return Student::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'name' => 'required|string|max:255',
            'mobile' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'academic_level_id' => 'nullable|exists:academic_levels,id',
            'academic_year' => 'required|string',
        ];
    }
}

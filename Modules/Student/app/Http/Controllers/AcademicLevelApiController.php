<?php

namespace Modules\Student\Http\Controllers;

use Modules\Shared\Http\Controllers\SharedApiController;
use Modules\Student\Models\AcademicLevel;

class AcademicLevelApiController extends SharedApiController
{
    protected $searchable = ['name','short_name','type'];

    protected function model()
    {
        return AcademicLevel::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'name'  => 'required|string|max:200',
            'type'  => 'required|in:class,course,year,semester,section',
            'parent_id' => 'nullable|exists:academic_levels,id',
        ];
    }
}

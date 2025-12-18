<?php

namespace Modules\Student\Http\Controllers;

use Modules\Student\Models\StudentFeeStructureOverride;
use Modules\Shared\Http\Controllers\SharedApiController;
use Illuminate\Http\Request;

class StudentFeeStructureOverrideApiController extends SharedApiController
{
    protected $searchable = [];

    protected function model()
    {
        return StudentFeeStructureOverride::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

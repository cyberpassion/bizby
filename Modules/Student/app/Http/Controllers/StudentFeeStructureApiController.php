<?php

namespace Modules\Student\Http\Controllers;

use Modules\Shared\Http\Controllers\SharedApiController;
use Modules\Student\Models\StudentFeeStructure;

class StudentFeeStructureApiController extends SharedApiController
{
    protected function model()
    {
        return StudentFeeStructure::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'academic_level_id' => 'required|exists:academic_levels,id',
            'fee_head_id'       => 'required|exists:student_fee_heads,id',
            'academic_year'     => 'required|string',
            'amount'            => 'required|numeric|min:0',
        ];
    }
}

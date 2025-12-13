<?php

namespace Modules\Student\Http\Controllers;

use Modules\Student\Models\StudentOptionalFee;
use Modules\Shared\Http\Controllers\SharedApiController;

class StudentOptionalFeeApiController extends SharedApiController
{
    protected function model()
    {
        return StudentOptionalFee::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'student_id' => 'required|exists:students,id',
            'fee_head_id' => 'required|exists:student_fee_heads,id',
            'academic_year' => 'required|string',
            'is_active' => 'boolean'
        ];
    }
}

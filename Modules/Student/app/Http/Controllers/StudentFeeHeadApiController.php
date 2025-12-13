<?php

namespace Modules\Student\Http\Controllers;

use Modules\Student\Models\StudentFeeHead;
use Modules\Shared\Http\Controllers\SharedApiController;

class StudentFeeHeadApiController extends SharedApiController
{
    protected function model()
    {
        return StudentFeeHead::class;
    }

    protected function validationRules($id = null)
    {
        return [
            'name' => 'required|string|max:255',
            'frequency' => 'nullable|string',
            'default_amount' => 'nullable|numeric|min:0',
            'is_active' => 'boolean'
        ];
    }
}

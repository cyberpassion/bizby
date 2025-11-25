<?php

namespace Modules\Leaveapplication\Http\Controllers;

use Modules\Leaveapplication\Models\Leaveapplication;
use Modules\Shared\Http\Controllers\SharedApiController;

class LeaveapplicationApiController extends SharedApiController
{
    protected function model()
    {
        return Leaveapplication::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

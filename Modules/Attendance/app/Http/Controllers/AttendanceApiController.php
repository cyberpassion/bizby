<?php

namespace Modules\Attendance\Http\Controllers;

use Modules\Attendance\Models\Consultation;
use Modules\Shared\Http\Controllers\SharedApiController;

class AttendanceApiController extends SharedApiController
{
    protected function model()
    {
        return Attendance::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

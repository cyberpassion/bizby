<?php

namespace Modules\Timetable\Http\Controllers;

use Modules\Timetable\Models\Timetable;
use Modules\Shared\Http\Controllers\SharedApiController;

class TimetableApiController extends SharedApiController
{
    protected function model()
    {
        return Timetable::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

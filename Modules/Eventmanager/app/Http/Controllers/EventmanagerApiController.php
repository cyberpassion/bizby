<?php

namespace Modules\Eventmanager\Http\Controllers;

use Modules\Eventmanager\Models\Eventmanager;
use Modules\Shared\Http\Controllers\SharedApiController;

class EventmanagerApiController extends SharedApiController
{
    protected function model()
    {
        return Eventmanager::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

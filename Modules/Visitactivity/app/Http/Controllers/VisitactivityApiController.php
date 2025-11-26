<?php

namespace Modules\Visitactivity\Http\Controllers;

use Modules\Visitactivity\Models\Visitactivity;
use Modules\Shared\Http\Controllers\SharedApiController;

class VisitactivityApiController extends SharedApiController
{
    protected function model()
    {
        return Visitactivity::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

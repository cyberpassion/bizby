<?php

namespace Modules\Visitplanner\Http\Controllers;

use Modules\Visitplanner\Models\Visitplanner;
use Modules\Shared\Http\Controllers\SharedApiController;

class VisitplannerApiController extends SharedApiController
{
    protected function model()
    {
        return Visitplanner::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

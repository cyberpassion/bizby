<?php

namespace Modules\Checklist\Http\Controllers;

use Modules\Checklist\Models\Checklist;
use Modules\Shared\Http\Controllers\SharedApiController;

class ChecklistApiController extends SharedApiController
{
    protected function model()
    {
        return Checklist::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

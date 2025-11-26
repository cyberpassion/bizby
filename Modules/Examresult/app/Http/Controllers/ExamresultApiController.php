<?php

namespace Modules\Examresult\Http\Controllers;

use Modules\Examresult\Models\Examresult;
use Modules\Shared\Http\Controllers\SharedApiController;

class ExamresultApiController extends SharedApiController
{
    protected function model()
    {
        return Examresult::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}
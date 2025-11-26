<?php

namespace Modules\Treatment\Http\Controllers;

use Modules\Treatment\Models\Treatment;
use Modules\Shared\Http\Controllers\SharedApiController;

class TreatmentApiController extends SharedApiController
{
    protected function model()
    {
        return Treatment::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

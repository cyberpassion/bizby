<?php

namespace Modules\Lead\Http\Controllers;

use Modules\Lead\Models\Lead;
use Modules\Shared\Http\Controllers\SharedApiController;

class LeadApiController extends SharedApiController
{
    protected function model()
    {
        return Lead::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

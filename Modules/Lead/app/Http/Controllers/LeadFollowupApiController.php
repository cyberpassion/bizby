<?php

namespace Modules\Lead\Http\Controllers;

use Modules\Lead\Models\Lead;
use Modules\Shared\Http\Controllers\SharedChildApiController;

class LeadFollowupApiController extends SharedChildApiController
{
    protected function parentModel()
    {
        return \Modules\Lead\Models\Lead::class;
    }

    protected function childModel()
    {
        return \Modules\Lead\Models\LeadFollowup::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

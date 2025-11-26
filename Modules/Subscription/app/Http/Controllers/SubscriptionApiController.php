<?php

namespace Modules\Subscription\Http\Controllers;

use Modules\Subscription\Models\Subscription;
use Modules\Shared\Http\Controllers\SharedApiController;

class SubscriptionApiController extends SharedApiController
{
    protected function model()
    {
        return Subscription::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

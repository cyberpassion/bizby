<?php

namespace Modules\Service\Http\Controllers;

use Modules\Service\Models\Service;
use Modules\Shared\Http\Controllers\SharedApiController;

class ServiceApiController extends SharedApiController
{
    protected function model()
    {
        return Service::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

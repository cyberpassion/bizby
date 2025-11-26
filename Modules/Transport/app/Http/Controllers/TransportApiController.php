<?php

namespace Modules\Transport\Http\Controllers;

use Modules\Transport\Models\Transport;
use Modules\Shared\Http\Controllers\SharedApiController;

class TransportApiController extends SharedApiController
{
    protected function model()
    {
        return Transport::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

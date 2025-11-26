<?php

namespace Modules\Communication\Http\Controllers;

use Modules\Communication\Models\Communication;
use Modules\Shared\Http\Controllers\SharedApiController;

class CommunicationApiController extends SharedApiController
{
    protected function model()
    {
        return Communication::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

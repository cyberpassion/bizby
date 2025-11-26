<?php

namespace Modules\Test\Http\Controllers;

use Modules\Test\Models\Test;
use Modules\Shared\Http\Controllers\SharedApiController;

class TestApiController extends SharedApiController
{
    protected function model()
    {
        return Test::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

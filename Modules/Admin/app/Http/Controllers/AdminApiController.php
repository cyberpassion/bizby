<?php

namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Models\Admin;
use Modules\Shared\Http\Controllers\SharedApiController;

class AdminApiController extends SharedApiController
{
    protected function model()
    {
        return Admin::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }

}

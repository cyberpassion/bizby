<?php

namespace Modules\Library\Http\Controllers;

use Modules\Library\Models\Library;
use Modules\Shared\Http\Controllers\SharedApiController;

class LibraryApiController extends SharedApiController
{
    protected function model()
    {
        return Library::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

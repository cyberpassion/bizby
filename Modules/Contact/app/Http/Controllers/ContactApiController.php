<?php

namespace Modules\Contact\Http\Controllers;

use Modules\Contact\Models\Contact;
use Modules\Shared\Http\Controllers\SharedApiController;

class ContactApiController extends SharedApiController
{
    protected function model()
    {
        return Contact::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

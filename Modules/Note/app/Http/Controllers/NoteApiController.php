<?php

namespace Modules\Note\Http\Controllers;

use Modules\Note\Models\Note;
use Modules\Shared\Http\Controllers\SharedApiController;

class NoteApiController extends SharedApiController
{
    protected function model()
    {
        return Note::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

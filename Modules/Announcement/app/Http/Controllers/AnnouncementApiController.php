<?php

namespace Modules\Announcement\Http\Controllers;

use Modules\Announcement\Models\Announcement;
use Modules\Shared\Http\Controllers\SharedApiController;

class AnnouncementApiController extends SharedApiController
{
    protected function model()
    {
        return Announcement::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

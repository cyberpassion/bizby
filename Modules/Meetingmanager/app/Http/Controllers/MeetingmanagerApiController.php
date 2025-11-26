<?php

namespace Modules\Meetingmanager\Http\Controllers;

use Modules\Meetingmanager\Models\Meetingmanager;
use Modules\Shared\Http\Controllers\SharedApiController;

class MeetingmanagerApiController extends SharedApiController
{
    protected function model()
    {
        return Meetingmanager::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
}

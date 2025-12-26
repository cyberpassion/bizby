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
    protected function allowedCharts(): array
    {
        return [
            'meeting_type',         // Graph by type of meeting
            'priority',             // Graph by meeting priority
            'meeting_with_type',    // Graph by whom the meeting is with (e.g., client, employee)
            'meeting_date',         // Trend over dates
        ];
    }
    protected function defaultMetrics(): array
    {
        return [
            'total_records',        // Total number of meeting entries
        ];
    }

    protected function defaultAggregates(): array
    {
        return [
            'count:priority=1',     // Count of high-priority meetings
            'count:priority=2',     // Count of medium-priority meetings
            'count:priority=3',     // Count of low-priority meetings
        ];
    }

    protected function defaultGroups(): array
    {
        return [
            'meeting_type',         // Group by meeting type
            'meeting_with_type',    // Group by the type of person/entity meeting is with
        ];
    }


}

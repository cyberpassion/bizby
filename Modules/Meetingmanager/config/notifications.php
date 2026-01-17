<?php

return [

    'meetingmanager' => [

        /* =================================================
           NEW MEETING REQUEST / SCHEDULED
           → meetingmanagers table
        ================================================= */
        'new_meeting_scheduled' => [

            'source_table' => 'meetingmanagers',

            'preview' => [
                'meeting_id'          => 101,
                'recipient_name'      => 'Ravi Sharma',
                'meeting_title'       => 'Project Kickoff',
                'meeting_date'        => '2026-01-20',
                'meeting_time'        => '10:00',
                'meeting_mode'        => 'Online', // Online / Offline
                'meeting_link'        => 'https://meet.example.com/kickoff', // optional for online
                'meeting_location'    => null, // optional for offline
                'requested_by_name'   => 'Rahul Sharma',
                'phone_number'        => '9876543210',
                'email'               => 'rahul@company.com',
                'reason'              => 'Initial project discussion',
                'priority'            => 1,
            ],

            'email' => [
                'subject' => 'New Meeting Scheduled: {{ meeting_title }}',
                'view'    => 'shared::emails.meeting.new-meeting-scheduled',
            ],
        ],

        /* =================================================
           MEETING STATUS UPDATED / CANCELLED
           → meetingmanagers table
        ================================================= */
        'meeting_status' => [

            'source_table' => 'meetingmanagers',

            'preview' => [
                'meeting_id'          => 101,
                'recipient_name'      => 'Ravi Sharma',
                'meeting_title'       => 'Project Kickoff',
                'meeting_date'        => '2026-01-20',
                'meeting_time'        => '10:00',
                'meeting_mode'        => 'Online', // Online / Offline
                'status'              => 'updated', // updated | cancelled
                'meeting_link'        => 'https://meet.example.com/kickoff', // optional
                'meeting_location'    => null, // optional
                'remarks'             => 'Time changed to 2 PM',
                'updated_by'          => 'Rahul Sharma',
            ],

            'email' => [
                'subject' => '{{ status == "cancelled" ? "Meeting Cancelled" : "Meeting Updated" }}: {{ meeting_title }}',
                'view'    => 'shared::emails.meeting.meeting-status',
            ],
        ],

    ],

];

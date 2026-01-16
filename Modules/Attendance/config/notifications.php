<?php

return [

    /* =======================
       ATTENDANCE MODULE
    ======================== */
    'attendance' => [

        /* =======================
           ATTENDANCE ABSENT
        ======================== */
        'absent' => [

            'preview' => [
                'entity_name'        => 'Ravi Sharma',   // morph entity
                'attendance_status' => 'absent',
                'attendance_date'   => '2026-01-15',
                'reason'            => 'Not informed',
            ],

            'email' => [
                'subject' => 'Absence Notification',
                'view'    => 'shared::emails.attendance.attendance-absent',
            ],

            'sms' => [
                'template_id' => 'tmpl_attendance_absent',
                'message'     => '{{entity_name}} was marked absent on {{attendance_date}}.',
            ],

            'whatsapp' => [
                'template' => 'attendance_absent',
                'params'   => [
                    'entity_name',
                    'attendance_date',
                    'attendance_status',
                ],
            ],
        ],

        /* =======================
           ATTENDANCE MISSED
        ======================== */
        'missed' => [

            'preview' => [
                'entity_name'      => 'Amit Verma',
                'attendance_date' => '2026-01-15',
            ],

            'email' => [
                'subject' => 'Attendance Entry Missed',
                'view'    => 'shared::emails.attendance.attendance-missed',
            ],

            'sms' => [
                'template_id' => 'tmpl_attendance_missed',
                'message'     => 'Your attendance for {{attendance_date}} is missing.',
            ],

            'whatsapp' => [
                'template' => 'attendance_missed',
                'params'   => [
                    'entity_name',
                    'attendance_date',
                ],
            ],
        ],

        /* =======================
           ATTENDANCE STATUS UPDATE
        ======================== */
        'status' => [

            'preview' => [
                'entity_name'        => 'Amit Verma',
                'attendance_date'   => '2026-01-15',
                'attendance_status' => 'approved',
                'reason'            => 'Approved by HR',
            ],

            'email' => [
                'subject' => 'Attendance Status Update',
                'view'    => 'shared::emails.attendance.attendance-status',
            ],

            'sms' => [
                'template_id' => 'tmpl_attendance_status',
                'message'     => 'Your attendance on {{attendance_date}} has been {{attendance_status}}.',
            ],

            'whatsapp' => [
                'template' => 'attendance_status',
                'params'   => [
                    'entity_name',
                    'attendance_date',
                    'attendance_status',
                ],
            ],
        ],
    ],
];

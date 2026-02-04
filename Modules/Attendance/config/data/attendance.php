<?php

$pg = 'attendance';

return [

    /*
    |----------------------------------------------------------------------
    | List (used by backend queries)
    |----------------------------------------------------------------------
    */
    'list' => [
        'filters' => [
            'session',
            'month',
            'absent_date',
            'absentee_type',
            'absent_code',
            'is_paid',
            'status',
        ],
        'columns' => [
            'absent_date',
            'absentee_id',
            'absentee_type',
            'absent_date_part',
            'absent_duration',
            'is_paid',
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | Default Columns (Entry / List / Report)
    |----------------------------------------------------------------------
    */
    'default_columns' => [
        'entry'  => ['attendance_id','date','absentee_name','absent_date','absent_type','tags','status'],
        'list'   => ['attendance_id','date','absentee_name','absent_date','absent_type','tags','status'],
        'detail' => ['attendance_id','date','absentee_name','absent_date','absent_type','tags','status'],
        'report' => ['attendance_id','date','absentee_name','absent_date','absent_type','tags','status'],
    ],

    /*
    |----------------------------------------------------------------------
    | Report Columns
    |----------------------------------------------------------------------
    */
    'report_columns' => [
        'id',
        'absent_date',
        'session',
        'month',
        'absentee_type',
        'absentee_id',
        'absent_date_part',
        'absent_duration',
        'absent_code',
        'absent_reason',
        'is_paid',
        'created_at',
    ],

    /*
    |----------------------------------------------------------------------
    | Lookups / Enums
    |----------------------------------------------------------------------
    */
    'paid_unpaid' => [
        'false' => 'Unpaid',
        'true'  => 'Paid',
    ],

    'report_types' => [
        'attendance-register-count-only' => 'Day Attendance (Percentage & Count)',
        'attendance-register'            => 'Day Attendance (Absentee Names Highlighted)',
        'singleday-absentee'              => 'Day Absentees Only',
        'multidays-absentees-with-count'  => 'Multidays Attendance Report',
        'attendance-sheet'                => 'Attendance Sheet',
        'portal-access-report'            => 'Portal & App Access Report',
    ],

    /*
    |----------------------------------------------------------------------
    | Validation Rules
    |----------------------------------------------------------------------
    */
    'mandatory_fields' => ['selected-ids'],
    'date_fields'      => ['date'],

    /*
    |----------------------------------------------------------------------
    | Communication Templates
    |----------------------------------------------------------------------
    */
    'communication_templates' => [
        'attendance_entry_new_sms'       => 'New Attendance Entry SMS',
        'attendance_entry_new_whatsapp' => 'New Attendance Entry Whatsapp',
        'attendance_entry_new_email'    => 'New Attendance Entry Email',
    ],

    /*
    |----------------------------------------------------------------------
    | DB Tables
    |----------------------------------------------------------------------
    */
    'tables' => [
        'terms',
        'cyp_activity',
        'cyp_advancedinfo',
        'cyp_allotment',
        'cyp_cash',
        'cyp_option',
        'uploads',
        'cyp_notification',
        'cyp_message',
        'cyp_announcement',
    ],

];

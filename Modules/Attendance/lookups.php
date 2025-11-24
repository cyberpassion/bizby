<?php

$pg = 'attendance';

return [

    "communicationTemplate-attendance" => [
        "attendance_entry_new_sms"        => "New Attendance Entry SMS",
        "attendance_entry_new_whatsapp"   => "New Attendance Entry Whatsapp",
        "attendance_entry_new_email"      => "New Attendance Entry Email",
    ],

    "columnNameMapping-attendance" => [
        'attendance_id'     => 'ID',
        'absentee_name'     => 'Name',
        'absent_date'       => 'Date',
        'absent_type'       => 'Type',
        'absent_duration'   => 'Days',
        'absent_reason'     => 'Reason',
    ],

    "menuItem-attendance" => [
        "admin"  => \v3\C\Module::default_features_menu_list(['name' => 'attendance', 'label' => do_ucf('attendance')]),
        "portal" => \v3\C\Module::default_features_menu_list(['name' => 'attendance', 'label' => do_ucf('attendance')], 'portal'),
    ],

    // "pgStructure-attendance" => [
    //     "attendance" => [
    //         'forms/form' => ['entry', 'settings', 'report', 'upload'],
    //         'lists/list' => ['list'],
    //         'views/view' => array_merge(
    //             ( ($documents = \v3\M\Res::get("attendance_document-json")) ? array_keys($documents) : [] ),
    //             ['home', 'document', 'profile', 'detail', 'history']
    //         )
    //     ]
    // ],

    "mandatoryOptionsBeforeUsing-attendance" => [
        'missing_options' => []
    ],

    "moduleTable-attendance" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_announcement"
    ],

    "defaultColumns-attendance" => [
        'entry'             => ['attendance_id', 'date', 'absentee_name', 'absent_date', 'absent_type', 'tags', 'status'],
        'list'              => ['attendance_id', 'date', 'absentee_name', 'absent_date', 'absent_type', 'tags', 'status'],
        'detail'            => ['attendance_id', 'date', 'absentee_name', 'absent_date', 'absent_type', 'tags', 'status'],
        'report'            => ['attendance_id', 'date', 'absentee_name', 'absent_date', 'absent_type', 'tags', 'status'],
        'sample_export'     => ['sno', 'absentee_name', 'absentee_type', 'absent_all_dates', 'absentee_duration', 'absentee_reason', 'status'],
        'selected_columns'  => ['absentee_name', 'absentee_type', 'absent_all_dates', 'absentee_duration', 'absentee_reason', 'status']
    ],

    "mandatoryFields-attendance_entry"         => ['selected-ids'],
    "mandatoryFields-attendance_entry_new"     => ['selected-ids'],
    "mandatoryFields-attendance_entry_update"  => ['selected-ids'],

    "dateFields-attendance_entry"              => ['date'],
    "dateFields-attendance_entry_new"          => ['date'],
    "dateFields-attendance_entry_update"       => ['date'],

    "additionalFields-attendance_entry"        => [],
    "additionalFields-attendance_entry_new"    => [],
    "additionalFields-attendance_entry_update" => [],

    "listFilters-attendance-entry" => [
        "admin" => [
            'session_filter' => "Session/session/session-json",
            'month_filter'   => "Month/month/month-json",
        ],
        "portal" => [
            'session_filter' => "Session/session/session-json",
            'month_filter'   => "Month/month/month-json",
        ]
    ],

    "listFilters-attendance_sheet-filters" => [
        "admin" => [
            'month_filter'   => "Month/month/month-json",
            'date_filter'    => "Date/date/date-list",
            'session_filter' => "Session/current_session/session-json",
        ],
        "portal" => [
            'month_filter'   => "Month/month/month-json",
            'date_filter'    => "Date/date/date-list",
            'session_filter' => "Session/current_session/session-json",
        ]
    ],

    "listFilters-attendance_employee_sheet-filters" => [
        "admin" => [
            'employee_type_filter' => "Type/employee_type/employee_type-json",
            'month_filter'         => "Month/month/month-json",
            'date_filter'          => "Date/date/date-list",
            'session_filter'       => "Session/current_session/session-json",
        ],
        "portal" => [
            'employee_type_filter' => "Type/employee_type/employee_type-json",
            'month_filter'         => "Month/month/month-json",
            'date_filter'          => "Date/date/date-list",
            'session_filter'       => "Session/current_session/session-json",
        ]
    ],

    "listFilters-attendance_student_sheet-filters" => [
        "admin" => [
            'current_class_filter' => "Class/current_class/class-json",
            'month_filter'         => "Month/month/month-json",
            'date_filter'          => "Date/date/date-list",
            'session_filter'       => "Session/current_session/session-json"
        ],
        "portal" => [
            'current_class_filter' => "Class/current_class/class-json",
            'month_filter'         => "Month/month/month-json",
            'date_filter'          => "Date/date/date-list",
            'session_filter'       => "Session/current_session/session-json"
        ]
    ],

    "listFilters-attendance_tabled-options" => [
        "admin" => [
            'change_report_format' => "Format/report_type/attendance_report_type-list"
        ],
        "portal" => [
            'change_report_format' => "Format/report_type/attendance_report_type-list"
        ]
    ],

    "listFilters-attendance_entry_update" => [
        "admin" => [
            "attendance" => [
                'Edit'         => "attendance/entry/update",
                'Upload'       => "attendance/upload",
                'View Details' => "attendance/detail"
            ]
        ]
    ],

    "permissionAdmin-attendance" => [
        'restricted' => [
            '2' => [['pg' => 'attendance', 'sub_pg' => 'settings']],
            '3' => [['pg' => 'attendance', 'sub_pg' => 'settings']],
        ],
        'allowed' => []
    ],

    "permissionPortal-attendance" => [
        'restricted' => [],
        'allowed' => [
            ['pg' => 'attendance', 'sub_pg' => 'home'],
            ['pg' => 'attendance', 'sub_pg' => 'list'],
            ['pg' => 'attendance', 'sub_pg' => 'report'],
        ]
    ],

    // "permissionAllowedFiltersPortal-attendance" => [
    //     "entry" => [
    //         [
    //             "absentee_type" => '{$login_type}',
    //             "absentee_id"   => '{$login_id}'
    //         ]
    //     ],
    //     "list" => [
    //         [
    //             "absentee_type" => '{$login_type}',
    //             "absentee_id"   => '{$login_id}'
    //         ]
    //     ],
    //     "report" => [
    //         [
    //             "absentee_type" => '{$login_type}',
    //             "absentee_id"   => '{$login_id}'
    //         ]
    //     ]
    // ],

    "employee_attendance_adding_mode-json" => [
        "manual" => "Manually"
    ],

    "attendance_report_type-list" => [
        "attendance-register-count-only"   => "Day Attendance (Percentage & Count)",
        "attendance-register"              => "Day Attendance (Absentee Names Highlighted)",
        "singleday-absentee"               => "Day Absentees Only",
        "multidays-absentees-with-count"   => "Multidays Attendance Report",
        "attendance-sheet"                 => "Attendance Sheet",
        "portal-access-report"             => "Portal & App Access Report"
    ],

    // "attendance_in_out_min_duration-json" => array_combine(
    //     range(0,12),
    //     array_map(fn($i) => "$i Hours", range(0,12))
    // ),

    "attendance_permission-json" => \v3\C\Module::get_recipients_type_info(
        \v3\C\Module::get_recipients(false)
    ),

    "attendance_paid_unpaid-json" => [
        'false' => 'Unpaid',
        'true'  => 'Paid'
    ]
];

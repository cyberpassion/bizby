<?php
$pg = 'attendance';
$commonSettingsRoute = '/settings';

return [

    'sidebar-menu' => [
    [
        'title'      => ucfirst($pg),
        'href'       => "/{$pg}",
        'permission' => "{$pg}.access",
        'items'      => [

            /* =========================
             | Dashboard
             ========================= */
            [
                'title'      => 'Dashboard',
                'href'       => "/module/{$pg}/home",
                'permission' => "{$pg}.dashboard.view",
            ],

            /* =========================
             | Attendance Management
             ========================= */
            [
                'title' => 'Attendance',
                'items' => [
                    [
                        'title'      => 'Add Attendance',
                        'href'       => "/module/{$pg}/new",
                        'permission' => "{$pg}.attendance.create",
                    ],
                    [
                        'title'      => 'View List',
                        'href'       => "/module/{$pg}/list",
                        'permission' => "{$pg}.attendance.view",
                    ],
                ],
            ],

            /* =========================
             | Reports
             ========================= */
            [
                'title' => 'Reports',
                'items' => [
                    [
                        'title'      => 'Attendance Report',
                        'href'       => "/module/{$pg}/report",
                        'permission' => "{$pg}.report.attendance",
                    ],
                ],
            ],

            /* =========================
             | Settings
             ========================= */
            [
                'title' => 'Settings',
                'items' => [
                    [
                        'title'      => 'Basic Settings',
                        'href'       => "/module/{$pg}/settings",
                        'permission' => "{$pg}.settings.basic",
                    ],
                ],
            ],

            /* =========================
             | Plugins
             ========================= */
            [
                'title' => 'Plugins',
                'items' => [
                    [
                        'title'      => 'Integrations',
                        'href'       => "/module/{$pg}/plugins",
                        'permission' => "{$pg}.plugin.manage",
                    ],
                ],
            ],
        ],
    ],
],

    "attendance.list-filters" => [
        "admin" => [
            'session_filter' => "Session/session/session-json",
            'month_filter'   => "Month/month/month-json",
        ],
        "portal" => [
            'session_filter' => "Session/session/session-json",
            'month_filter'   => "Month/month/month-json",
        ]
    ],
    "attendance.default-columns" => [
        'entry'            => ['attendance_id', 'date','absentee_name','absent_date','absent_type','tags', 'status'],
        'list'             => ['attendance_id', 'date','absentee_name','absent_date','absent_type','tags', 'status'],
        'detail'           => ['attendance_id', 'date','absentee_name','absent_date','absent_type','tags', 'status'],
        'report'           => ['attendance_id', 'date','absentee_name','absent_date','absent_type','tags', 'status'],
        'sample_export'    => ['sno', 'absentee_name', 'absentee_type', 'absent_all_dates', 'absentee_duration', 'absentee_reason', 'status'],
        'selected_columns' => ['absentee_name', 'absentee_type', 'absent_all_dates', 'absentee_duration', 'absentee_reason', 'status']
    ],
    "attendance.permission-allowed-filters-portal" => [
        "entry" => [[
            "absentee_type" => '{$login_type}',
            "absentee_id"   => '{$login_id}'
        ]],
        "list" => [[
            "absentee_type" => '{$login_type}',
            "absentee_id"   => '{$login_id}'
        ]],
        "report" => [[
            "absentee_type" => '{$login_type}',
            "absentee_id"   => '{$login_id}'
        ]]
    ],
    'attendance.list-columns' => [
	    'absent_date',
    	'absentee_id',
	    'absentee_type',
    	'absent_date_part',
    	'absent_duration',
    	'is_paid',
	],

	'attendance.list-filters' => [
	    'session',
    	'month',
	    'absent_date',
    	'absentee_type',
	    'absent_code',
    	'is_paid',
    	'status',
	],

	'attendance.report-columns' => [
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

	

    

    "communicationTemplate-attendance" => [
        "attendance_entry_new_sms"       => "New Attendance Entry SMS",
        "attendance_entry_new_whatsapp" => "New Attendance Entry Whatsapp",
        "attendance_entry_new_email"    => "New Attendance Entry Email",
    ],

    "columnNameMapping-attendance" => [
        'attendance_id'   => 'ID',
        'absentee_name'   => 'Name',
        'absent_date'     => 'Date',
        'absent_type'     => 'Type',
        'absent_duration' => 'Days',
        'absent_reason'   => 'Reason',
    ],

    "mandatoryOptionsBeforeUsing-attendance" => [
        'missing_options' => []
    ],

    "moduleTable-attendance" => [
        "terms",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "uploads",
        "cyp_notification",
        "cyp_message",
        "cyp_announcement"
    ],

    "mandatoryFields-attendance-entry-update" => ['selected-ids'],
    "dateFields-attendance-entry-update"      => ['date'],


    "listFilters-attendance-sheet-filters-new" => [
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

    "listFilters-attendance-employee-sheet-filters-new" => [
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
            'session_filter'       => "Session/current_session/session-json"
        ]
    ],

    "listFilters-attendance-stduent-sheet-filters-new" => [
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

    "listFilters-attendance-tabled-options-new" => [
        "admin" => [
            'change_report_format' => "Format/report_type/attendance_report_type-list"
        ],
        "portal" => [
            'change_report_format' => "Format/report_type/attendance_report_type-list"
        ]
    ],

    "listFilters-attendance-detail-update" => [
        'admin' => [
            $pg => [
                'Edit'         => "{$pg}/entry/update",
                'Upload'       => "{$pg}/upload",
                'View Details' => "{$pg}/detail"
            ]
        ]
    ],

    "permissionAdmin-attendance" => [
        'restricted' => [
            '2' => [['pg' => $pg, 'sub_pg' => 'settings']],
            '3' => [['pg' => $pg, 'sub_pg' => 'settings']]
        ],
        'allowed' => []
    ],

    "permissionRestrictedAdmin-module" => [
        ['pg' => $pg, 'sub_pg' => 'settings']
    ],

    "permissionPortal-attendance" => [
        'restricted' => [],
        'allowed' => [
            ['pg' => $pg, 'sub_pg' => 'home'],
            ['pg' => $pg, 'sub_pg' => 'list'],
            ['pg' => $pg, 'sub_pg' => 'report'],
        ]
    ],

    "permissionAllowedPortal-module" => [
        ['pg' => $pg, 'sub_pg' => 'home'],
        ['pg' => $pg, 'sub_pg' => 'list'],
        ['pg' => $pg, 'sub_pg' => 'report'],
    ],


    "employee-attendance-adding-mode" => [
        "manual" => "Manually"
    ],

    "attendance-report-type-list" => [
        "attendance-register-count-only" => "Day Attendance (Percentage & Count)",
        "attendance-register"            => "Day Attendance (Absentee Names Highlighted)",
        "singleday-absentee"              => "Day Absentees Only",
        "multidays-absentees-with-count"  => "Multidays Attendance Report",
        "attendance-sheet"                => "Attendance Sheet",
        "portal-access-report"            => "Portal & App Access Report"
    ],

    "attendance-paid-unpaid" => [
        'false' => 'Unpaid',
        'true'  => 'Paid'
    ]
];

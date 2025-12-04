<?php
$pg = 'attendance';
$commonSettingsRoute = '/settings';

return [
	'menuItem-attendance' => [
		'admin'	=>	[
			'parent'		=>	[
				$pg	=>	'#',
			],
			'child'		=>	[
				$pg	=>	[
					['Add New'		=> "/{$pg}/create"],
	                ['View List'	=> "/{$pg}/list"],
    	            ['Report'		=> "/{$pg}/report"],
        	        ['Settings'		=> "/{$pg}/settings"],
				],
			],
		],
	],
    'sidebar-menu' => [
        [
            'title' => ucfirst($pg),
            'href' => "/{$pg}",
            'items' => [
                ['title' => 'Home', 'href' => "/module/{$pg}/home"],
				['title' => 'Add New', 'href' => "/module/{$pg}/new"],
                ['title' => 'View List', 'href' => "/module/{$pg}/list"],
                ['title' => 'Report', 'href' => "/module/{$pg}/report"],
                ['title' => 'Settings', 'href' => "/module/{$pg}/settings"],
            ],
        ],
    ],
	"communicationTemplate-attendance" => [
                        "attendance_entry_new_sms"		=>	"New Attendance Entry SMS",
                        "attendance_entry_new_whatsapp"	=>	"New Attendance Entry Whatsapp",
                        "attendance_entry_new_email"	=>	"New Attendance Entry Email",
	],
	"columnNameMapping-attendance" => [
                        'attendance_id'		=>	'ID',
                        'absentee_name'		=>	'Name',
                        'absent_date'		=>	'Date',
                        'absent_type'		=>	'Type',
                        'absent_duration'	=>	'Days',
                        'absent_reason'		=>	'Reason',
	],
	"mandatoryOptionsBeforeUsing-attendance" => [
                        'missing_options'	=>	[]
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
	"defaultColumns-attendance" => [
		                'entry'				=>	['attendance_id', 'date','absentee_name','absent_date','absent_type','tags', 'status'],
                        'list'				=>	['attendance_id', 'date','absentee_name','absent_date','absent_type','tags', 'status'],
                        'detail'			=>	['attendance_id', 'date','absentee_name','absent_date','absent_type','tags', 'status'],
                        'report'			=>	['attendance_id', 'date','absentee_name','absent_date','absent_type','tags', 'status'],
                        'sample_export'		=>	['sno', 'absentee_name', 'absentee_type', 'absent_all_dates', 'absentee_duration', 'absentee_reason', 'status'],
                        'selected_columns'	=>	['absentee_name', 'absentee_type', 'absent_all_dates', 'absentee_duration', 'absentee_reason', 'status']
	],
	"mandatoryFields-attendance_entry_update" => ['selected-ids'],

	"dateFields-attendance_entry_update" => ['date'],

	"listFilters-attendance_list" => [
                        "admin"	=>	[
                            'session_filter' => "Session/session/session-json",
                            'month_filter' => "Month/month/month-json",
                        ],
                        "portal" => [
                            'session_filter' => "Session/session/session-json",
                            'month_filter' => "Month/month/month-json",
                        ]
	],
	"listFilters-attendance_sheet-filters_new" => [
		"admin"	=>	[
                            'month_filter' => "Month/month/month-json",
                            'date_filter' => "Date/date/date-list",
                            'session_filter' => "Session/current_session/session-json",
                        ],
                        "portal" => [
                            'month_filter' => "Month/month/month-json",
                            'date_filter' => "Date/date/date-list",
                            'session_filter' => "Session/current_session/session-json",
		]
	],
	"listFilters-attendance_employee_sheet-filters_new" => [
                        "admin"	=>	[
                            'employee_type_filter' => "Type/employee_type/employee_type-json",
                            'month_filter' => "Month/month/month-json",
                            'date_filter' => "Date/date/date-list",
                            'session_filter' => "Session/current_session/session-json",
                        ],
                        "portal" => [
                            'employee_type_filter' => "Type/employee_type/employee_type-json",
                            'month_filter' => "Month/month/month-json",
                            'date_filter' => "Date/date/date-list",
                            'session_filter' => "Session/current_session/session-json"
                        ]
	],
	"listFilters-attendance_stduent_sheet-filters_new" => [
                        "admin"	=>	[
                            'current_class_filter' => "Class/current_class/class-json",
                            'month_filter' => "Month/month/month-json",
                            'date_filter' => "Date/date/date-list",
                            'session_filter' => "Session/current_session/session-json"
                        ],
                        "portal" => [
                            'current_class_filter' => "Class/current_class/class-json",
                            'month_filter' => "Month/month/month-json",
                            'date_filter' => "Date/date/date-list",
                            'session_filter' => "Session/current_session/session-json"
                        ]
	],
	"listFilters-attendance_tabled-options_new" => [
                        "admin"	=>	[
                            'change_report_format'	=>	"Format/report_type/attendance_report_type-list"
                        ],
                        "portal" => [
                            'change_report_format'	=>	"Format/report_type/attendance_report_type-list"
                        ]
	],
	"listFilters-attendance_detail_update" => [
                        'admin'	=>	array(
                            $pg			=>	[
                                'Edit'			=>	"{$pg}/entry/update",
                                'Upload'		=>	"{$pg}/upload",
                                'View Details'	=>	"{$pg}/detail"
                            ]
                        )
	],
	"permissionAdmin-attendance" => [
                        'restricted'=>	[
                            '2'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']],
                            '3'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']]
                        ],
                        'allowed'	=>	[]
    ],
	[
                        'restricted'=>	[
                            '2'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']],
                            '3'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']]
                        ],
                        'allowed'	=>	[]
    ],
	"permissionRestrictedAdmin-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'settings']
	],
	"permissionPortal-attendance" => [
                        'restricted'	=>	[],
                        'allowed'		=>	[
                            ['pg' => $pg, 'sub_pg'	=>	'home'],
                            ['pg' => $pg, 'sub_pg'	=>	'list'],
                            ['pg' => $pg, 'sub_pg'	=>	'report'],
                        ]
	],
	"permissionAllowedPortal-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'home'],
                        ['pg' => $pg, 'sub_pg'	=>	'list'],
                        ['pg' => $pg, 'sub_pg'	=>	'report'],
	],
	"permissionAllowedFiltersPortal-attendance" => [
                        "entry"	=>	[
                            [
                                "absentee_type"		=>	'{$login_type}',
                                "absentee_id"		=>	'{$login_id}'
                            ],
                        ],
                        "list"	=>	[
                            [
                                "absentee_type"		=>	'{$login_type}',
                                "absentee_id"		=>	'{$login_id}'
                            ],
                        ],
                        "report"	=>	[
                            [
                                "absentee_type"		=>	'{$login_type}',
                                "absentee_id"		=>	'{$login_id}'
                            ]
                        ]
	],
	"employee_attendance_adding_mode-json" => ["manual"=>"Manually"],

	"attendance_report_type-list" => [
                        "attendance-register-count-only"	=>	"Day Attendance (Percentage & Count)",
                        "attendance-register"				=>	"Day Attendance (Absentee Names Highlighted)",
                        "singleday-absentee"				=>	"Day Absentees Only",
                        "multidays-absentees-with-count"	=>	"Multidays Attendance Report",
                        "attendance-sheet"					=>	"Attendance Sheet",
                        "portal-access-report"				=>	"Portal & App Access Report"
	],
	"attendance_paid_unpaid-json" => [
		                'false'	=>	'Unpaid',
                        'true'	=>	'Paid'
	]

];

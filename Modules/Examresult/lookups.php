<?php
$pg = 'examresult';
$commonSettingsRoute = '/settings';

return [
	'menuItem-examresult' => [
    'admin' => [
        'parent' => [
            $pg => '#',
        ],
        'child' => [
            $pg => [
                ['Add New'   => "/{$pg}/create"],
                ['View List' => "/{$pg}/list"],
                ['Report'    => "/{$pg}/report"],
                ['Settings'  => "/{$pg}/settings"],
                [
                    'Plugin' => [
                        ['View Calendar' => "/{$pg}/plugin/calendar"],
                    ]
                ],
            ],
        ],
    ],
],

'sidebar-menu' => [
    [
        'title' => ucfirst($pg),
        'href'  => "/{$pg}",
        'items' => [
            ['title' => 'Home',      'href' => "/module/{$pg}/home"],
            ['title' => 'Add New',   'href' => "/module/{$pg}/create"],
            ['title' => 'View List', 'href' => "/module/{$pg}/list"],
            ['title' => 'Report',    'href' => "/{$pg}/report"],
            ['title' => 'Settings',  'href' => "/{$pg}/settings"],
            [
                'title' => 'Plugin',
                'items' => [
                    ['title' => 'View Calendar', 'href' => "/{$pg}/plugin/calendar"],
                ]
            ],
        ],
    ],
],

    "communicationTemplate-examresult" => [
                        "examresult_entry_new_sms"		=>	"New Examresult Entry SMS",
                        "examresult_entry_new_whatsapp"	=>	"New Examresult Entry Whatsapp",
                        "examresult_entry_new_email"	=>	"New Examresult Entry Email",
                        "examresult_marks_new_sms"		=>	"New Examresult Marks SMS",
                        "examresult_marks_new_whatsapp"	=>	"New Examresult Marks Whatsapp",
                        "examresult_marks_new_email"	=>	"New Examresult Marks Email",
    ],
    "columnNameMapping-examresult" => [
                        'ptr'					=>	'SNo',
                        'exam_id'				=>	'ID',
                        'exam_name'				=>	'Name',
                        'exam_session'			=>	'Session',
                        'exam_class'			=>	'Class',
                        'exam_section'			=>	'Section',
                        'status'				=>	'Status',
                        'options'				=>	'Options'
    ],
    "moduleTable-examresult" => [
                        "terms",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "uploads",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_examresult",
                        "cyp_examresult_mark"
    ],
    "defaultColumns-examresult" => [
                        'entry'				=>	['exam_id', 'exam_name', 'exam_class', 'exam_section', 'exam_session','tags', 'status'],
                        'list'				=>	['exam_id', 'exam_name', 'exam_class', 'exam_section', 'exam_session','tags', 'status'],
                        'detail'				=>	['exam_id', 'exam_name', 'exam_class', 'exam_section', 'exam_session','tags', 'status'],
                        'report'				=>	['exam_id', 'exam_name', 'exam_class', 'exam_section', 'exam_session','tags', 'status'],
                        'sample_export'		=>	['sno', 'exam_name', 'exam_class', 'exam_section', 'exam_session'],
                        'selected_columns'	=>	['exam_name', 'exam_class', 'exam_section', 'exam_session']
    ],
    "mandatoryFields-examresult_entry_update" => ['module', 'examresult_official_name', 'examresult_official_address', 'examresult_official_email', 'examresult_official_phone', 'send_notification_message'],

    "listFilters-examresult_list" => [
                        "admin"	=>	[
                            'session' => "Session/exam_session/session-json",
                            'class' => "Class/exam_class/class-json",
                            'status' => "Status/status/status-json",
    
                        ],
                        "portal" => [
                            'session' => "Session/exam_session/session-json",
                            'class' => "Class/exam_class/class-json",
                            'status' => "Status/status/status-json"
                        ]
    ],
    "listFilters-examresult_tabled-options_new" => [
                        "admin"	=>	[
                            'sortby' => "Sort By/sortby/examresult_sortby-json",
                            'entry_type' => "Display/display_type/examresult_display_type-json",
                        ],
                        "portal" => [
                            'sortby' => "Sort By/sortby/examresult_sortby-json",
                            'entry_type' => "Display/display_type/examresult_display_type-json",
                        ]
    ],
    "listFilters-examresult_single-report-card_new" => [
                        "admin"	=>	[
                            'display_graph' => "Display Graph/display_graph/is_graph_to_display-json",
                            'debug' 		=> "Debugging Active/debug/is_debugging_active-json",
                        ],
                        "portal" => [
                            'display_graph' => "Display Graph/display_graph/is_graph_to_display-json",
                            'debug' 		=> "Debugging Active/debug/is_debugging_active-json",
                        ]
    ],
    "listFilters-examresult_detail_update" => [
                        'admin'	=>	array(
                            $pg			=>	[
                                'View Results'		=>	"report/examresult-marks-report/view",
                                'Add/Update Result'	=>	"{$pg}/marks-entry"
                            ]
                        ),
                        'portal'	=>	array(
                            $pg			=>	[
                                'View Result'		=>	"{$pg}/report-card",
                            ]
                        )
    ],
    "listFilters-examresult_examresult-report_new" => [
                        "admin"	=>	[
                            'examresult_report_type_filter' => "Report Type/report_type/examresult_report_type-list"
                        ],
                        "portal" => [
                            'examresult_report_type_filter' => "Report Type/report_type/examresult_report_type-list"
                        ]
    ],
    "permissionAdmin-examresult" => [
                        'restricted'=>	[
                            '2'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']],
                            '3'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']]
                        ],
                        'allowed'	=>	[]
    ],
    "permissionRestrictedAdmin-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'settings']
    ],
    "permissionPortal-examresult" => [
                        'restricted'	=>	[],
                        'allowed'		=>	[
                            ['pg' => $pg, 'sub_pg'	=>	'home'],
                            ['pg' => $pg, 'sub_pg'	=>	'list'],
                            ['pg' => $pg, 'sub_pg'	=>	'report-card'],
                            //['pg' => $pg, 'sub_pg'	=>	'settings']
                        ]
    ],
    "permissionAllowedPortal-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'home'],
                        //['pg' => $pg, 'sub_pg'	=>	'entry'],
                        ['pg' => $pg, 'sub_pg'	=>	'list'],
                        //['pg' => $pg, 'sub_pg'	=>	'report'],
                        //['pg' => $pg, 'sub_pg'	=>	'settings']
    ],
    "permissionAllowedFiltersPortal-module" => [
                        "entry"  => [[ "exam_class" => '{$current_class}' ]],
                        "list"   => [[ "exam_class" => '{$current_class}' ]],
                            "report" => [[ "exam_class" => '{$current_class}' ]]
    ],
    "examresult_sortby-json" => ["admission_id"=>"Admission ID","student_name"=>"Name","rank"=>"Rank"],

    "examresult_display_type-json" => ["all-students"=>"All Students","student-with-marks"=>"Student With Marks","student-without-marks"=>"Student Without Marks"],

    "performance_exam_result-json" => ["PASSED, FIRST DIVISION","PASSED, SECOND DIVISION","PASSED, THIRD DIVISION","PASSED, FOURTH DIVISION","FAILED"],

    "student_examresult_report_type-list" => ["tabled"=>"Tabled","graphical"=>"Graphical"],

    "examresult_report_type-list" => [
                        "divisionwise-list"		=>	"Division-Wise List",
                        "percentagewise-list"	=>	"Percentage-Wise List",
                        "namewise-list"			=>	"Namewise List"
    ],
    "examresult_eoy_report_card_format-list" => [
                        "cbse"			=>	"CBSE",
                        "writtenoral"	=>	"Written & Oral",
                        "sapa"			=>	"Subject Assessment & Periodic Assessment",
                        "hy"			=>	"Half-Yearly & Annual"
    ],
    "examresult_bulk_operation-list" => [
                        'examresult:single-report-card'		=>	'Print Report Card',
                        'examresult:eoy-report-card'		=>	'Print EOY Report Card',
                        //'examresult:send-marks-sms'			=>	'Send Marks SMS',
                        'op:delete'							=>	'Delete',
                        'op:restore'						=>	'Restore'
    ]

];

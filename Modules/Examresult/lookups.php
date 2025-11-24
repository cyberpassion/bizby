<?php
$pg = 'examresult';

return [

    // -------------------------------
    // Communication Templates
    // -------------------------------
    "communicationTemplate-examresult" => [
        "examresult_entry_new_sms"       => "New Examresult Entry SMS",
        "examresult_entry_new_whatsapp"  => "New Examresult Entry Whatsapp",
        "examresult_entry_new_email"     => "New Examresult Entry Email",
        "examresult_marks_new_sms"       => "New Examresult Marks SMS",
        "examresult_marks_new_whatsapp"  => "New Examresult Marks Whatsapp",
        "examresult_marks_new_email"     => "New Examresult Marks Email"
    ],

    // -------------------------------
    // Column Name Mapping
    // -------------------------------
    "columnNameMapping-examresult" => [
        'ptr'           => 'SNo',
        'exam_id'       => 'ID',
        'exam_name'     => 'Name',
        'exam_session'  => 'Session',
        'exam_class'    => 'Class',
        'exam_section'  => 'Section',
        'status'        => 'Status',
        'options'       => 'Options'
    ],

    // -------------------------------
    // Menu
    // -------------------------------
    "menuItem-examresult" => [
        "admin"  => [],
        "portal" => []
    ],

    // -------------------------------
    // Page Structure
    // -------------------------------
    "pgStructure-examresult" => [
        "examresult" => [
            'forms/form'  => ['entry','marks-entry','report','settings','upload'],
            'lists/list'  => ['list'],
            'views/view'  => ['home','document','profile','detail','history','report-card']
        ]
    ],

    // -------------------------------
    // Mandatory Options
    // -------------------------------
    "mandatoryOptionsBeforeUsing-examresult" => [
        "all" => [
            "missing_option" => [
                [
                    "label"       => "Examresult End of Year Format Not Set",
                    "option_name" => "examresult_eoy_report_card_format",
                    "routeLabel"  => "Set Now",
                    "routes"      => [
                        'php' => "/examresult/settings",
                        'pwa' => "/examresult/settings",
                        'app' => "/examresult/settings"
                    ]
                ]
            ]
        ]
    ],

    // -------------------------------
    // Module Tables
    // -------------------------------
    "moduleTable-examresult" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_examresult",
        "cyp_examresult_mark"
    ],

    // -------------------------------
    // Default Columns
    // -------------------------------
    "defaultColumns-examresult" => [
        'entry'            => ['exam_id', 'exam_name', 'exam_class', 'exam_section', 'exam_session','tags', 'status'],
        'list'             => ['exam_id', 'exam_name', 'exam_class', 'exam_section', 'exam_session','tags', 'status'],
        'detail'           => ['exam_id', 'exam_name', 'exam_class', 'exam_section', 'exam_session','tags', 'status'],
        'report'           => ['exam_id', 'exam_name', 'exam_class', 'exam_section', 'exam_session','tags', 'status'],
        'sample_export'    => ['sno', 'exam_name', 'exam_class', 'exam_section', 'exam_session'],
        'selected_columns' => ['exam_name', 'exam_class', 'exam_section', 'exam_session']
    ],

    // -------------------------------
    // Mandatory Fields
    // -------------------------------
    "mandatoryFields-examresult_entry" => [
        'module',
        'examresult_official_name',
        'examresult_official_address',
        'examresult_official_email',
        'examresult_official_phone',
        'send_notification_message'
    ],

    // -------------------------------
    // Date Fields
    // -------------------------------
    "dateFields-examresult_entry" => [],

    // -------------------------------
    // Additional Fields
    // -------------------------------
    "additionalFields-examresult_entry" => [],

    // -------------------------------
    // List Filters
    // -------------------------------
    "listFilters-examresult_entry" => [
        "admin"  => [
            'session' => "Session/exam_session/session-json",
            'class'   => "Class/exam_class/class-json",
            'status'  => "Status/status/status-json"
        ],
        "portal" => [
            'session' => "Session/exam_session/session-json",
            'class'   => "Class/exam_class/class-json",
            'status'  => "Status/status/status-json"
        ]
    ],

    "listFilters-examresult_tabled-options" => [
        "admin"  => [
            'sortby'     => "Sort By/sortby/examresult_sortby-json",
            'entry_type' => "Display/display_type/examresult_display_type-json"
        ],
        "portal" => [
            'sortby'     => "Sort By/sortby/examresult_sortby-json",
            'entry_type' => "Display/display_type/examresult_display_type-json"
        ]
    ],

    "listFilters-examresult_single-report-card" => [
        "admin"  => [
            'display_graph' => "Display Graph/display_graph/is_graph_to_display-json",
            'debug'         => "Debugging Active/debug/is_debugging_active-json"
        ],
        "portal" => [
            'display_graph' => "Display Graph/display_graph/is_graph_to_display-json",
            'debug'         => "Debugging Active/debug/is_debugging_active-json"
        ]
    ],

    "listFilters-examresult_entry_update" => [
        'admin'  => [
            'examresult' => [
                'View Results'      => "report/examresult-marks-report/view",
                'Add/Update Result' => "examresult/marks-entry"
            ]
        ],
        'portal' => [
            'examresult' => [
                'View Result'       => "examresult/report-card"
            ]
        ]
    ],

    "listFilters-examresult_examresult-report" => [
        "admin"  => [
            'examresult_report_type_filter' => "Report Type/report_type/examresult_report_type-list"
        ],
        "portal" => [
            'examresult_report_type_filter' => "Report Type/report_type/examresult_report_type-list"
        ]
    ],

    // -------------------------------
    // Permission (Admin)
    // -------------------------------
    "permissionAdmin-examresult" => [
        "restricted" => [
            "2" => [["pg"=>"examresult","sub_pg"=>"settings"]],
            "3" => [["pg"=>"examresult","sub_pg"=>"settings"]]
        ],
        "allowed" => []
    ],

    // -------------------------------
    // Permission (Portal)
    // -------------------------------
    "permissionPortal-examresult" => [
        "restricted" => [],
        "allowed"    => [
            ["pg"=>"examresult","sub_pg"=>"home"],
            ["pg"=>"examresult","sub_pg"=>"list"],
            ["pg"=>"examresult","sub_pg"=>"report-card"]
        ]
    ],

    // -------------------------------
    // Allowed Portal Filters
    // -------------------------------
    // "permissionAllowedFiltersPortal-examresult" => [
    //     "entry"  => [["exam_class"=>'{$current_class}']],
    //     "list"   => [["exam_class"=>'{$current_class}']],
    //     "report" => [["exam_class"=>'{$current_class}']]
    // ],

    // -------------------------------
    // Exam Result Sortby
    // -------------------------------
    "examresult_sortby-json" => [
        "admission_id" => "Admission ID",
        "student_name" => "Name",
        "rank"         => "Rank"
    ],

    // -------------------------------
    // Exam Result Display Type
    // -------------------------------
    "examresult_display_type-json" => [
        "all-students"       => "All Students",
        "student-with-marks" => "Student With Marks",
        "student-without-marks" => "Student Without Marks"
    ],

    // -------------------------------
    // Exam Results
    // -------------------------------
    "performance_exam_result-json" => [
        "PASSED, FIRST DIVISION",
        "PASSED, SECOND DIVISION",
        "PASSED, THIRD DIVISION",
        "PASSED, FOURTH DIVISION",
        "FAILED"
    ],

    // -------------------------------
    // Student Exam Result Report Type
    // -------------------------------
    "student_examresult_report_type-list" => [
        "tabled"    => "Tabled",
        "graphical" => "Graphical"
    ],

    // -------------------------------
    // Exam Result Report Type
    // -------------------------------
    "examresult_report_type-list" => [
        "divisionwise-list"    => "Division-Wise List",
        "percentagewise-list"  => "Percentage-Wise List",
        "namewise-list"        => "Namewise List"
    ],

    // -------------------------------
    // Exam Formats
    // -------------------------------
    "examresult_eoy_report_card_format-list" => [
        "cbse"       => "CBSE",
        "writtenoral"=> "Written & Oral",
        "sapa"       => "Subject Assessment & Periodic Assessment",
        "hy"         => "Half-Yearly & Annual"
    ],

    // -------------------------------
    // Bulk Operations
    // -------------------------------
    "examresult_bulk_operation-list" => [
        "examresult:single-report-card" => "Print Report Card",
        "examresult:eoy-report-card"    => "Print EOY Report Card",
        "op:delete"                     => "Delete",
        "op:restore"                    => "Restore"
    ],

    // -------------------------------
    // Status
    // -------------------------------
    "examresult_status-json" => [
        "1" => "Active",
        "2" => "Inactive",
        "3" => "Deleted"
    ],

];

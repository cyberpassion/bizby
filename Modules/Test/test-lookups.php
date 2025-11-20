<?php

$pg = 'test';

return [
    // Communication Templates
    "communicationTemplate-test" => [
        "test_entry_new_sms"       => "New Test Entry SMS",
        "test_entry_new_whatsapp"  => "New Test Entry Whatsapp",
        "test_entry_new_email"     => "New Test Entry Email",
    ],

    // Column Name Mapping
    "columnNameMapping-test" => [
        'ptr'                     => 'SNo',
        'package_id'              => 'P/ID',
        'package_name'            => 'P/Name',
        'all_package_items'       => 'All/Items',
        'active_package_items'    => 'Items',
        'draft_package_items'     => 'Items',
        'active_subscriptions'    => 'Active Subs',
        'inactive_subscriptions'  => 'Lost Subs',
        'test_id'                 => 'ID',
        'date'                    => 'Date',
        'total_time'              => 'Dur (mts)',
        'test_name'               => 'Name',
        'test_date'               => 'Date',
        'start_time'              => 'Start',
        'end_time'                => 'End',
        'question_count'          => 'Total Qns',
        'language_question_status'=> 'Questions',
        'student_name'            => 'S/Name',
        'current_class'           => 'Class',
        'current_section'         => 'Section',
        'current_session'         => 'Session'
    ],

    // Default Columns
    "defaultColumns-test" => [
        'entry'             => ['test_id','package_name','test_name','test_date','start_time','end_time','total_time','question_count','language_question_status','all_recipients','tags','status'],
        'list'              => ['test_id','package_name','test_name','test_date','start_time','end_time','total_time','question_count','language_question_status','all_recipients','tags','status'],
        'detail'            => ['test_id','package_name','test_name','test_date','start_time','end_time','total_time','question_count','language_question_status','all_recipients','tags','status'],
        'report'            => ['test_id','package_name','test_name','test_date','start_time','end_time','total_time','question_count','language_question_status','all_recipients','tags','status'],
        'sample_export'     => ['sno','test_name','test_date','start_time','end_time','total_time','question_count','language_question_status'],
        'selected_columns'  => ['test_name','test_date','start_time','end_time','total_time','question_count','language_question_status']
    ],

    // Module Tables
    "moduleTable-test" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_test",
        "cyp_test_question_multiplechoice",
        "cyp_test_question_pool_multiplechoice",
        "cyp_test_result"
    ],

    // Mandatory Fields
    "mandatoryFields-test_entry" => ['test_name','question_count','total_time'],
    "mandatoryFields-test_package-entry" => ['package_name','package_information'],

    // Date Fields
    "dateFields-test_entry" => [],

    // Additional Fields
    "additionalFields-test_entry" => [],

    // Cron List
    "cronList-test" => ['test-remindertoexaminees' => 'Test Reminder Notification'],

    // List Filters
    "listFilters-test_entry" => [
        "admin" => [
            'session'          => 'Session/session/session-json',
            'recipient'        => 'Recipient/recipient/recipient_grouped_simplified-json',
            'status'           => 'Status/status/test_status-json',
            'test_date_filter' => 'Date/date/test_date-json',
        ],
        "portal" => [
            'session'          => 'Session/session/session-json',
            'recipient'        => 'Recipient/recipient/recipient_grouped_simplified-json',
            'status'           => 'Status/status/test_status-json',
            'test_date_filter' => 'Date/date/test_date-json',
        ]
    ],

    "listFilters-test_package-entry" => [
        "admin" => [
            'recipient' => 'Recipient/recipient/recipient_grouped_simplified-json',
            'status'    => 'Status/status/test_package_status-json',
        ],
        "portal" => [
            'recipient' => 'Recipient/recipient/recipient_grouped_simplified-json',
            'status'    => 'Status/status/test_package_status-json',
        ]
    ],

    "listFilters-test_pool" => [
        "admin" => [
            'language' => 'Language/language/test_pool_language-json',
            'category' => 'Category/category/test_pool_category-json',
            'tag'      => 'Tag/tag/test_pool_tag-json',
            'level'    => 'Level/level/test_pool_level-json',
            'limit'    => 'Limit/limit/test_pool_limit-json',
        ],
        "portal" => [
            'language' => 'Language/language/test_pool_language-json',
            'category' => 'Category/category/test_pool_category-json',
            'tag'      => 'Tag/tag/test_pool_tag-json',
            'level'    => 'Level/level/test_pool_level-json',
            'limit'    => 'Limit/limit/test_pool_limit-json',
        ]
    ],

    // Permission Templates
    "permissionAdmin-test" => [
        'restricted' => [
            '2' => [['pg' => $pg, 'sub_pg' => 'settings']],
            '3' => [['pg' => $pg, 'sub_pg' => 'settings']]
        ],
        'allowed' => []
    ],

    "permissionPortal-test" => [
        'restricted' => [],
        'allowed' => [
            ['pg' => $pg, 'sub_pg' => 'home'],
            ['pg' => $pg, 'sub_pg' => 'list'],
            ['pg' => $pg, 'sub_pg' => 'detail'],
            ['pg' => $pg, 'sub_pg' => 'live'],
        ]
    ],

    // Allowed Filters for Portal
    "permissionAllowedFiltersPortal-test" => [
        "entry"  => [["generated_by" => '{$login_type}-{$login_id}', "contact_by" => '{$login_type}-{$login_id}']],
        "list"   => [["generated_by" => '{$login_type}-{$login_id}', "contact_by" => '{$login_type}-{$login_id}']],
        "report" => [["generated_by" => '{$login_type}-{$login_id}', "contact_by" => '{$login_type}-{$login_id}']],
    ],

    // Test Bulk Operations
    "test_bulk_operation-list" => [
        "view:detail"     => "View Detail",
        "document:results"=> "View Results",
        "op:remove"       => "Delete",
        "op:restore"      => "Restore"
    ],

    // Test JSON Placeholders
    "test_date-json" => [],
    "test_status-json" => [],
    "test_package_status-json" => [],
    "test_document-json" => ['question-paper' => 'Question Paper'],
    "test_pool_language-json" => ['en' => 'English', 'hi' => 'Hindi'],
    "test_pool_level-json" => ['Beginner','Intermediate','Advanced'],
    "test_pool_limit-json" => ['25','50','75','100'],
    "test_interface-json" => ['portal' => 'Student Portal'],
    "test_format-json" => ['multiple-choice' => 'Multiple-Choice','multiple-choice-from-pool'=>'Multiple-Choice From Pool'],
    "test_question_source-json" => ['create-set' => 'No Source, Create Set', 'autogenerate-set-from-pool'=>'Generate From Questions Pool'],
    "test_offline_sheet_format-json" => ['offline-sheet-inline'=>'Inline Questions','offline-sheet-2cols'=>'2cols Questions'],

    // Menu Items
    "menuItem-test" => [
        "admin" => [
            'parent' => [
                ucfirst($pg) => ['/'.$pg, 'sidebar_menu_list_placeholder']
            ],
            'child' => [
                $pg => [
                    'Single Test' => '/'.$pg.'/entry',
                    'Package'     => '/'.$pg.'/package-entry',
                    'Pool'        => '/'.$pg.'/list?type=questions-pool',
                    'Settings'    => '/'.$pg.'/settings'
                ]
            ],
            'child-2' => [
                'test-single-test' => [
                    'Create New' => '/'.$pg.'/entry',
                    'View List'  => '/'.$pg.'/list',
                    'View Report'=> '/'.$pg.'/report'
                ],
                'test-package' => [
                    'Create New' => '/'.$pg.'/package-entry',
                    'View List'  => '/'.$pg.'/package-list',
                    'View Report'=> '/'.$pg.'/package-report'
                ]
            ]
        ],
        "portal" => ['default_features_menu_list_placeholder']
    ],

    // Page Structure
    "pgStructure-test" => [
        $pg => [
            'forms/form'  => ['entry', 'package-entry', 'question-entry', 'pool-question-entry', 'live', 'settings', 'package-report', 'report', 'upload'],
            'lists/list'  => ['list','package-list','package-subscription-list'],
            'views/view'  => ['home','document','profile','result','detail','package-detail','history','question-paper']
        ]
    ],
];

<?php

$pg = 'visitplanner';

return [

    // Communication Templates
    "communicationTemplate-visitplanner" => [
        "visitplanner_entry_new_sms"                => "New Visitplanner Entry SMS",
        "visitplanner_entry_new_whatsapp"          => "New Visitplanner Entry Whatsapp",
        "visitplanner_entry_new_email"             => "New Visitplanner Entry Email",
        "visitplanner_scheduledvisits_new_sms"    => "New Visitplanner Scheduled Visits SMS",
        "visitplanner_scheduledvisits_new_whatsapp"=> "New Visitplanner Scheduled Visits Whatsapp",
        "visitplanner_scheduledvisits_new_email"  => "New Visitplanner Scheduled Visits Email"
    ],

    // Column Name Mapping
    "columnNameMapping-visitplanner" => [
        'visitplanner_id'    => 'VID',
        'visit_by_name'      => 'Name',
        'visit_date'         => 'V/Date',
        'visit_time'         => 'Time',
        'visit_company'      => 'Company',
        'session'            => 'Session',
        'month'              => 'Month',
        'week'               => 'Week',
        'created_by_name'    => 'Created By',
        'visit_address'      => 'Address',
        'visit_count'        => 'V/Count',
        'visit_expectation'  => 'Expectation',
        'visit_product'      => 'Products'
    ],

    // Menu Items
    /*"menuItem-visitplanner" => [
        "admin"  => \v3\C\Module::default_features_menu_list(['name' => $pg, 'label' => do_ucf($pg)]),
        "portal" => [
            'parent' => [
                do_ucf($pg) => [
                    \Route::to_home($pg),
                    \v4\C\UI::sidebarmenu_list($pg)
                ],
            ],
            'child' => [
                $pg => [
                    'Add Visit'     => \Route::to_entry($pg),
                    'My Visits'     => \Route::to_list($pg),
                    'Visit Report'  => get_link($pg . '/report')
                ]
            ]
        ]
    ],*/

    // Page Structure
    /*"pgStructure-visitplanner" => [
        $pg => [
            'forms/form' => ['entry', 'settings', 'report'],
            'lists/list' => ['list'],
            'views/view' => array_merge(array_keys(\v3\M\Res::get("{$pg}_document-json") ?: []), ['home', 'document', 'detail', 'history'])
        ]
    ],*/

    // Mandatory Options
    "mandatoryOptionsBeforeUsing-visitplanner" => [
        'missing_option' => []
    ],

    // Module Tables
    "moduleTable-visitplanner" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_visitplanner"
    ],

    // Default Columns
    "defaultColumns-visitplanner" => [
        'entry'            => ['ID','visitplanner_id','visit_company','visit_by_name','month','week','created_by_name','tags','status'],
        'list'             => ['ID','visitplanner_id','visit_company','visit_by_name','month','week','created_by_name','tags','status'],
        'detail'           => ['ID','visitplanner_id','visit_company','visit_by_name','month','week','created_by_name','tags','status'],
        'report'           => ['ID','visitplanner_id','visit_company','visit_by_name','month','week','created_by_name','tags','status'],
        'sample_export'    => ['sno','visit_company','visit_meetingwith','visit_mobile_number','visit_email','session','month','week'],
        'selected_columns' => ['visitplanner_id','visit_company','visit_by_name','session','month','week','created_by_name']
    ],

    // Cron List
    "cronList-visitplanner" => [
        'visitplanner-scheduledvisits' => 'Scheduled Visits'
    ],

    // Mandatory Fields
    "mandatoryFields-visitplanner_entry" => [
        'visit_company','visit_meetingwith','visit_mobile_number','visit_email','session','month','week'
    ],

    // Date Fields
    "dateFields-visitplanner_entry" => ['date','visit_date'],

    // Additional Fields
    "additionalFields-visitplanner_entry" => [],

    // JSON Fields
    "jsonFields-visitplanner_entry" => ['visit_team_member_json','visit_product'],

    // List Filters
    "listFilters-visitplanner_entry" => [
        "admin" => [
            'visitplanner_session_filter'   => "Session/session/session-json",
            'visitplanner_employee_filter'  => "Employee/visit_by_id/employee_id-json",
            'visitplanner_month_filter'     => "Month/month/month-json",
            'visitplanner_week_filter'      => "Week/week/visitplanner_week-json",
            'visitplanner_status_filter'    => "Status/status/status-json"
        ],
        "portal" => [
            'visitplanner_session_filter'   => "Session/session/session-json",
            'visitplanner_employee_filter'  => "Employee/visit_by_id/employee_id-json",
            'visitplanner_month_filter'     => "Month/month/month-json",
            'visitplanner_week_filter'      => "Week/week/visitplanner_week-json",
            'visitplanner_status_filter'    => "Status/status/status-json"
        ]
    ],

    // Admin Permissions
    "permissionAdmin-visitplanner" => [
        'restricted' => [
            '2' => [['pg'=>$pg,'sub_pg'=>'settings']],
            '3' => [['pg'=>$pg,'sub_pg'=>'settings']]
        ],
        'allowed' => []
    ],

    // Portal Permissions
    "permissionPortal-visitplanner" => [
        'restricted' => [],
        'allowed' => [
            ['pg'=>$pg,'sub_pg'=>'home'],
            ['pg'=>$pg,'sub_pg'=>'entry'],
            ['pg'=>$pg,'sub_pg'=>'list'],
            ['pg'=>$pg,'sub_pg'=>'detail'],
            ['pg'=>$pg,'sub_pg'=>'upload'],
            ['pg'=>$pg,'sub_pg'=>'report'],
            ['pg'=>$pg,'sub_pg'=>"{$pg}-report"]
        ]
    ],

    // Allowed Filters for Portal
    /*"permissionAllowedFiltersPortal-visitplanner" => [
        "entry"  => [["visit_by_type"=>'{$login_type}',"visit_by_id"=>'{$login_id}']],
        "list"   => [["visit_by_type"=>'{$login_type}',"visit_by_id"=>'{$login_id}']],
        "report" => [["visit_by_type"=>'{$login_type}',"visit_by_id"=>'{$login_id}']]
    ],*/

    // Form Prefills
    "formPrefills-visitplanner_entry" => [
        "columns" => [
            'product'        => 'default_product',
            'contact_mode'   => 'default_contact_mode',
            'state'          => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

    // Visitplanner Status
    "visitplanner_status-json" => [
        "1"  => "Active",
        "11" => "Postponed",
        "2"  => "Deleted",
        "21" => "Cancelled"
    ],

    // Visitplanner Expectation
    "visitplanner_expectation-json" => [
        "high"    => "High",
        "average" => "Average",
        "low"     => "Low"
    ],

    // Visitplanner Generation Status
    "visitplanner_visitactivity_generation_status-json" => [
        'all' => "All",
        '1'   => "VAR Generated",
        '2'   => "Pending VAR"
    ],

    // Visitplanner Category
    "visitplanner_category-json" => [
        'sales'   => 'sales',
        'service' => 'service'
    ],

    // Visitplanner Week Names
    "visitplanner_week_name-json" => ["week-1","week-2","week-3","week-4","week-5"],

    // Sort Options
    "sort_visitplanner_results_by-list" => [
        'datetime'         => "Date & Time",
        'expectedexpense'  => "Expected Expense"
    ],

    // Bulk Operations
    "visitplanner_bulk_operation-list" => [
        "view:detail"  => "View Visit Planner Details",
        "send:email"   => "Send Email",
        "send:sms"     => "Send SMS",
        "op:remove"    => "Delete",
        "op:restore"   => "Restore"
    ],

];

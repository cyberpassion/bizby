<?php

$pg = 'visitactivity';

return [

    // Communication Templates
    "communicationTemplate-visitactivity" => [
        "visitactivity_entry_new_sms"       => "New Visitactivity Entry SMS",
        "visitactivity_entry_new_whatsapp" => "New Visitactivity Entry Whatsapp",
        "visitactivity_entry_new_email"    => "New Visitactivity Entry Email",
    ],

    // Column Name Mapping
    "columnNameMapping-visitactivity" => [
        'ptr'                           => 'SNo',
        'visit_date'                    => 'Date',
        'visitactivity_id'              => 'ID',
        'visit_by_name'                 => 'Name',
        'visit_team_member_json'        => 'Team Members',
        'company_name'                  => 'Company',
        'company_address'               => 'Address',
        'company_city'                  => 'City',
        'company_state'                 => 'State',
        'company_official_name'         => 'Person Name',
        'company_official_mobile_number'=> 'Mobile',
        'detailed_report'               => 'Report',
        'next_action_plan'              => 'Next Plan',
        'visit_status'                  => 'V/Status',
        'options'                       => 'Options'
    ],

    // Menu Items
    "menuItem-visitactivity" => [
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
                    'My Visits'   => \Route::to_list($pg),
                    'Visit Report'=> get_link($pg . '/report'),
                ]
            ]
        ]
    ],

    // Page Structure
    "pgStructure-visitactivity" => [
        $pg => [
            'forms/form' => ['entry', 'settings', 'report', 'upload'],
            'lists/list' => ['list'],
            'views/view' => array_merge(array_keys(\v3\M\Res::get("{$pg}_document-json") ?: []), ['home', 'document', 'profile', 'detail', 'history'])
        ]
    ],

    // Mandatory Options Before Using Module
    "mandatoryOptionsBeforeUsing-visitactivity" => [
        'missing_option' => [
            'Email IDs to send VAR Email (Mandatorily)' => 'visitactivity_default_email_recipient',
        ]
    ],

    // Module Tables
    "moduleTable-visitactivity" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_visitactivity"
    ],

    // Default Columns
    "defaultColumns-visitactivity" => [
        'entry'            => ['visitactivity_id','visit_date','visit_by_name','visit_team_member_json','company_name','company_official_mobile_number','detailed_report','next_action_plan','visit_status','tags','status'],
        'list'             => ['visitactivity_id','visit_date','visit_by_name','visit_team_member_json','company_name','company_official_mobile_number','detailed_report','next_action_plan','visit_status','tags','status'],
        'detail'           => ['visitactivity_id','visit_date','visit_by_name','visit_team_member_json','company_name','company_official_mobile_number','detailed_report','next_action_plan','visit_status','tags','status'],
        'report'           => ['visitactivity_id','visit_date','visit_by_name','visit_team_member_json','company_name','company_official_mobile_number','detailed_report','next_action_plan','visit_status','tags','status'],
        'sample_export'    => ['sno','visit_date','visit_by_name','visit_team_member_json','company_name','company_official_mobile_number','detailed_report','next_action_plan','visit_status'],
        'selected_columns' => ['visit_date','visit_by_name','visit_team_member_json','company_name','company_official_mobile_number','detailed_report','next_action_plan','visit_status']
    ],

    // Mandatory Fields
    "mandatoryFields-visitactivity_entry" => [
        'movement_from',
        'company_official_mobile_number',
        'company_address'
    ],

    // Date Fields
    "dateFields-visitactivity_entry" => ['visit_date','next_visit_date'],

    // Additional Fields
    "additionalFields-visitactivity_entry" => [],

    // JSON Fields
    "jsonFields-visitactivity_entry" => [
        'visit_team_member_json',
        'detailed_report',
        'next_action_plan',
        'visit_product',
        'products_discussed',
        'email_to',
        'competitors'
    ],

    // List Filters
    "listFilters-visitactivity_entry" => [
        "admin"  => [
            'visitactivity_visitby_filter' => "Visit By/visit_by_id/employee_id-json",
            'visitactivity_date_filter'    => "Date/visit_date/visitactivity_date-json",
            'visitactivity_status_filter'  => "Status/status/visitactivity_status-json"
        ],
        "portal" => [
            'visitactivity_visitby_filter' => "Visit By/visit_by_id/employee_id-json",
            'visitactivity_date_filter'    => "Date/visit_date/visitactivity_date-json",
            'visitactivity_status_filter'  => "Status/status/visitactivity_status-json"
        ]
    ],

    // Admin Permissions
    "permissionAdmin-visitactivity" => [
        'restricted'=> [
            '2'=>[['pg'=>$pg,'sub_pg'=>'settings']],
            '3'=>[['pg'=>$pg,'sub_pg'=>'settings']]
        ],
        'allowed'=> []
    ],

    // Portal Permissions
    "permissionPortal-visitactivity" => [
        'restricted'=> [],
        'allowed'=> [
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
    "permissionAllowedFiltersPortal-visitactivity" => [
        "entry"  => [["visit_by_type"=>'{$login_type}',"visit_by_id"=>'{$login_id}']],
        "list"   => [["visit_by_type"=>'{$login_type}',"visit_by_id"=>'{$login_id}']],
        "report" => [["visit_by_type"=>'{$login_type}',"visit_by_id"=>'{$login_id}']]
    ],

    // Visit Status
    "visitactivity_status-json" => [
        1  => 'Submitted',
        11 => 'Autosaved',
        2  => 'Deleted'
    ],

    // Visit Activity Bulk Operation
    "visitactivity_bulk_operation-list" => [
        "view:detail" => "View Visit Activity Details",
        "send:email"  => "Send Notification Email",
        "op:remove"   => "Delete",
        "op:restore"  => "Restore"
    ],

    // Visit Activity Customer Type
    "visitactivity_customer_type-json" => [
        "new-customer"          => "New Customer",
        "old-customer"          => "Old Customer",
        "dissatisfied-customer" => "Dissatisfied Customer",
        "biased-customer"       => "Biased Customer"
    ],

    // Visit Activity Status Options
    "visitactivity_visit_status-json" => [
        '0'  => 'Select',
        '1'  => 'Visit Done',
        '2'  => 'Cancelled',
        '11' => 'Postponed by Client',
        '12' => 'Postponed by Office'
    ],

    // Visit Duration Days
    "visit_duration_days-list" => [
        0 => '0 d',
        1 => '1 d',
        2 => '2 d',
        3 => '3 d',
        4 => '4 d',
        5 => '5 d',
        6 => '6 d',
        7 => '7 d'
    ],

    // Sort Options
    "sort_visitactivity_results_by-list" => [
        'datetime'      => "Date & Time",
        'total_expense' => "Total Expense"
    ],

];

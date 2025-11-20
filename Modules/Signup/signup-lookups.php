<?php
$pg = 'signup';

return [

    // -------------------------------
    // Communication Templates
    // -------------------------------
    "communicationTemplate-signup" => [
        "signup_entry_new_sms"       => "New Signup Entry SMS",
        "signup_entry_new_whatsapp" => "New Signup Entry Whatsapp",
        "signup_entry_new_email"    => "New Signup Entry Email",
    ],

    // -------------------------------
    // Column Name Mapping
    // -------------------------------
    "columnNameMapping-signup" => [
        'ptr'            => 'SNo',
        'date'           => 'Date',
        'signup_id'      => 'ID',
        'signup_label'   => 'Form',
        'signup_info'    => 'Info',
        'phone_number'   => 'Phone',
        'payment_status' => 'Payment',
        'entry_source'   => 'Source',
        'form_id'        => 'ID',
        'form_name'      => 'Name',
        'form_fee'       => 'Fee',
        'form_detail'    => 'Detail'
    ],

    // -------------------------------
    // Menu
    // -------------------------------
    "menuItem-signup" => [
        "admin" => [
            'parent' => [
                'Signups' => [\Route::to_home($pg), \v4\C\UI::sidebarmenu_list($pg)]
            ],
            'child' => [
                'signups' => [
                    'Configure'        => \Route::to_entry($pg . '/config-entry/new'),
                    'Forms List'       => \Route::to_list($pg . '/forms-list'),
                    'Submission List'  => \Route::to_list($pg),
                    'Submission Report'=> \Route::to_report($pg),
                    'Settings'         => \Route::to_settings($pg)
                ]
            ]
        ],
        "portal" => \v3\C\Module::default_features_menu_list(['name' => $pg, 'label' => do_ucf($pg)], 'portal'),
    ],

    // -------------------------------
    // Page Structure
    // -------------------------------
    "pgStructure-signup" => [
        $pg => [
            'forms/form'  => ['entry','config-entry','settings','report'],
            'lists/list'  => ['list'],
            'views/view'  => array_merge(array_keys(\v3\M\Res::get("signup_document-json") ?: []), ['home','document','profile','detail','history'])
        ]
    ],

    // -------------------------------
    // Mandatory Options
    // -------------------------------
    "mandatoryOptionsBeforeUsing-signup" => [
        'missing_option' => []
    ],

    // -------------------------------
    // Module Tables
    // -------------------------------
    "moduleTable-signup" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_signup",
        "cyp_signup_config",
        "cyp_notification"
    ],

    // -------------------------------
    // Default Columns
    // -------------------------------
    "defaultColumns-signup" => [
        'entry'           => ['signup_id','name','phone_number','signup_label','signup_info','payment_status','tags','status'],
        'list'            => ['signup_id','name','phone_number','signup_label','signup_info','payment_status','tags','status'],
        'detail'          => ['signup_id','name','phone_number','signup_label','signup_info','payment_status','tags','status'],
        'report'          => ['signup_id','name','phone_number','signup_label','signup_info','payment_status','tags','status'],
        'sample_export'   => ['sno','name','phone_number','signup_label','signup_info','payment_status'],
        'selected_columns'=> ['name','phone_number','signup_label','signup_info','payment_status']
    ],

    // -------------------------------
    // Mandatory Fields
    // -------------------------------
    "mandatoryFields-signup_entry" => [
        'module','signup_official_name','signup_official_address','signup_official_email','signup_official_phone','send_notification_message'
    ],

    // -------------------------------
    // Date Fields
    // -------------------------------
    "dateFields-signup_entry" => [],

    // -------------------------------
    // Additional Fields
    // -------------------------------
    "additionalFields-signup_entry" => [],

    // -------------------------------
    // Signup Bulk Operation
    // -------------------------------
    "signup_bulk_operation-list" => [
        "view:detail" => "View Detail",
        "op:remove"   => "Delete",
        "op:restore"  => "Restore"
    ],

    // -------------------------------
    // Signup Payment Status
    // -------------------------------
    "signup_payment_status-json" => [
        'paid'    => 'Paid',
        'pending' => 'Pending'
    ],

    // -------------------------------
    // Signup Config Status
    // -------------------------------
    "signup_config_status-json" => [
        1 => 'ACTIVE',
        2 => 'DISABLED'
    ],

    // -------------------------------
    // Signup Document
    // -------------------------------
    "signup_document-json" => [
        'entry_form'   => 'Entry Form',
        'report_form'  => 'Report Form',
        'invoice'      => 'Invoice',
        'brochure'     => 'Brochure'
    ],

    // -------------------------------
    // Signup Labels
    // -------------------------------
    "signup_label-json" => [
        'general' => 'General',
        'vip'     => 'VIP',
        'staff'   => 'Staff'
    ],

    // -------------------------------
    // Signup Dates (example static)
    // -------------------------------
    "signup_date-json" => [
        '2025-01-01' => '01 Jan 2025',
        '2025-02-01' => '01 Feb 2025',
        '2025-03-01' => '01 Mar 2025'
    ],

];

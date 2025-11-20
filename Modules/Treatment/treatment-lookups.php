<?php

$pg = 'treatment';

return [

    // Communication Templates
    "communicationTemplate-treatment" => [
        "treatment_entry_new_sms"       => "New Treatment Entry SMS",
        "treatment_entry_new_whatsapp" => "New Treatment Entry Whatsapp",
        "treatment_entry_new_email"    => "New Treatment Entry Email",
    ],

    // Column Name Mapping
    "columnNameMapping-treatment" => [
        'treatment_id'         => 'ID',
        'treatment_group_id'   => 'GID',
        'patient_name'         => 'Name',
        'treatment_with'       => 'Doctor',
        'treatment_date'       => 'Date',
        'permanent_address'    => 'Address',
        'treatment_fee'        => 'Fee',
        'day_token_id'         => 'Token No',
        'treatment_time'       => 'Time',
        'treatment_through'    => 'Mode',
        'next_date'            => 'Next Visit',
        'age'                  => 'Age',
        'treatment_given'      => 'Treatment',
        'treatment_remark'     => 'Remark'
    ],

    // Menu Items
    "menuItem-treatment" => [
        "admin"  => \v3\C\Module::default_features_menu_list(['name' => $pg, 'label' => do_ucf($pg)]),
        "portal" => []
    ],

    // Page Structure
    "pgStructure-treatment" => [
        $pg => [
            'forms/form' => ['entry', 'settings', 'report', 'upload'],
            'lists/list' => ['list'],
            'views/view' => array_merge(array_keys(\v3\M\Res::get("{$pg}_document-json")), ['home','document','profile','detail','history'])
        ]
    ],

    // Module Tables
    "moduleTable-treatment" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_patient",
        "cyp_treatment"
    ],

    // Default Columns
    "defaultColumns-treatment" => [
        'entry'            => ['treatment_id','treatment_date','treatment_time','person','observedby','observation','treatment_given','treatment_remark','tags','status'],
        'list'             => ['treatment_id','treatment_date','treatment_time','person','observedby','observation','treatment_given','treatment_remark','tags','status'],
        'detail'           => ['treatment_id','treatment_date','treatment_time','person','observedby','observation','treatment_given','treatment_remark','tags','status'],
        'report'           => ['treatment_id','treatment_date','treatment_time','person','observedby','observation','treatment_given','treatment_remark','tags','status'],
        'sample_export'    => ['sno','treatment_date','treatment_time','observedby','observation','treatment_given','treatment_remark'],
        'selected_columns' => ['treatment_date','treatment_time','observedby','observation','treatment_given','treatment_remark']
    ],

    // Mandatory Fields
    "mandatoryFields-treatment_entry" => [],

    // Date Fields
    "dateFields-treatment_entry" => ['treatment_date'],

    // Additional Fields
    "additionalFields-treatment_entry" => [],

    // List Filters
    "listFilters-treatment_entry" => [
        "admin" => [
            'treatment_date_filter'        => "Date/treatment_date/treatment_entry_date-json",
            'treatment_nextdate_filter'    => "Next Date/next_date/treatment_next_entry_date-json",
            'treatment_with_filter one'    => "Doctor/treatment_with/employee_id-json",
            'treatment_through_filter one' => "Mode/treatment_through/treatment_through_mode-json",
            'treatment_status_filter'      => "Status/status/treatment_status-json"
        ],
        "portal" => [
            'treatment_date_filter'        => "Date/treatment_date/treatment_entry_date-json",
            'treatment_nextdate_filter'    => "Next Date/next_date/treatment_next_entry_date-json",
            'treatment_with_filter one'    => "Doctor/treatment_with/employee_id-json",
            'treatment_through_filter one' => "Mode/treatment_through/treatment_through_mode-json",
            'treatment_status_filter'      => "Status/status/treatment_status-json"
        ]
    ],

    // List Actions
    "listFilters-treatment_entry_update" => [
        'admin' => [
            $pg => [
                'Edit'          => "{$pg}/entry/update",
                'Upload'        => "{$pg}/upload",
                'View Details'  => "{$pg}/detail",
                'View History'  => "{$pg}/history",
                'Download Docs' => \Route::get_endpoint_zip_download($pg),
            ]
        ]
    ],

    // Admin Permissions
    "permissionAdmin-treatment" => [
        'restricted' => [
            '2' => [['pg' => $pg, 'sub_pg' => 'settings']],
            '3' => [['pg' => $pg, 'sub_pg' => 'settings']]
        ],
        'allowed' => []
    ],

    // Portal Permissions
    "permissionPortal-treatment" => [
        'restricted' => [],
        'allowed' => [
            ['pg' => $pg, 'sub_pg' => 'home'],
            ['pg' => $pg, 'sub_pg' => 'list']
        ]
    ],

    // Allowed Filters for Portal
    "permissionAllowedFiltersPortal-treatment" => [
        "entry"  => [['patient_id' => '{$login_id}']],
        "list"   => [['patient_id' => '{$login_id}']],
        "report" => [['patient_id' => '{$login_id}']]
    ],

    // Form Prefills
    "formPrefills-treatment_entry" => [
        "columns" => [
            'product'      => 'default_product',
            'contact_mode' => 'default_contact_mode',
            'state'        => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

    // Treatment Recipients
    "treatment_recipient-json" => \v3\C\Module::get_recipients(true),

    // Treatment Status
    "treatment_status-json" => [
        '1'  => 'Active',
        '2'  => 'Deleted',
        '21' => 'Departed'
    ],

    // Treatment Type
    "treatment_type-json" => ["consultation","test","room-allotment"],

    // Treatment Report Type
    "treatment_report_type-json" => [
        "stock"     => "All Treatment List",
        "treatment" => "Patient Treatment"
    ],

    // Treatment Bulk Operation
    "treatment_bulk_operation-list" => [
        "document:treatment_detail" => "Print Treatment Details",
        "send:sms"                  => "Send Treatment SMS",
        "send:email"                => "Send Treatment Email",
        "op:remove"                 => "Delete Treatment Entry",
        "op:restore"                => "Restore Treatment Entry"
    ],

    // Treatment Unit
    "treatment_unit-json" => [
        "unit" => "Sample"
    ]

];

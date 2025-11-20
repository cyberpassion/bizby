<?php

$pg = 'vendor';

return [

    // Communication Templates
    "communicationTemplate-vendor" => [
        "vendor_entry_new_sms"       => "New Vendor Entry SMS",
        "vendor_entry_new_whatsapp" => "New Vendor Entry Whatsapp",
        "vendor_entry_new_email"    => "New Vendor Entry Email",
    ],

    // Column Name Mapping
    "columnNameMapping-vendor" => [
        'ptr'                     => 'SNo',
        'date'                    => 'Date',
        'vendor_id'               => 'ID',
        'vendor_code'             => 'V/Code',
        'vendor_official_name'    => 'Name',
        'vendor_official_phone'   => 'Phone',
        'vendor_official_email'   => 'Email',
        'vendor_official_address' => 'Address',
        'vendor_person'           => 'Person',
        'vendor_person_phone'     => 'P/Phone',
        'vendor_person_email'     => 'P/Email',
        'code_attaches'           => 'C/Attaches',
        'expected_income'         => 'Exp Income'
    ],

    // Menu Items
    "menuItem-vendor" => [
        "admin"  => \v3\C\Module::default_features_menu_list(['name' => $pg, 'label' => do_ucf($pg)]),
        "portal" => [
            'parent' => [
                do_ucf($pg) => [
                    \Route::to_home($pg),
                    \v4\C\UI::sidebarmenu_list($pg)
                ]
            ],
            'child' => [
                $pg => [
                    'Add Subvendor'      => get_link("{$pg}/entry"),
                    'Subvendors List'    => get_link("{$pg}/subven-list"),
                    'My Info'            => get_link("{$pg}/list"),
                    'Report'             => get_link("{$pg}/report")
                ]
            ]
        ]
    ],

    // Page Structure
    "pgStructure-vendor" => [
        $pg => [
            'forms/form' => ['entry','report','upload','settings'],
            'lists/list' => ['list','subvendor-list','activity-list'],
            'views/view' => array_merge(array_keys(\v3\M\Res::get("{$pg}_document-json")), ['home','document','profile','detail','activity-detail','code-attaches'])
        ]
    ],

    // Module Tables
    "moduleTable-vendor" => [
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_vendor"
    ],

    // Default Columns
    "defaultColumns-vendor" => [
        'entry'           => ['vendor_id','vendor_official_name','vendor_code','vendor_person','vendor_person_phone','code_attaches','expected_income','tags','status'],
        'list'            => ['vendor_id','vendor_official_name','vendor_code','vendor_person','vendor_person_phone','code_attaches','expected_income','tags','status'],
        'detail'          => ['vendor_id','vendor_official_name','vendor_code','vendor_person','vendor_person_phone','code_attaches','expected_income','tags','status'],
        'report'          => ['vendor_id','vendor_official_name','vendor_person','vendor_person_phone','code_attaches','expected_income','tags','status'],
        'sample_export'   => ['sno','vendor_official_name','vendor_official_address','vendor_official_email','vendor_official_phone','vendor_terms_and_condition','vendor_person','vendor_person_designation','vendor_person_email','vendor_person_phone'],
        'selected_columns'=> ['vendor_official_name','vendor_person','vendor_person_phone']
    ],

    // Mandatory Fields
    "mandatoryFields-vendor_entry" => [
        'vendor_official_name',
        'vendor_official_address',
        'vendor_official_email',
        'vendor_official_phone',
        'vendor_terms_and_condition',
        'vendor_person',
        'vendor_person_designation',
        'vendor_person_email',
        'vendor_person_phone'
    ],

    // Date Fields
    "dateFields-vendor_entry" => [],

    // Additional Fields
    "additionalFields-vendor_entry" => [],

    // JSON Fields
    "jsonFields-vendor_entry" => ['region'],

    // Vendor Status
    "vendor_status-json" => [
        "1"  => "Active",
        "11" => "Awaiting Approval",
        "2"  => "Inactive"
    ],

    // Vendor Documents
    "vendor_document-json" => [
        'performance'    => 'Performance',
        'agreement'      => 'Agreement',
        'certificate'    => 'Certificate',
        'vendor-id-card' => 'ID Card'
    ],

    // Vendor Bulk Operation
    "vendor_bulk_operation-list" => [
        "document:performance"    => 'Performance',
        "document:agreement"      => 'Agreement',
        "document:certificate"    => 'Certificate',
        "document:vendor-id-card" => 'ID Card',
        "view:detail"             => "View Detail",
        "op:remove"               => "Delete",
        "op:restore"              => "Restore"
    ],

    // Vendor Level
    "vendor_level-json" => ["Silver","Gold","Platinum"],

    // Interactive Entity
    "interactiveEntity-vendor" => ['vendor'],

    // Portal Permissions
    "permissionPortal-vendor" => [
        'restricted' => [],
        'allowed'    => [
            ['pg'=>$pg,'sub_pg'=>'home'],
            ['pg'=>$pg,'sub_pg'=>'list'],
            ['pg'=>$pg,'sub_pg'=>'subvendor-list'],
            ['pg'=>$pg,'sub_pg'=>'detail'],
            ['pg'=>$pg,'sub_pg'=>'report'],
        ]
    ],

    // Admin Permissions
    "permissionAdmin-vendor" => [
        'restricted' => [
            '2' => [['pg'=>$pg,'sub_pg'=>'settings']],
            '3' => [['pg'=>$pg,'sub_pg'=>'settings']]
        ],
        'allowed' => []
    ],

    // Allowed Filters for Portal
    "permissionAllowedFiltersPortal-vendor" => [
        "profile"         => [['vendor_id'=>'{$login_id}']],
        "list"            => [['vendor_id'=>'{$login_id}']],
        "subvendor-list"  => [['vendor_id'=>'{$login_id}']],
        "report"          => [['vendor_id'=>'{$login_id}']]
    ],

    // List Filters
    "listFilters-vendor_entry" => [
        "admin"  => ['vendor_status_filter one'=>"Status/status/vendor_status-json"],
        "portal" => ['vendor_status_filter one'=>"Status/status/vendor_status-json"]
    ],

];

<?php   
$pg = 'registration';

return [

    // -------------------------------
    // Communication Templates
    // -------------------------------
    "communicationTemplate-registration" => [
        "registration_entry_new_sms"       => "New Registration Entry SMS",
        "registration_entry_new_whatsapp" => "New Registration Entry Whatsapp",
        "registration_entry_new_email"    => "New Registration Entry Email",
    ],

    // -------------------------------
    // Column Name Mapping
    // -------------------------------
    "columnNameMapping-registration" => [
        'registration_id'        => 'ID',
        'payment_mode'           => 'Mode',
        'registration_type'      => 'Type',
        'payment_transaction_id' => 'Transaction ID'
    ],

    // -------------------------------
    // Menu
    // -------------------------------
    "menuItem-registration" => [
        "admin" => \v3\C\Module::default_features_menu_list(['name' => $pg, 'label' => do_ucf($pg)]),
        "portal" => [
            'parent' => [
                do_ucf($pg) => ['registration/home', 'registration/menu_list']
            ],
            'child' => [
                $pg => [
                    'Edit Profile'     => 'registration/entry?op=update',
                    'Upload Documents' => 'registration/upload'
                ]
            ]
        ]
    ],

    // -------------------------------
    // Page Structure
    // -------------------------------
    "pgStructure-registration" => [
        $pg => [
            'forms/form' => ['entry', 'public-mini-entry', 'public-entry', 'upload', 'settings', 'report'],
            'lists/list' => ['list'],
            'views/view' => ['home','document','profile','detail','registration-slip','history']
        ]
    ],

    // -------------------------------
    // Mandatory Options
    // -------------------------------
    "mandatoryOptionsBeforeUsing-registration" => [
        'missing_option' => [
            'Registration Type' => 'registration_type-json'
        ]
    ],

    // -------------------------------
    // JSON Options
    // -------------------------------
    "jsonOption-registration" => [
        'registration_type-json' => 'Registration Type'
    ],

    // -------------------------------
    // Module Tables
    // -------------------------------
    "moduleTable-registration" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_registration"
    ],

    // -------------------------------
    // Default Columns
    // -------------------------------
    "defaultColumns-registration" => [
        'entry'           => ['date', 'name', 'phone_number', 'email_id', 'permanent_address', 'registration_type','tags', 'status'],
        'list'            => ['date', 'name', 'phone_number', 'email_id', 'permanent_address', 'registration_type','tags', 'status'],
        'detail'          => ['date', 'name', 'phone_number', 'email_id', 'permanent_address', 'registration_type','tags', 'status'],
        'report'          => ['date', 'name', 'phone_number', 'email_id', 'permanent_address', 'registration_type','tags', 'status'],
        'sample_export'   => ['sno', 'date', 'name', 'phone_number', 'email_id', 'permanent_address'],
        'selected_columns'=> ['date', 'name', 'phone_number', 'email_id', 'permanent_address', 'registration_type']
    ],

    // -------------------------------
    // Interactive Entity
    // -------------------------------
    "interactiveEntity-registration" => ['registration'],

    // -------------------------------
    // Cron List
    // -------------------------------
    "cronList-registration" => [
        'registration-notification' => 'Registration Notification'
    ],

    // -------------------------------
    // Mandatory Fields
    // -------------------------------
    "mandatoryFields-registration_entry" => ['name','phone_number'],

    // -------------------------------
    // Date Fields
    // -------------------------------
    "dateFields-registration_entry" => ['date','dob'],

    // -------------------------------
    // Additional Fields
    // -------------------------------
    "additionalFields-registration_entry" => [],

    // -------------------------------
    // List Filters
    // -------------------------------
    "listFilters-registration_entry" => [
        "admin" => [
            'date_filter'               => "Date/date/registration_date-json",
            'registration_type_filter'  => "Type/type/registration_type-json",
            'registration_status_filter'=> "Status/status/status-json"
        ],
        "portal" => [
            'date_filter'               => "Date/date/registration_date-json",
            'registration_type_filter'  => "Type/type/registration_type-json",
            'registration_status_filter'=> "Status/status/status-json"
        ]
    ],

    "listFilters-registration_entry_update" => [
        'admin' => [
            $pg => [
                'Profile'        => "registration/profile",
                'Edit'           => "registration/entry/update",
                'Print'          => "registration/document",
                'Upload'         => "registration/upload",
                'View Details'   => "registration/detail",
                'Generate PDF'   => "registration/registration-slip/pdf",
                'Download Docs'  => "registration/download-zip",
                'Move To'        => [
                    "endpoint" => "module",
                    "params"   => [
                        "key"           => "form:registration/processbehaviourentry/new",
                        "heading"       => "Move Registration To",
                        "selected-ids"  => "registration_id"
                    ]
                ]
            ]
        ],
        "portal" => []
    ],

    // -------------------------------
    // Locked Fields
    // -------------------------------
    "lockedFields-registration_entry_update" => [],

    // -------------------------------
    // Permissions
    // -------------------------------
    "permissionAdmin-registration" => [
        'restricted' => [
            '2' => [['pg' => $pg, 'sub_pg' => 'settings']],
            '3' => [['pg' => $pg, 'sub_pg' => 'settings']]
        ],
        'allowed' => []
    ],

    "permissionRestrictedAdmin-registration" => [
        ['pg' => $pg, 'sub_pg' => 'settings']
    ],

    "permissionPortal-registration" => [
        'restricted' => [],
        'allowed' => [
            ['pg' => $pg,'sub_pg'=>'home'],
            ['pg' => $pg,'sub_pg'=>'profile'],
            ['pg' => $pg,'sub_pg'=>'list'],
            ['pg' => $pg,'sub_pg'=>'detail'],
            ['pg' => $pg,'sub_pg'=>'document'],
            ['pg' => $pg,'sub_pg'=>'history'],
            ['pg' => $pg,'sub_pg'=>'upload'],
            ['pg' => $pg,'sub_pg'=>'report'],
            ['pg' => $pg,'sub_pg'=>"{$pg}-report"]
        ]
    ],

    "permissionRestrictedPortal-registration" => [],

    // "permissionAllowedFiltersPortal-registration" => [
    //     "profile"=> [[ "phone_number" => '{$phone_number}' ]],
    //     "list"   => [[ "phone_number" => '{$phone_number}' ]],
    //     "report" => [[ "phone_number" => '{$phone_number}' ]]
    // ],

    // -------------------------------
    // Form Prefills
    // -------------------------------
    "formPrefills-registration_entry" => [
        "columns" => [
            'product'       => 'default_product',
            'contact_mode'  => 'default_contact_mode',
            'state'         => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

    // -------------------------------
    // Registration Document
    // -------------------------------
    "registration_document-json" => [
        'registration-slip' => 'Registration Slip',
        'registration-form' => 'Registration Form'
    ],

    // -------------------------------
    // Public Registration Status
    // -------------------------------
    "public_registration_status-json" => [
        "1"  => "ACTIVE",
        "11" => "PENDING APPROVAL"
    ],

    // -------------------------------
    // Registration Bulk Operation
    // -------------------------------
    "registration_bulk_operation-list" => [
        "registration:detail" => "Move to",
        "view:detail"         => "View Detail",
        "op:remove"           => "Delete",
        "op:restore"          => "Restore"
    ],

    // -------------------------------
    // Public Registration Flow
    // -------------------------------
    "public_registration_flow-json" => [
        "default" => "Default"
    ]

];

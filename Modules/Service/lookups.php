<?php
$pg = 'service';

return [

    // -------------------------------
    // Communication Templates
    // -------------------------------
    "communicationTemplate-service" => [
        "service_entry_new_sms"       => "New Service Entry SMS",
        "service_entry_new_whatsapp" => "New Service Entry Whatsapp",
        "service_entry_new_email"    => "New Service Entry Email",
    ],

    // -------------------------------
    // Column Name Mapping
    // -------------------------------
    "columnNameMapping-service" => [
        'service_id'   => 'ID',
        'service_name' => 'Name',
        'service_type' => 'Type',
        'provided_by'  => 'By'
    ],

    // -------------------------------
    // Column Names for User
    // -------------------------------
    "columnNames-service" => [
        'unit_price' => 'price',
        'size'       => 'service_size',
        'unit'       => 'service_size_unit'
    ],

    // -------------------------------
    // Menu
    // -------------------------------
    "menuItem-service" => [
        "admin" => [
            'parent' => [
                'Service' => [\Route::to_home($pg), \v4\C\UI::sidebarmenu_list($pg)]
            ],
            'child' => [
                'service' => [
                    'Add New'  => \Route::to_entry($pg . '/request-entry/new'),
                    'Report'   => \Route::to_report($pg . '/request-report'),
                    'Settings' => \Route::to_settings($pg),
                    'Listing'  => \Route::to_entry($pg . '/listing-entry/new'),
                ]
            ],
            'child-2' => [
                "{$pg}-listing" => [
                    'Add New' => \Route::to_entry($pg . '/listing-entry/new'),
                    'List'    => \Route::to_list($pg),
                    'Report'  => \Route::to_report($pg . '/listing-report'),
                ]
            ]
        ],
        "portal" => \v3\C\Module::default_features_menu_list(['name' => $pg, 'label' => do_ucf($pg)], 'portal')
    ],

    // -------------------------------
    // Page Structure
    // -------------------------------
    "pgStructure-service" => [
        $pg => [
            'forms/form' => ['listing-entry', 'request-entry', 'listing-report', 'upload', 'settings'],
            'lists/list' => ['list'],
            'views/view' => array_merge(array_keys(\v3\M\Res::get("service_document-json")), ['home', 'document', 'profile', 'detail', 'history'])
        ]
    ],

    // -------------------------------
    // Mandatory Options Before Using Module
    // -------------------------------
    "mandatoryOptionsBeforeUsing-service" => [
        'service-request-entry' => [
            'empty' => [
                [
                    'table'      => get_controller($pg)::db_table('listing-entry'),
                    'params'     => [],
                    'label'      => 'No Service Added',
                    'routeLabel' => 'Set Now',
                    'routes'     => [
                        'php' => get_link("$pg/listing-entry"),
                        'pwa' => "/{$pg}/listing-entry",
                        'app' => "/{$pg}/listing-entry"
                    ]
                ]
            ]
        ],
        'missing_option' => []
    ],

    // -------------------------------
    // Module Tables
    // -------------------------------
    "moduleTable-service" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_saleservice",
        "cyp_service_listing"
    ],

    // -------------------------------
    // Default Columns
    // -------------------------------
    "defaultColumns-service" => [
        'entry'            => ['request_id','date','service_type','provided_by','service_name','requested_by_info','request_size','request_price','request_description'],
        'list'             => ['request_id','date','service_type','provided_by','service_name','requested_by_info','request_size','request_price','request_description'],
        'detail'           => ['request_id','date','service_type','provided_by','service_name','requested_by_info','request_size','request_price','request_description'],
        'report'           => ['request_id','date','service_type','provided_by','service_name','requested_by_info','request_size','request_price','request_description'],
        'sample_export'    => ['sno','date','service_type','provided_by','service_name','requested_by_info','request_size','request_price','request_description'],
        'selected_columns' => ['date','service_type','provided_by','service_name','requested_by_info','request_size','request_price','request_description']
    ],

    // -------------------------------
    // Filters
    // -------------------------------
    "listFilters-service_entry" => [
        "admin"  => [
            'service_price_filter one' => "Price/service_price/service_price-json",
            'service_type_filter one'  => "Type/service_type/service_type-json"
        ],
        "portal" => [
            'service_price_filter one' => "Price/service_price/service_price-json",
            'service_type_filter one'  => "Type/service_type/service_type-json"
        ]
    ],

    // -------------------------------
    // Mandatory Fields
    // -------------------------------
    "mandatoryFields-service_entry" => ['service_name','provided_by','service_name','service_size','price'],

    // -------------------------------
    // Date Fields
    // -------------------------------
    "dateFields-service_entry" => ['date'],

    // -------------------------------
    // Additional Fields
    // -------------------------------
    "additionalFields-service_entry" => [],

    // -------------------------------
    // Duplicacy Check Fields
    // -------------------------------
    "duplicacyCheckFields-service_listing-entry_new"    => ['provided_by','service_name'],
    "duplicacyCheckFields-service_listing-entry_update" => ['provided_by','service_name'],
    "duplicacyCheckFields-service_request_entry"        => ['date','requested_by_type','requested_by','service_id'],
    "duplicacyCheckFields-service_request_new"          => ['date','requested_by_type','requested_by','service_id'],

    // -------------------------------
    // Service Status
    // -------------------------------
    "service_status-json" => [
        "1" => "Requested",
        "2" => "Completed"
    ],

    // -------------------------------
    // Service Document
    // -------------------------------
    "service_document-json" => [
        'request-slip'      => 'Request Slip',
        'request-report'    => 'Final Report',
        'request-invoice'   => 'Invoice',
        'service-brochure'  => 'Service Brochure'
    ],

    // -------------------------------
    // Service Availability Status
    // -------------------------------
    "service_availability_status-json" => [
        'in-stock'    => 'AVAILABLE',
        'out-of-stock'=> 'NOT AVAILABLE'
    ],

    // -------------------------------
    // Service Units
    // -------------------------------
    "service_unit-json" => ['unit','kg','session','day','visit'],

    // -------------------------------
    // Service Bulk Operations
    // -------------------------------
    "service_bulk_operation-list" => [
        "view:detail"           => "View Details",
        "document:request-slip" => "Print Request Slip",
        "document:request-report"=> "Print Request Report",
        "op:remove"             => "Delete",
        "op:restore"            => "Restore"
    ]

];

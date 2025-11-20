<?php
$pg = 'listing';

return [

    // -------------------------------
    // Communication Templates
    // -------------------------------
    "communicationTemplate-listing" => [
        "listing_entry_new_sms"       => "New Listing Entry SMS",
        "listing_entry_new_whatsapp" => "New Listing Entry Whatsapp",
        "listing_entry_new_email"    => "New Listing Entry Email"
    ],

    // -------------------------------
    // Column Name Mapping
    // -------------------------------
    "columnNameMapping-listing" => [
        'ptr'      => 'SNo',
        'added_by' => 'Added By'
    ],

    // -------------------------------
    // Menu
    // -------------------------------
    "menuItem-listing" => [
        "admin"  => [
            'parent' => [
                ucfirst($pg) => [$pg . '/home', $pg . '/list']
            ],
            'child' => [
                $pg => [
                    'Entry'   => $pg . '/entry/new',
                    'List'    => $pg . '/list',
                    'Report'  => $pg . '/report',
                    'Settings'=> $pg . '/settings'
                ]
            ]
        ],
        "portal" => [
            'parent' => [
                ucfirst($pg) => [$pg . '/home', $pg . '/list']
            ],
            'child' => [
                $pg => [
                    'My Listings' => $pg . '/list',
                    'Report'      => $pg . '/report'
                ]
            ]
        ]
    ],

    // -------------------------------
    // Page Structure
    // -------------------------------
    "pgStructure-listing" => [
        $pg => [
            'forms/form' => ['entry','report','settings'],
            'lists/list' => ['list'],
            'views/view' => ['home','document','profile','detail','history']
        ]
    ],

    // -------------------------------
    // Mandatory Options before using module
    // -------------------------------
    "mandatoryOptionsBeforeUsing-listing" => [
        'missing_option' => [
            'Listing Category' => 'listing_category-json'
        ]
    ],

    // -------------------------------
    // Module Tables
    // -------------------------------
    "moduleTable-listing" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_listing"
    ],

    // -------------------------------
    // Default Columns
    // -------------------------------
    "defaultColumns-listing" => [
        'entry'           => ['date','listing_id','listing_name','category','phone_number','email','locality','place','state','info','tags','status'],
        'list'            => ['date','listing_id','listing_name','category','phone_number','email','locality','place','state','info','tags','status'],
        'detail'          => ['date','listing_id','listing_name','category','phone_number','email','locality','place','state','info','tags','status'],
        'report'          => ['date','listing_id','listing_name','category','phone_number','email','locality','place','state','info','tags','status'],
        'sample_export'   => [],
        'selected_columns'=> []
    ],

    // -------------------------------
    // List Filters
    // -------------------------------
    "listFilters-listing_entry" => [
        "admin" => [
            'listing_category_filter' => "Category/category/listing_category-json",
            'listing_status_filter'   => "Status/status/status-json"
        ],
        "portal" => [
            'listing_category_filter' => "Category/category/listing_category-json",
            'listing_status_filter'   => "Status/status/status-json"
        ]
    ],

    // -------------------------------
    // Permission for Admin
    // -------------------------------
    "permissionAdmin-listing" => [
        'restricted' => [
            '2' => [['pg' => $pg, 'sub_pg' => 'settings']],
            '3' => [['pg' => $pg, 'sub_pg' => 'settings']]
        ],
        'allowed' => []
    ],

    // -------------------------------
    // Permission for Portal
    // -------------------------------
    "permissionPortal-listing" => [
        'restricted' => [],
        'allowed' => [
            ['pg' => $pg, 'sub_pg' => 'home'],
            ['pg' => $pg, 'sub_pg' => 'list']
        ]
    ],

    // -------------------------------
    // Allowed Filters for Portal
    // -------------------------------
    "permissionAllowedFiltersPortal-listing" => [
        "entry"  => [['generated_by'=>'employee-{$login_id}','contact_by'=>'employee-{$login_id}']],
        "list"   => [['generated_by'=>'employee-{$login_id}','contact_by'=>'employee-{$login_id}']],
        "report" => [['generated_by'=>'employee-{$login_id}','contact_by'=>'employee-{$login_id}']]
    ],

    // -------------------------------
    // Listing Bulk Operations
    // -------------------------------
    "listing_bulk_operation-list" => [
        "view:detail" => "View Detail",
        "op:remove"   => "Delete",
        "op:restore"  => "Restore"
    ],

    // -------------------------------
    // Listing Status Options
    // -------------------------------
    "listing_status-json" => [
        '1' => 'Active',
        '2' => 'Inactive'
    ],

    // -------------------------------
    // Listing Category, Tag, Info Type
    // -------------------------------
    "listing_category-json"    => [],
    "listing_tag_parent-json"  => [],
    "listing_info_type-json"   => []

];

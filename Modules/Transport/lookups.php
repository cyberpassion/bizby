<?php

$pg = 'transport';

return [

    // Communication Templates
    "communicationTemplate-transport" => [
        "transport_entry_new_sms"       => "New Transport Entry SMS",
        "transport_entry_new_whatsapp" => "New Transport Entry Whatsapp",
        "transport_entry_new_email"    => "New Transport Entry Email",
    ],

    // Column Name Mapping
    "columnNameMapping-transport" => [
        'ptr'                  => 'SNo',
        'route_name'           => 'Name',
        'registration_number'  => 'Reg No',
        'transport_id'         => 'ID',
        'transport_vehicle_id' => 'ID',
        'driver_name'          => 'Driver Name'
    ],

    // Menu Items
    "menuItem-transport" => [
        "admin" => [
            'parent' => [
                'Transport' => ['home', 'sidebarmenu_list_placeholder']
            ],
            'child' => [
                'transport' => [
                    'New Vehicle Entry' => "{$pg}/entry/create",
                    'View List'        => "{$pg}/list",
                    'Stops'            => "{$pg}/vehicle-stoppage-entry/new",
                    'Settings'         => "{$pg}/settings"
                ]
            ]
        ],
        "portal" => []
    ],

    // Page Structure
    "pgStructure-transport" => [
        $pg => [
            'forms/form' => ['entry','vehicle-stoppage-entry','vehicle-reading-entry','vehicle-tracking-entry','vehicle-tracking-report','vehicle-tracking-settings','settings','upload'],
            'lists/list' => ['list'],
            'views/view' => ['home','document','profile','detail','history']
        ]
    ],

    // Mandatory Options
    "mandatoryOptionsBeforeUsing-transport" => [
        'missing_option' => []
    ],

    // Module Tables
    "moduleTable-transport" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_transport_vehicle",
        "cyp_transport_vehicle_reading",
        "cyp_transport_vehicle_stoppage",
        "cyp_transport_vehicle_tracking"
    ],

    // Default Columns
    "defaultColumns-transport" => [
        'entry'            => ['transport_vehicle_id','route_name','registration_number','driver_name','remark','tags','status'],
        'list'             => ['transport_vehicle_id','route_name','registration_number','driver_name','remark','tags','status'],
        'detail'           => ['transport_vehicle_id','route_name','registration_number','driver_name','remark','tags','status'],
        'report'           => ['transport_vehicle_id','route_name','registration_number','driver_name','remark','tags','status'],
        'sample_export'    => ['sno','route_name','registration_number','driver_name','remark'],
        'selected_columns' => ['route_name','registration_number','driver_name','remark']
    ],

    // Mandatory Fields
    "mandatoryFields-transport_vehicle_entry" => ['selected-ids'],

    // Date Fields
    "dateFields-transport_entry" => ['insurance_renewal_date'],

    // Additional Fields
    "additionalFields-transport_entry" => [],

    // List Filters
    "listFilters-transport_entry" => [
        "admin" => [
            'route_filter one'        => 'Route/route_name/transport_route-list',
            'vehicle_type_filter one' => 'Vehicle Type/vehicle_type/transport_vehicle_type-list',
            'status_filter one'       => 'Status/status/status-json'
        ],
        "portal" => [
            'route_filter one'        => 'Route/route_name/transport_route-list',
            'vehicle_type_filter one' => 'Vehicle Type/vehicle_type/transport_vehicle_type-list',
            'status_filter one'       => 'Status/status/status-json'
        ]
    ],

    "listFilters-transport_vehicle-stoppage-entry" => [
        "admin" => [
            'session_filter one' => 'Session/session/session-json',
            'status_filter one'  => 'Status/status/status-json'
        ],
        "portal" => [
            'session_filter one' => 'Session/session/session-json',
            'status_filter one'  => 'Status/status/status-json'
        ]
    ],

    // List Actions
    "listFilters-transport_entry_update" => [
        'admin' => [
            $pg => [
                'Edit'         => "{$pg}/entry/update",
                'Upload'       => "{$pg}/upload",
                'View Details' => "{$pg}/detail",
                'View History' => "{$pg}/history"
            ]
        ]
    ],

    // Admin Permissions
    "permissionAdmin-transport" => [
        'restricted' => [
            '2' => [['pg' => $pg,'sub_pg' => 'settings']],
            '3' => [['pg' => $pg,'sub_pg' => 'settings']]
        ],
        'allowed' => []
    ],

    // Portal Permissions
    "permissionPortal-transport" => [
        'restricted' => [],
        'allowed' => [
            ['pg' => $pg,'sub_pg' => 'home'],
            ['pg' => $pg,'sub_pg' => 'list']
        ]
    ],

    // Allowed Filters for Portal
    "permissionAllowedFiltersPortal-transport" => [
        "entry"  => [[]],
        "list"   => [[]],
        "report" => [[]]
    ],

    // Transport Bulk Operations
    "transport_bulk_operation-list" => [
        "view:detail" => "View Detail",
        "op:remove"   => "Delete",
        "op:restore"  => "Restore"
    ],

    // Vehicle GPS Update Interval
    "transport_vehicle_gps_update_interval-json" => [
        "10"  => "10 seconds",
        "15"  => "15 seconds",
        "30"  => "30 seconds",
        "60"  => "60 seconds",
        "120" => "2 minutes",
        "180" => "3 minutes",
        "300" => "5 minutes"
    ],

    // Tracking Events
    "transport_vehicle_tracking_event-list" => [
        "overspeed" => "Overspeeding",
        "sent-sos"  => "Sent SOS"
    ],

    // Subject Type
    "subject_type-json" => [
        "compulsory" => "Compulsory",
        "optional"   => "Optional"
    ]

];

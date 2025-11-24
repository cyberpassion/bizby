<?php
$pg = 'checklist';

return [

    // Communication Templates
    "communicationTemplate-checklist" => [
        "checklist_entry_new_sms"       => "New Checklist Entry SMS",
        "checklist_entry_new_whatsapp"  => "New Checklist Entry Whatsapp",
        "checklist_entry_new_email"     => "New Checklist Entry Email",
    ],

    // Column Mapping
    "columnNameMapping-checklist" => [
        'ptr'                      => 'SNo',
        'listing_id'               => 'ID',
        'listing_name'             => 'L/Name',
        'listing_type'             => 'Type',
        'listing_description'      => 'Description',
        'listing_points'           => 'Points',
        'listing_points_count'     => 'Points',
        'checklist_id'             => 'ID',
        'checklist_name'           => 'Name',
        'checklist_info'           => 'Information'
    ],

    // Menu Items
    "menuItem-checklist" => [
        "admin" => [
            "parent" => [
                "Checklist" => [
                    "/checklist",
                    "sidebar-list"
                ]
            ],
            "child" => [
                "checklist" => [
                    "Add New"       => "/checklist/entry/new",
                    "View List"     => "/checklist",
                    "Settings"      => "/checklist/settings",
                    "Report"        => "/checklist/report",
                    "Plans"         => "/checklist/listing-entry/new",
                ]
            ],
            "child-2" => [
                "checklist-plans" => [
                    "Create New"    => "/checklist/listing-entry/new",
                    "View Plan List"=> "/checklist/listing-list"
                ]
            ]
        ],
        "portal" => [
            "parent" => [
                "Checklist" => [
                    "/checklist",
                    "sidebar-list"
                ],
            ],
            "child" => [
                "checklist" => [
                    "Add Checklist"      => "/checklist",
                    "My Checklists"      => "/checklist/list",
                    "My Checklist Points"=> "/checklist/listing-point-list"
                ]
            ]
        ]
    ],

    // Page Structure
    "pgStructure-checklist" => [
        "checklist" => [
            "forms/form" => [
                "entry","complete-entry","listing-entry","listing-point-entry",
                "listing-point-sequence-entry","settings","report","upload"
            ],
            "lists/list" => ["list","listing-list","listing-point-list"],
            "views/view" => [
                "home","document","profile",
                "listing-detail","listing-point-detail","detail","history"
            ]
        ]
    ],

    // Module Tables
    "moduleTable-checklist" => [
        "cyp_term","cyp_activity","cyp_advancedinfo","cyp_allotment",
        "cyp_cash","cyp_option","cyp_upload","cyp_notification","cyp_message",
        "cyp_checklist","cyp_checklist_item"
    ],

    // Mandatory Options Before Use
    "mandatoryOptionsBeforeUsing-checklist" => [
        "checklist-entry" => [
            "empty" => [
                [
                    "table" => "checklist_listing",
                    "params" => [],
                    "label" => "No Checklist Plan Added",
                    "routeLabel" => "Set Now",
                    "routes" => [
                        "php" => "/checklist/listing-entry",
                        "pwa" => "/checklist/listing-entry",
                        "app" => "/checklist/listing-entry"
                    ]
                ],
                [
                    "table" => "checklist_listing-point",
                    "params" => [],
                    "label" => "No Service Points Added",
                    "routeLabel" => "Set Now",
                    "routes" => [
                        "php" => "/checklist/listing-list",
                        "pwa" => "/checklist/listing-list",
                        "app" => "/checklist/listing-list"
                    ]
                ]
            ]
        ],
        "missing_option" => []
    ],

    // Default Columns
    "defaultColumns-checklist" => [
        'entry'             => ['checklist_id','checklist_name','listing_name','progress','tags','status'],
        'list'              => ['checklist_id','checklist_name','listing_name','progress','tags','status'],
        'detail'            => ['checklist_id','checklist_name','listing_name','progress','tags','status'],
        'report'            => ['checklist_id','checklist_name','listing_name','progress','tags','status'],
        'sample_export'     => ['sno','checklist_name','checklist_info','remark','status'],
        'selected_columns'  => ['checklist_name','checklist_info','remark'],
        'listing-list'      => ['listing_id','listing_type','listing_name','listing_name','tags','status'],
        'listing-point-list'=> ['point_name','point_assigned_to','point_time_limit','point_description','status']
    ],

    // Mandatory Fields
    "mandatoryFields-checklist_entry" => [],
    "mandatoryFields-checklist_complete-entry" => ["checklist_description"],

    // Date Fields
    "dateFields-checklist_listing-point-entry" => [
        "point_start_date","point_end_date"
    ],

    // Additional Fields
    "additionalFields-checklist_entry" => [],

    // List Filters
    "listFilters-checklist" => [
        "admin" => [
            "checklist_listing" => "Listing/listing_id/checklist_listing-json",
            "status-filter"      => "Status/status/checklist_status-json"
        ],
        "portal" => [
            "checklist_listing" => "Listing/listing_id/checklist_listing-json",
            "status-filter"      => "Status/status/checklist_status-json"
        ]
    ],

    "listFilters-checklist_listing" => [
        "admin" => [
            "checklist_listing" => "Listing Type/listing_type/checklist_listing_type-json",
            "status-filter"      => "Status/status/checklist_listing_status-json"
        ],
        "portal" => [
            "checklist_listing" => "Listing/listing_type/checklist_listing_type-json",
            "status-filter"      => "Status/status/checklist_listing_status-json"
        ]
    ],

    // List options (admin)
    "listFilters-checklist_entry_update" => [
        "admin" => [
            "checklist" => [
                "Edit"          => "checklist/entry/update",
                "Update Points" => "checklist/complete-entry/new",
                "Upload"        => "checklist/upload",
                "View History"  => "checklist/history",
                "Report"        => "checklist/document"
            ]
        ]
    ],

    // Permissions Admin
    "permissionAdmin-checklist" => [
        "restricted" => [
            "2" => [["pg" => "checklist","sub_pg" => "settings"]],
            "3" => [["pg" => "checklist","sub_pg" => "settings"]],
        ],
        "allowed" => []
    ],

    // Permissions Portal
    "permissionPortal-checklist" => [
        "restricted" => [],
        "allowed" => [
            ["pg" => "checklist","sub_pg" => "home"],
            ["pg" => "checklist","sub_pg" => "entry"],
            ["pg" => "checklist","sub_pg" => "list"],
            ["pg" => "checklist","sub_pg" => "listing-point-list"],
            ["pg" => "checklist","sub_pg" => "history"],
            ["pg" => "checklist","sub_pg" => "report"],
            ["pg" => "checklist","sub_pg" => "checklist-report"]
        ]
    ],

    // Allowed Filters Portal
    // "permissionAllowedFiltersPortal-checklist" => [
    //     "entry"                => [["checklist_by" => '{$login_type}-{$login_id}']],
    //     "list"                 => [["checklist_by" => '{$login_type}-{$login_id}']],
    //     "listing-point-list"   => [["point_assigned_to" => '{$login_type}-{$login_id}']],
    //     "report"               => [["checklist_by" => '{$login_type}-{$login_id}']]
    // ],

    // Simple Lists
    "search_column-json" => ["checklist_name"],

    "checklist_point_duration_type-list" => [
        "minutes" => "Minutes",
        "hours"   => "Hours",
        "days"    => "Days",
        "months"  => "Months",
    ],

    "checklist_status-json" => [
        "1"  => "Under Process",
        "15" => "Completed",
        "2"  => "Deleted",
        "21" => "Rejected"
    ],

    "checklist_listing_status-json" => [
        "1" => "Active",
        "2" => "Deleted"
    ],

    "checklist_point_status-json" => [
        "1"  => "Active",
        "11" => "Draft",
        "12" => "Under Review",
        "15" => "Completed",
        "2"  => "Deleted",
        "21" => "Rejected"
    ],

    "checklist_listing_document-json" => [
        "listing-points" => "View Checklist"
    ],

    "checklist_document-json" => [
        "end-report" => "Report"
    ],

    "checklist_listing_time_type-json" => [
        "-"                => "None",
        "start-end-time"   => "Start and End Time",
        "start-end-date"   => "Start & End Date",
        "duration"         => "Duration"
    ],

    // Bulk operations
    "checklist_bulk_operation-list" => [
        "view:detail" => "View Checklist Details",
        "op:remove"   => "Delete",
        "op:restore"  => "Restore"
    ],

    "checklist_bulk_operation-json" => [
        "view:detail" => "View Checklist Details",
        "op:remove"   => "Delete",
        "op:restore"  => "Restore"
    ],

];

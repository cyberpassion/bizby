<?php

$pg = 'timetable';

return [

    // Communication Templates
    "communicationTemplate-timetable" => [
        "timetable_entry_new_sms"       => "New Timetable Entry SMS",
        "timetable_entry_new_whatsapp" => "New Timetable Entry Whatsapp",
        "timetable_entry_new_email"    => "New Timetable Entry Email",
    ],

    // Column Name Mapping
    "columnNameMapping-timetable" => [
        'timetable_id'      => 'ID',
        'subjects_duration' => 'Subjects & Duration'
    ],

    // Menu Items
    "menuItem-timetable" => [
        "admin"  => [
            'home'       => 'timetable-home',
            'list'       => 'timetable-list',
            'entry'      => 'timetable-entry',
            'settings'   => 'timetable-settings'
        ],
        "portal" => [
            'home'       => 'timetable-home',
            'list'       => 'timetable-list'
        ]
    ],

    // Page Structure
    "pgStructure-timetable" => [
        $pg => [
            'forms/form' => ['entry', 'teacher-allotment', 'settings'],
            'lists/list' => ['list'],
            'views/view' => ['home', 'document', 'profile', 'detail', 'history']
        ]
    ],

    // Mandatory Options before using module
    "mandatoryOptionsBeforeUsing-timetable" => [
        'missing_option' => []
    ],

    // Module Tables
    "moduleTable-timetable" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_timetable"
    ],

    // Default Columns
    "defaultColumns-timetable" => [
        'entry'            => ['timetable_id', 'session', 'recipient', 'months', 'subjects_duration','tags', 'status'],
        'list'             => ['timetable_id', 'session', 'recipient', 'months', 'subjects_duration','tags', 'status'],
        'detail'           => ['timetable_id', 'session', 'recipient', 'months', 'subjects_duration','tags', 'status'],
        'report'           => ['timetable_id', 'session', 'recipient', 'months', 'subjects_duration','tags', 'status'],
        'sample_export'    => ['sno', 'timetable_id', 'recipient', 'session', 'months', 'subjects_duration', 'status'],
        'selected_columns' => ['timetable_id', 'recipient', 'session', 'months', 'subjects_duration', 'status']
    ],

    // List Filters
    "listFilters-timetable_entry" => [
        "admin" => [
            'current_session_filter' => "Session/session/session-json",
            'current_class_filter'   => "Class/class/class-json",
            'current_section_filter' => "Section/section/section-json",
            'status_filter'          => "Status/status/status-json"
        ],
        "portal" => [
            'current_session_filter' => "Session/session/session-json",
            'current_class_filter'   => "Class/class/class-json",
            'current_section_filter' => "Section/section/section-json",
            'status_filter'          => "Status/status/status-json"
        ]
    ],

    // List Actions / Update Options
    "listFilters-timetable_entry_update" => [
        'admin' => [
            $pg => [
                'Edit'         => "{$pg}/entry/update",
                'Upload'       => "{$pg}/upload",
                'View Details' => "{$pg}/detail",
                'View History' => "{$pg}/history"
            ]
        ]
    ],

    // Timetable Bulk Operations
    "timetable_bulk_operation-list" => [
        "view:detail" => "View Detail",
        "op:remove"   => "Delete",
        "op:restore"  => "Restore"
    ],

    // Admin Permissions
    "permissionAdmin-timetable" => [
        'restricted' => [
            '2' => [['pg' => $pg, 'sub_pg' => 'settings']],
            '3' => [['pg' => $pg, 'sub_pg' => 'settings']]
        ],
        'allowed' => []
    ],

    // Portal Permissions
    "permissionPortal-timetable" => [
        'restricted' => [],
        'allowed' => [
            ['pg' => $pg, 'sub_pg' => 'home'],
            ['pg' => $pg, 'sub_pg' => 'list']
        ]
    ],

    // Allowed Filters for Portal
    // "permissionAllowedFiltersPortal-timetable" => [
    //     "entry" => [
    //         ["generated_by" => 'employee-{$login_id}', "contact_by" => 'employee-{$login_id}']
    //     ],
    //     "list"  => [
    //         ["generated_by" => 'employee-{$login_id}', "contact_by" => 'employee-{$login_id}']
    //     ],
    //     "report"=> [
    //         ["generated_by" => 'employee-{$login_id}', "contact_by" => 'employee-{$login_id}']
    //     ]
    // ],

    // Form Prefills
    "formPrefills-timetable_entry" => [
        "columns" => [
            'product'      => 'default_product',
            'contact_mode' => 'default_contact_mode',
            'state'        => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

    // Mandatory Fields
    "mandatoryFields-timetable_entry" => [
        'module',
        'timetable_official_name',
        'timetable_official_address',
        'timetable_official_email',
        'timetable_official_phone',
        'send_notification_message'
    ],

    // Date Fields
    "dateFields-timetable_entry" => [],

    // Additional Fields
    "additionalFields-timetable_entry" => [],

    // Status JSON
    "timetable_status-json" => []

];

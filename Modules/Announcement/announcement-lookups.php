<?php
$pg = 'announcement';

return [

    // Communication Templates
    'communicationTemplate-announcement' => [
        "announcement_entry_new_sms"        => "New Announcement Entry SMS",
        "announcement_entry_new_whatsapp"   => "New Announcement Entry Whatsapp",
        "announcement_entry_new_email"      => "New Announcement Entry Email",
    ],

    // Menu Items
    'menuItem-announcement' => [
        "admin"     => [],
        "portal"    => []
    ],

    // Page Structure
    'pgStructure-announcement' => [
        "announcement" => [
            'forms/form' => [
                'entry', 'salary-entry', 'salary-settings', 'settings',
                'advanced-info-entry', 'report', 'salary-report',
                'bulk-operation', 'upload', 'permission'
            ],
            'lists/list' => ['list'],
            'views/view' => ['home', 'document', 'profile', 'detail']
        ]
    ],

    // Column Name Mapping
    'columnNameMapping-announcement' => [
        'announcement_id'  => 'ID',
        'added_by'         => 'Added By',
        'added_by_type'    => 'Added By',
        'added_for'        => 'Added For',
        'added_by_for'     => 'Added For',
        'end_date'         => 'End Date'
    ],

    // Mandatory Options Before Using
    'mandatoryOptionsBeforeUsing-announcement' => [
        'missing_option' => [
            'Announcement Category' => 'announcement_category-json'
        ]
    ],

    // JSON Options
    'jsonOption-announcement' => [
        'announcement_category-json' => "Announcement Categories"
    ],

    // Module Tables
    'moduleTable-announcement' => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_announcement"
    ],

    // Default Columns
    'defaultColumns-announcement' => [
        'entry'             => ['date','announcement_id','announcement','category','all_recipients','added_by','tags','status'],
        'list'              => ['date','announcement_id','announcement','category','all_recipients','added_by','tags','status'],
        'detail'            => ['date','announcement_id','announcement','category','all_recipients','added_by','tags','status'],
        'report'            => ['date','announcement_id','announcement','category','all_recipients','added_by','tags','status'],
        'sample_export'     => ['sno','announcement_id','announcement','category','recipient','added_by'],
        'selected_columns'  => ['announcement_id','announcement','category','recipient','added_by']
    ],

    // Cron List
    'cronList-announcement' => [
        'announcement-notification' => 'Announcement Notification'
    ],

    // Mandatory Fields
    'mandatoryFields-announcement_entry'        => ['announcement', 'recipients'],
    'mandatoryFields-announcement_entry_new'    => ['announcement', 'recipients'],
    'mandatoryFields-announcement_entry_update' => ['announcement', 'recipients'],

    // Date Fields
    'dateFields-announcement_entry'        => ['end_date'],
    'dateFields-announcement_entry_new'    => ['end_date'],
    'dateFields-announcement_entry_update' => ['end_date'],

    // Duplicacy Check
    'duplicacyCheckFields-announcement_entry'     => ['date', 'announcement'],
    'duplicacyCheckFields-announcement_entry_new' => ['date', 'announcement'],

    // Additional Fields
    'additionalFields-announcement_entry'        => [],
    'additionalFields-announcement_entry_new'    => [],
    'additionalFields-announcement_entry_update' => [],

    // List Filters
    'listFilters-announcement_entry' => [
        "admin" => [
            'date_filter'                  => "Date/date/announcement_date-json",
            'announcement_category_filter' => "Catgory/category/announcement_category-json",
            'announcement_status_filter'   => "Status/status/status-json"
        ],
        "portal" => [
            'date_filter'                  => "Date/date/announcement_date-json",
            'announcement_category_filter' => "Catgory/category/announcement_category-json",
            'announcement_status_filter'   => "Status/status/status-json"
        ]
    ],

    // Update Filters
    'listFilters-announcement_entry_update' => [
        'admin' => [
            'announcement' => [
                'Edit'        => "announcement/entry/update",
                'Upload'      => "announcement/upload",
                'View Details'=> "announcement/detail",
                'View History'=> [
                    'path'   => "history/activity",
                    'params' => [
                        'type'    => 'announcement',
                        'keyname' => 'admission_id'
                    ]
                ]
            ]
        ],
        'portal' => [
            'announcement' => [
                'View Details' => "announcement/detail"
            ]
        ]
    ],

    // Permission Admin
    'permissionAdmin-announcement' => [
        'restricted' => [
            '2' => [['pg'=>'announcement','sub_pg'=>'settings']],
            '3' => [['pg'=>'announcement','sub_pg'=>'settings']]
        ],
        'allowed' => []
    ],

    // Permission Portal
    'permissionPortal-announcement' => [
        'restricted' => [],
        'allowed' => [
            ['pg'=>'announcement','sub_pg'=>'home'],
            ['pg'=>'announcement','sub_pg'=>'list'],
            ['pg'=>'announcement','sub_pg'=>'detail'],
            ['pg'=>'announcement','sub_pg'=>'report'],
            ['pg'=>'announcement','sub_pg'=>'history'],
            ['pg'=>'announcement','sub_pg'=>'announcement-report']
        ]
    ],

    // Allowed Filters For Portal
    'permissionAllowedFiltersPortal-announcement' => [
        "entry"  => [["recipient" => '{$login_type}-{$byline}']],
        "list"   => [["recipient" => '{$login_type}-{$byline}']],
        "report" => [["recipient" => '{$login_type}-{$byline}']]
    ],

    // Form Prefills
    'formPrefills-announcement_entry' => [
        "columns" => [
            'product'       => 'default_product',
            'contact_mode'  => 'default_contact_mode',
            'state'         => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

    // Status JSON
    'announcement_status-json' => [],

    // Date JSON
    'announcement_date-json' => [],

    // Category JSON
    'announcement_category-json' => [],

    // Bulk Operation
    'announcement_bulk_operation-list' => [
        "view:detail" => "View Detail",
        "op:remove"   => "Delete",
        "op:restore"  => "Restore"
    ],

    // Permission JSON
    'announcement_permission-json' => [],

    // Document Upload Types
    'announcement_document_upload_type-json' => [
        "pdf"
    ]
];

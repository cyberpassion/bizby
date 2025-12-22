<?php
$pg = 'announcement';
$commonSettingsRoute = '/settings';

return [
    'menuItem-announcement' => [
        'admin' => [
            'parent' => [
                $pg => '#',
            ],
            'child' => [
                $pg => [
                    ['Add New'   => "/{$pg}/new"],
                    ['View List' => "/{$pg}/list"],
                    ['Report'    => "/{$pg}/report"],
                    ['Settings'  => "/{$pg}/settings"],
                    [
                        'Plugin' => [
                            ['View Calendar' => "/{$pg}/calendar"],
                        ]
                    ],
                ],
            ],
        ],
    ],

    'sidebar-menu' => [
        [
            'title' => ucfirst($pg),
            'href'  => "/{$pg}",
            'items' => [
                ['title' => 'Home',     'href' => "/module/{$pg}/home"],
                ['title' => 'Add New',  'href' => "/module/{$pg}/new"],
                ['title' => 'View List','href' => "/module/{$pg}/list"],
                ['title' => 'Report',   'href' => "/module/{$pg}/report"],
                ['title' => 'Settings', 'href' => "/module/{$pg}/settings"],
                [
                    'title' => 'Plugin',
                    'items' => [
                        ['title' => 'View Calendar', 'href' => "/module/{$pg}/calendar"],
                    ]
                ],
            ],
        ],
    ],

    "communicationTemplate-announcement" => [
        "announcement_entry_new_sms"       => "New Announcement Entry SMS",
        "announcement_entry_new_whatsapp" => "New Announcement Entry Whatsapp",
        "announcement_entry_new_email"    => "New Announcement Entry Email",
    ],

    "columnNameMapping-announcement" => [
        'announcement_id' => 'ID',
        'added_by'        => 'Added By',
        'added_by_type'   => 'Added By',
        'added_for'       => 'Added For',
        'added_by_for'    => 'Added For',
        'end_date'        => 'End Date'
    ],

    "mandatoryOptionsBeforeUsing-announcement" => [
        'missing_option' => [
            'Announcement Category' => 'announcement_category-json'
        ]
    ],

    "jsonOption-announcement" => [
        'announcement_category-json' => 'Announcement Categories'
    ],

    "moduleTable-announcement" => [
        "terms",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "uploads",
        "cyp_notification",
        "cyp_message",
        "cyp_announcement"
    ],

    "defaultColumns-announcement" => [
        'entry'          => ['date', 'announcement_id', 'announcement', 'category', 'all_recipients', 'added_by','tags', 'status'],
        'list'           => ['date', 'announcement_id', 'announcement', 'category', 'all_recipients', 'added_by','tags', 'status'],
        'detail'         => ['date', 'announcement_id', 'announcement', 'category', 'all_recipients', 'added_by','tags', 'status'],
        'report'         => ['date', 'announcement_id', 'announcement', 'category', 'all_recipients', 'added_by','tags', 'status'],
        'sample_export'  => ['sno', 'announcement_id', 'announcement', 'category', 'recipient', 'added_by'],
        'selected_columns'=> ['announcement_id', 'announcement', 'category', 'recipient', 'added_by']
    ],

    "cronList-announcement" => [
        'announcement-notification' => 'Announcement Notification'
    ],

    "mandatoryFields-announcement_entry_update" => ['announcement', 'recipients'],
    "dateFields-announcement_entry_update"      => ['end_date'],
    "duplicacyCheckFields-announcement_entry_new"=> ['date', 'announcement'],

    "listFilters-announcement_list" => [
        "admin" => [
            'date_filter'                   => "Date/date/announcement_date-json",
            'announcement_category_filter' => "Catgory/category/announcement_category-json",
            'announcement_status_filter'   => "Status/status/status-json"
        ],
        "portal" => [
            'date_filter'                   => "Date/date/announcement_date-json",
            'announcement_category_filter' => "Catgory/category/announcement_category-json",
            'announcement_status_filter'   => "Status/status/status-json"
        ]
    ],

    "listFilters-announcement_detail_update" => [
        'admin' => [
            $pg => [
                'Edit'         => "{$pg}/entry/update",
                'Upload'       => "{$pg}/upload",
                'View Details' => "{$pg}/detail",
                'View History' => [
                    'path'   => "history/activity",
                    'params' => [
                        'type'    => $pg,
                        'keyname' => 'admission_id'
                    ]
                ]
            ]
        ],
        'portal' => [
            $pg => [
                'View Details' => "{$pg}/detail"
            ]
        ]
    ],

    "permissionAdmin-student" => [
        'restricted' => [
            '2' => [['pg' => $pg, 'sub_pg' => 'settings']],
            '3' => [['pg' => $pg, 'sub_pg' => 'settings']]
        ],
        'allowed' => []
    ],

    "permissionRestrictedAdmin-module" => [
        ['pg' => $pg, 'sub_pg' => 'settings']
    ],

    "permissionPortal-announcement" => [
        'restricted' => [],
        'allowed' => [
            ['pg' => $pg, 'sub_pg' => 'home'],
            ['pg' => $pg, 'sub_pg' => 'list'],
            ['pg' => $pg, 'sub_pg' => 'detail'],
            ['pg' => $pg, 'sub_pg' => 'report'],
            ['pg' => $pg, 'sub_pg' => 'history'],
            ['pg' => $pg, 'sub_pg' => "{$pg}-report"],
        ]
    ],

    "permissionAllowedPortal-module" => [
        ['pg' => $pg, 'sub_pg' => 'home'],
        ['pg' => $pg, 'sub_pg' => 'list'],
        ['pg' => $pg, 'sub_pg' => 'detail'],
        ['pg' => $pg, 'sub_pg' => 'report']
    ],

    "permissionAllowedFiltersPortal-announcement" => [
        "entry"  => [["recipient" => '{$login_type}-{$byline}']],
        "list"   => [["recipient" => '{$login_type}-{$byline}']],
        "report" => [["recipient" => '{$login_type}-{$byline}']]
    ],

    "formPrefills-announcement_entry_new" => [
        "columns" => [
            'product'       => 'default_product',
            'contact_mode'  => 'default_contact_mode',
            'state'         => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

    "announcement_bulk_operation-list" => [
        "view:detail" => "View Detail",
        "op:remove"   => "Delete",
        "op:restore"  => "Restore"
    ],

    "announcement_document_upload_type-json" => ["pdf"]
];

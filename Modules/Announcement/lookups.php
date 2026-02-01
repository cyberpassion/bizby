<?php
$pg = 'announcement';
$commonSettingsRoute = '/settings';

return [

    'sidebar-menu' => [
    [
        'title'      => ucfirst($pg),
        'href'       => "/{$pg}",
        'permission' => "{$pg}.access",
        'items'      => [

            /* =========================
             | Dashboard
             ========================= */
            [
                'title'      => 'Dashboard',
                'href'       => "/module/{$pg}/home",
                'permission' => "{$pg}.dashboard.view",
            ],

            /* =========================
             | Announcement Management
             ========================= */
            [
                'title' => 'Announcements',
                'items' => [
                    [
                        'title'      => 'Add Announcement',
                        'href'       => "/module/{$pg}/new",
                        'permission' => "{$pg}.announcement.create",
                    ],
                    [
                        'title'      => 'View List',
                        'href'       => "/module/{$pg}/list",
                        'permission' => "{$pg}.announcement.view",
                    ],
                ],
            ],

            /* =========================
             | Reports
             ========================= */
            [
                'title' => 'Reports',
                'items' => [
                    [
                        'title'      => 'Announcement Report',
                        'href'       => "/module/{$pg}/report",
                        'permission' => "{$pg}.report.announcement",
                    ],
                ],
            ],

            /* =========================
             | Settings
             ========================= */
            [
                'title' => 'Settings',
                'items' => [
                    [
                        'title'      => 'Basic Settings',
                        'href'       => "/module/{$pg}/settings",
                        'permission' => "{$pg}.settings.basic",
                    ],
                ],
            ],

            /* =========================
             | Plugins
             ========================= */
            [
                'title' => 'Plugins',
                'items' => [
                    [
                        'title'      => 'Integrations',
                        'href'       => "/module/{$pg}/plugins",
                        'permission' => "{$pg}.plugin.manage",
                    ],
                ],
            ],
        ],
    ],
],

    "announcement.crons" => [
        'announcement-notification' => 'Announcement Notification'
    ],
    "announcement.list-filters" => [
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
    "announcement.bulk-operations" => [
        "view:detail" => "View Detail",
        "op:remove"   => "Delete",
        "op:restore"  => "Restore"
    ],
    "announcement.default-columns" => [
        'entry'          => ['date', 'announcement_id', 'announcement', 'category', 'all_recipients', 'added_by','tags', 'status'],
        'list'           => ['date', 'announcement_id', 'announcement', 'category', 'all_recipients', 'added_by','tags', 'status'],
        'detail'         => ['date', 'announcement_id', 'announcement', 'category', 'all_recipients', 'added_by','tags', 'status'],
        'report'         => ['date', 'announcement_id', 'announcement', 'category', 'all_recipients', 'added_by','tags', 'status'],
        'sample_export'  => ['sno', 'announcement_id', 'announcement', 'category', 'recipient', 'added_by'],
        'selected_columns'=> ['announcement_id', 'announcement', 'category', 'recipient', 'added_by']
    ],
    "announcement.permission-allowed-filters-portal" => [
        "entry"  => [["recipient" => '{$login_type}-{$byline}']],
        "list"   => [["recipient" => '{$login_type}-{$byline}']],
        "report" => [["recipient" => '{$login_type}-{$byline}']]
    ],
    'announcement.list-columns' => [
	    'id',
    	'category',
	    'recipient',
    	'session',
	    'end_date',
    	'added_by',
    ],
    'announcement.list-filters' => [
	    'category',
    	'recipient',
	    'session',
    	'month',
    	'status',
    	'end_date',
    ],
    'announcement.report-columns' => [
	    'id',
   		'category',
	    'recipient',
    	'announcement',
	    'session',
    	'month',
	    'end_date',
    	'added_by_type',
	    'added_by',
    	'entry_source',
	    'status',
    	'created_at',
    ],
    'announcement.announcement-categories' => [
		'default'	=>	'Default'
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

    "mandatoryFields-announcement-entry-update" => ['announcement', 'recipients'],
    "dateFields-announcement-entry-update"      => ['end_date'],
    "duplicacyCheckFields-announcement-entry-new"=> ['date', 'announcement'],

    "listFilters-announcement-detail-update" => [
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

    "formPrefills-announcement-entry-new" => [
        "columns" => [
            'product'       => 'default_product',
            'contact_mode'  => 'default_contact_mode',
            'state'         => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

    "announcement-document-upload-type" => ["pdf"]
];

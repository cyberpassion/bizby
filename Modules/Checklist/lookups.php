<?php
$pg = 'checklist';
$commonSettingsRoute = '/settings';

return [

    'menuItem-checklist' => [
        'admin' => [
            'parent' => [
                $pg => '#',
            ],
            'child' => [
                $pg => [

                    ['Add New'   => "/{$pg}/new"],
                    ['View List' => "/{$pg}/list"],
                    ['Settings'  => "/{$pg}/settings"],
                    ['Report'    => "/{$pg}/report"],

                    [
                        'Plans' => [
                            ['Create New'     => "/{$pg}/new"],
                            ['View Plan List' => "/{$pg}/list"],
                        ]
                    ],

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
                ['title' => 'Settings', 'href' => "/module/{$pg}/settings"],
                ['title' => 'Report',   'href' => "/module/{$pg}/report"],

                [
                    'title' => 'Plans',
                    'items' => [
                        ['title' => 'Create New',     'href' => "/module/{$pg}/new"],
                        ['title' => 'View Plan List', 'href' => "/module/{$pg}/list"],
                    ]
                ],

                [
                    'title' => 'Plugin',
                    'items' => [
                        ['title' => 'View Calendar', 'href' => "/plugin/calendar?module={$pg}"],
                    ]
                ],
            ],
        ],
    ],

    "communicationTemplate-checklist" => [
                        "checklist_entry_new_sms"		=>	"New Checklist Entry SMS",
                        "checklist_entry_new_whatsapp"	=>	"New Checklist Entry Whatsapp",
                        "checklist_entry_new_email"		=>	"New Checklist Entry Email",
    ],
    "columnNameMapping-checklist" => [
                        'ptr'								=>	'SNo',
                        'listing_id'						=>	'ID',
                        'listing_name'						=>	'L/Name',
                        'listing_type'						=>	'Type',
                        'listing_description'				=>	'Description',
                        'listing_points'					=>	'Points',
                        'listing_points_count'				=>	'Points',
                        'checklist_id'						=>	'ID',
                        'checklist_name'					=>	'Name',
                        'checklist_info'					=>	'Information'
    ],
    "moduleTable-checklist" => [
                        "terms",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "uploads",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_checklist",
                        "cyp_checklist_item"
    ],
    "mandatoryOptionsBeforeUsing-checklist" => [
                        'checklist-entry'	=>	[
                            'empty'			=>	[
                                [
                                    'table'	=>	'#',
                                    'params'=>	[],
                                    'label'	=>	'No Checklist Plan Added',
                                    'routeLabel'	=>	'Set Now',
                                    'routes'=>	[
                                        'php'=>	'#',
                                        'pwa'=>	"/{$pg}/listing-entry",
                                        'app'=>	"/{$pg}/listing-entry"
                                    ]
                                ],
                                [
                                    'table'	=>	'#',
                                    'params'=>	[],
                                    'label'	=>	'No Service Points Added',
                                    'routeLabel'	=>	'Set Now',
                                    'routes'=>	[
                                        'php'=>	'#',
                                        'pwa'=>	"/{$pg}/listing-list",
                                        'app'=>	"/{$pg}/listing-list"
                                    ]
                                ]
                            ]
                        ],
                        'missing_option'	=>	[]
    ],
    "defaultColumns-checklist" => [
                        'entry'				=>	['checklist_id', 'checklist_name', 'listing_name', 'progress','tags', 'status'],
                        'list'				=>	['checklist_id', 'checklist_name', 'listing_name', 'progress','tags', 'status'],
                        'detail'			=>	['checklist_id', 'checklist_name', 'listing_name', 'progress','tags', 'status'],
                        'report'			=>	['checklist_id', 'checklist_name', 'listing_name', 'progress','tags', 'status'],
                        'sample_export'		=>	['sno', 'checklist_name', 'checklist_info', 'remark', 'status'],
                        'selected_columns'	=>	['checklist_name', 'checklist_info', 'remark'],
                        'listing-list'		=>	['listing_id', 'listing_type', 'listing_name', 'listing_name', 'tags', 'status'],
                        'listing-point-list'=>	['point_name', 'point_assigned_to', 'point_time_limit', 'point_description', 'status']
    ],
    "mandatoryFields-checklist-complete-entry-update" => ["checklist_description"],

    "dateFields-checklist-listing-point-entry-update" => ['point_start_date','point_end_date'],

    "listFilters-checklist-list" => [
                            "admin"	=>	[
                                "checklist_listing"	=>	"Listing/listing_id/checklist_listing-json",
                                "status-filter"		=>	"Status/status/checklist_status-json"
                            ],
                            "portal" => [
                                "checklist_listing"	=>	"Listing/listing_id/checklist_listing-json",
                                "status-filter"		=>	"Status/status/checklist_status-json"
                            ]
    ],
    "listFilters-checklist-listing-list" => [
                            "admin"	=>	[
                                "checklist_listing"	=>	"Listing Type/listing_type/checklist_listing_type-json",
                                "status-filter"		=>	"Status/status/checklist_listing_status-json"
                            ],
                            "portal" => [
                                "checklist_listing"	=>	"Listing/listing_type/checklist_listing_type-json",
                                "status-filter"		=>	"Status/status/checklist_listing_status-json"
                            ]
    ],
    "listFilters-checklist-detail-update" => [
                        'admin'	=>	array(
                            $pg			=>	[
                                'Edit'			=>	"{$pg}/entry/update",
                                'Update Points'	=>	"{$pg}/complete-entry/new",
                                'Upload'		=>	"{$pg}/upload",
                                'View History'	=>	"{$pg}/history",
                                'Report'		=>	"{$pg}/document",
                                'Assign'		=>	["endpoint" => $pg, "params" =>	["key" => "form:advancedinfo/assignment-entry", "info_type" => "checklist", "info_subtype" => "entry"]]
                            ]
                        )
    ],
    "listFilters-checklist-listing-list-update" => [
                        'admin'	=>	array(
                            $pg			=>	[
                                'Add Points'	=>	"{$pg}/listing-point-entry/new",
                                'Arrange Points'=>	"{$pg}/listing-point-sequence-entry/new",
                                'Edit'			=>	"{$pg}/listing-entry/update",
                                'Upload'		=>	"{$pg}/upload",
                                'View Details'	=>	"{$pg}/listing-detail",
                                'View History'	=>	"{$pg}/history",
                                'Assign'		=>	["endpoint" => $pg, "params" =>	["key" => "form:advancedinfo/assignment-entry", "info_type" => "checklist", "info_subtype" => "listing-entry"]]
                            ]
                        )
    ],
    "listFilters-checklist-listing-point-list-update" => [
                        'admin'	=>	array(
                            $pg			=>	[
                                'Edit'			=>	"{$pg}/listing-point-entry/update"
                            ]
                        ),
                        'admin'	=>	array(
                            $pg			=>	[
                                'Add Response'	=>	"{$pg}/listing-point-entry/update"
                            ]
                        )
    ],
    "listFilters-checklist-final-complete-list-update" => [
                        'admin'	=>	array(
                            $pg			=>	[
                                'Document'		=>	"{$pg}/document"
                            ]
                        )
    ],
    "permissionAdmin-checklist" => [
                        'restricted'=>	[
                            '2'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']],
                            '3'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']]
                        ],
                        'allowed'	=>	[]
    ],
    "permissionRestrictedAdmin-checklist" => [
                        ['pg' => $pg, 'sub_pg'	=>	'settings']
    ],
    "permissionPortal-checklist" => [
                        'restricted'	=>	[],
                        'allowed'		=>	[
                            ['pg' => $pg, 'sub_pg'	=>	'home'],
                            ['pg' => $pg, 'sub_pg'	=>	'entry'],
                            ['pg' => $pg, 'sub_pg'	=>	'list'],
                            ['pg' => $pg, 'sub_pg'	=>	'listing-point-list'],
                            ['pg' => $pg, 'sub_pg'	=>	'history'],
                            ['pg' => $pg, 'sub_pg'	=>	'report'],
                            ['pg' => $pg, 'sub_pg'	=>	"{$pg}-report"], // logic is different in portal_page_access_barricade
                        ]
    ],
    "permissionAllowedPortal-checklist" => [
                        ['pg' => $pg, 'sub_pg'	=>	'home'],
                        ['pg' => $pg, 'sub_pg'	=>	'entry'],
                        ['pg' => $pg, 'sub_pg'	=>	'list'],
                        ['pg' => $pg, 'sub_pg'	=>	'listing-point-list'],
                        ['pg' => $pg, 'sub_pg'	=>	'history'],
                        ['pg' => $pg, 'sub_pg'	=>	'report'],
                        ['pg' => $pg, 'sub_pg'	=>	"{$pg}-report"], // logic is different in portal_page_access_barricade
    ],
    "permissionAllowedFiltersPortal-checklist" => [
                        "entry"					=>	[["checklist_by"		=>	'{$login_type}-{$login_id}']],
                        "list"					=>	[["checklist_by"		=>	'{$login_type}-{$login_id}']],
                        "listing-point-list"	=>	[["point_assigned_to"	=>	'{$login_type}-{$login_id}']],
                        "report"				=>	[["checklist_by"		=>	'{$login_type}-{$login_id}']],
    ],
    "search-column" => ["checklist_name"],

    "checklist-point-duration-type-list" => [
                        "minutes"	=>	"Minutes",
                        "hours"		=>	"Hours",
                        "days"		=>	"Days",
                        "months"	=>	"Months"
    ],
    "checklist-tatus" => [
                        '1'		=>	'Under Process',
                        '15'	=>	'Completed',
                        '2'		=>	'Deleted',
                        '21'	=>	'Rejected'
    ],
    "checklist-listing-status-json" => [
                        '1'		=>	'Active',
                        '2'		=>	'Deleted'
    ],
    "checklist-point-status-json" => [
                        '1'		=>	'Active',
                        '11'	=>	'Draft',
                        '12'	=>	'Under Review',
                        '15'	=>	'Completed',
                        '2'		=>	'Deleted',
                        '21'	=>	'Rejected'
    ],
    "checklist-listing-document" => ['listing-points'	=> 'View Checklist'],

    "checklist-document" => ['end-report'		=> 'Report'],

    "checklist-listing-time-type" => [
                        '-'					=> 'None',
                        'start-end-time'	=>	'Start and End Time',
                        'start-end-date'	=>	'Start & End Date',
                        'duration'			=>	'Duration'
    ],
    "checklist-bulk-operation" => [
                        "view:detail"			=>	"View Checklist Details",
                        "op:remove"				=>	"Delete",
                        "op:restore"			=>	"Restore"
    ]

];

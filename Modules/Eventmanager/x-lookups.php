<?php
$pg = 'eventmanager';
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
             | Event Management
             ========================= */
            [
                'title' => 'Events',
                'items' => [
                    [
                        'title'      => 'Add Event',
                        'href'       => "/module/{$pg}/new",
                        'permission' => "{$pg}.event.create",
                    ],
                    [
                        'title'      => 'Event List',
                        'href'       => "/module/{$pg}/list",
                        'permission' => "{$pg}.event.view",
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
                        'title'      => 'Event Report',
                        'href'       => "/module/{$pg}/report",
                        'permission' => "{$pg}.report.view",
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
                        'title'      => 'Event Settings',
                        'href'       => "/module/{$pg}/settings",
                        'permission' => "{$pg}.settings.manage",
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
                        'title'      => 'Calendar View',
                        'href'       => "/plugin/calendar?module={$pg}",
                        'permission' => "{$pg}.plugin.calendar",
                    ],
                ],
            ],
        ],
    ],
],

    "eventmanager.crons" => ['eventmanager-notification' => 'Event Notification'],
    "eventmanager.list-filters" => [
                        "admin"	=>	[
                            'date_filter' 				=> "Date/event_date/event_date-json",
                            'eventmanager_head_filter'	=> "Type/event_type/event_type-json",
                            'status_filter'				=> "Status/status/eventmanager_status-json"
                        ],
                        "portal" => [
                            'date_filter'				=> "Date/event_date/event_date-json",
                            'eventmanager_head_filter'	=> "Type/event_type/event_type-json",
                            'status_filter'				=> "Status/status/eventmanager_status-json"
                        ]
    ],
    "eventmanager.bulk-operations" => [
                        "view:detail"		=>	"View Event Details",
                        "send:sms"			=>	"Send SMS to Participants",
                        "send:email"		=>	"Send Email to Participants",
                        "op:remove"			=>	"Delete Event",
                        "op:restore"		=>	"Restore Event"
    ],
    "eventmanager.default-columns" => [
                        'entry'				=>	['event_id', 'event_name', 'event_description', 'event_on', 'event_participants','tags', 'status'],
                        'list'				=>	['event_id', 'event_name', 'event_description', 'event_on', 'event_participants','tags', 'status'],
                        'detail'			=>	['event_id', 'event_name', 'event_description', 'event_on', 'event_participants','tags', 'status'],
                        'report'			=>	['event_id', 'event_name', 'event_description', 'event_on', 'event_participants','tags', 'status'],
                        'sample_export'		=>	['sno', 'event_name', 'event_description', 'event_on', 'event_participants'],
                        'selected_columns'	=>	['event_name', 'event_description', 'event_on', 'event_participants']
    ],
    "eventmanager.permission-allowed-filters-portal" => [
                        "entry"		=>	[["participant"	=>	'{$login_type}-{$byline}']],
                        "list"		=>	[["participant"	=>	'{$login_type}-{$byline}']],
                        "report"	=>	[["participant"	=>	'{$login_type}-{$byline}']]
    ],
    'eventmanager.list-columns' => [
                        'id',
                        'event_name',
                        'event_type',
                        'event_start_date',
                        'event_end_date',
                        'status',
    ],

    'eventmanager.list-filters' => [
                       'event_name',
                       'event_type',
                       'event_start_date',
                       'event_end_date',
                       'status',
    ],

    'eventmanager.report-columns' => [
                       'id',
                       'event_name',
                       'event_type',
                       'event_start_date',
                       'event_end_date',
                       'participant',
                       'event_participants',
                       'event_description',
                       'event_remark',
                       'status',
    ],

	'eventmanager.event-types' => [
		'default' => 'Default',
	],

    "communicationTemplate-eventmanager" => [
                        "eventmanager_entry_new_sms"		=>	"New Eventmanager Entry SMS",
                        "eventmanager_entry_new_whatsapp"	=>	"New Eventmanager Entry Whatsapp",
                        "eventmanager_entry_new_email"		=>	"New Eventmanager Entry Email",
    ],
    "columnNameMapping-eventmanager" => [
                        'event_id'			=>	'ID',
                        'event_start_date'	=>	'Start Date',
                        'event_end_date'	=>	'End Date',
                        'event_on'			=>	'Date',
                        'event_participants' =>	'Participants',
                        'event_name'		=>	'Name',
                        'event_description'	=>	'Description'
    ],
    "mandatoryOptionsBeforeUsing-eventmanager" => [
                        'missing_option'	=>	[
                            'Event Types'	=>	'event_type-json'
                        ]
    ],
    "moduleTable-eventmanager" => [
                        "terms",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "uploads",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_event"
    ],

    "mandatoryFields-eventmanager-entry-update" => ['event_name','event_participants'],

    "dateFields-eventmanager-entry-update" => ['date'],

    "listFilters-eventmanager-detail-update" => [
                        'admin'	=>	array(
                            $pg			=>	[
                                'Edit'			=>	"{$pg}/entry/update",
                                'Upload'		=>	"{$pg}/upload",
                                'View Details'	=>	"{$pg}/detail",
                                'View History'	=>	"{$pg}/history",
                            ]
                        )
    ],
    "permissionAdmin-eventmanager" => [
                        'restricted'=>	[
                            '2'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']],
                            '3'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']]
                        ],
                        'allowed'	=>	[]
    ],
    "permissionRestrictedAdmin-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'settings']
    ],
    "permissionPortal-eventmanager" => [
                        'restricted'	=>	[],
                        'allowed'		=>	[
                            ['pg' => $pg, 'sub_pg'	=>	'home'],
                            //['pg' => $pg, 'sub_pg'	=>	'entry'],
                            ['pg' => $pg, 'sub_pg'	=>	'list'],
                            ['pg' => $pg, 'sub_pg'	=>	'report'],
                            //['pg' => $pg, 'sub_pg'	=>	'settings']
                        ]
    ],
    "permissionAllowedPortal-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'home'],
                        //['pg' => $pg, 'sub_pg'	=>	'entry'],
                        ['pg' => $pg, 'sub_pg'	=>	'list'],
                        ['pg' => $pg, 'sub_pg'	=>	'report'],
                        //['pg' => $pg, 'sub_pg'	=>	'settings']
    ],
    "formPrefills-eventmanager-entry-new" => 
                    [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
    ],

];

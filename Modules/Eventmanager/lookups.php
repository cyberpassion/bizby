<?php
$pg = 'product';
$commonSettingsRoute = '/settings';

return [
	'menuItem-patient' => [
		'admin'	=>	[
			'parent'		=>	[
				$pg	=>	'#',
			],
			'child'		=>	[
				$pg	=>	[
					['Add New'		=> "/{$pg}/create"],
	                ['View List'	=> "/{$pg}/list"],
    	            ['Report'		=> "/{$pg}/report"],
        	        ['Settings'		=> "/{$pg}/settings"],
				],
			],
		],
	],
    'sidebar-menu' => [
        [
            'title' => ucfirst($pg),
            'href' => "/{$pg}",
            'items' => [
                ['title' => 'Home', 'href' => "/module/{$pg}/home"],
				['title' => 'Add New', 'href' => "/module/{$pg}/new"],
                ['title' => 'View List', 'href' => "/module/{$pg}/list"],
                ['title' => 'Report', 'href' => "/module/{$pg}/report"],
                ['title' => 'Settings', 'href' => "/module/{$pg}/settings"],
            ],
        ],
    ]
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
    "menuItem-eventmanager" => [
                        "admin"		=>	\v3\C\Module::default_features_menu_list(['name' => $pg, 'label' => do_ucf($pg)]),
                        "portal"	=>	\v3\C\Module::default_features_menu_list(['name' => $pg, 'label' => do_ucf($pg)], 'portal'),
    ],
    "pgStructure-eventmanager" => [
                        $pg			=>	[
                            'forms/form'		=>	['entry', 'upload', 'settings', 'report'],
                            'lists/list'		=>	['list'],
                            'views/view'		=>	array_merge($documents,['home', 'document', 'profile', 'detail', 'history'])
                        ]
    ],
    "mandatoryOptionsBeforeUsing-eventmanager" => [
                        'missing_option'	=>	[
                            'Event Types'	=>	'event_type-json'
                        ]
    ],
    "moduleTable-eventmanager" => [
                        "cyp_term",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "cyp_upload",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_event"
    ],
    "defaultColumns-eventmanager" => [
                        'entry'				=>	['event_id', 'event_name', 'event_description', 'event_on', 'event_participants','tags', 'status'],
                        'list'				=>	['event_id', 'event_name', 'event_description', 'event_on', 'event_participants','tags', 'status'],
                        'detail'			=>	['event_id', 'event_name', 'event_description', 'event_on', 'event_participants','tags', 'status'],
                        'report'			=>	['event_id', 'event_name', 'event_description', 'event_on', 'event_participants','tags', 'status'],
                        'sample_export'		=>	['sno', 'event_name', 'event_description', 'event_on', 'event_participants'],
                        'selected_columns'	=>	['event_name', 'event_description', 'event_on', 'event_participants']
    ],
    "cronList-eventmanager" => ['eventmanager-notification' => 'Event Notification'],

    "mandatoryFields-eventmanager_entry_update" => ['event_name','event_participants'],

    "dateFields-eventmanager_entry_update" => ['date'],

    "listFilters-eventmanager_list" => [
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
    "listFilters-eventmanager_detail_update" => [
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
    "permissionAllowedFiltersPortal-eventmanager" => [
                        "entry"		=>	[["participant"	=>	'{$login_type}-{$byline}']],
                        "list"		=>	[["participant"	=>	'{$login_type}-{$byline}']],
                        "report"	=>	[["participant"	=>	'{$login_type}-{$byline}']]
    ],
    "formPrefills-eventmanager_entry_new" => "formPrefills-eventmanager_entry_new":
                    $res = [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
    ],
    "eventmanager_bulk_operation-list" => [
                        "view:detail"		=>	"View Event Details",
                        "send:sms"			=>	"Send SMS to Participants",
                        "send:email"		=>	"Send Email to Participants",
                        "op:remove"			=>	"Delete Event",
                        "op:restore"		=>	"Restore Event"
    ]

];

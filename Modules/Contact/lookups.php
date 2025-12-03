<?php
$pg = 'contact';
$commonSettingsRoute = '/settings';

return [
	'menuItem-contact' => [
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
    "communicationTemplate-contact" => [
                        "contact_entry_new_sms"				=>	"New Contact Entry SMS",
                        "contact_entry_new_whatsapp"			=>	"New Contact Entry Whatsapp",
                        "contact_entry_new_email"				=>	"New Contact Entry Email",
                        "contact_next_date_reminder_sms"		=>	"Contact Next Date Reminder SMS",
                        "contact_next_date_reminder_whatsapp"	=>	"Contact Next Date Reminder Whatsapp",
                        "contact_next_date_reminder_email"		=>	"Contact Next Date Reminder Email",
                        "contact_birthday_new_sms"					=>	"Contact Birthday SMS",
                        "contact_birthday_new_whatsapp"			=>	"Contact Birthday Whatsapp",
                        "contact_birthday_new_email"				=>	"Contact Birthday Email",
    ],
    "columnNameMapping-contact" => [
                        'contact_id'		=>	'ID',
                        'contact_name'		=>	'Name',
                        'contact_type'		=>	'Type',
                        'additional_information'=>	'Information'
    ],
    "menuItem-contact" => [
                        "admin"		=>	\v3\C\Module::default_features_menu_list(['name' => $pg, 'label' => do_ucf($pg)]),
                        "portal"	=>	[]//\v3\C\Module::default_features_menu_list(['name' => $pg, 'label' => do_ucf($pg)], 'portal'),
    ],
    "pgStructure-contact" => [
                        $pg			=>	[
                            'forms/form'		=>	['entry', 'report', 'upload', 'settings'],
                            'lists/list'		=>	['list'],
                            'views/view'		=>	array_merge($documents,['home', 'document', 'profile', 'detail', 'history'])
                        ]
    ],
    "cronList-contact" => [
                        'contact-due_date' 	=> 'Contact Due Date',
                        'contact-birthday' 	=> 'Contact Birthday Message'
    ],
    "mandatoryOptionsBeforeUsing-contact" => [
                        'missing_option'	=>	[
                            //'Contact Types'			=>	'contact_type-json'
                        ]
    ],
    "moduleTable-contact" => [
                        "cyp_term",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "cyp_upload",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_contact"
    ],
    "defaultColumns-contact" => [
                        'entry'				=>	['contact_id', 'contact_name', 'phone_number', 'group_name', 'tags', 'status'],
                        'list'				=>	['contact_id', 'contact_name', 'phone_number', 'group_name', 'tags', 'status'],
                        'detail'			=>	['contact_id', 'contact_name', 'phone_number', 'group_name', 'tags', 'status'],
                        'report'			=>	['contact_id', 'contact_name', 'phone_number', 'group_name', 'tags', 'status'],
                        'sample_export'		=>	['sno', 'contact_name', 'phone_number', 'email_id', 'next_date'],
                        'selected_columns'	=>	['contact_name', 'phone_number','email_id']
    ],
    "interactiveEntity-contact" => ['contact'],

    "mandatoryFields-contact_entry_update" => ['contact_name','phone_number'],

    "dateFields-contact_entry_update" => ['dob','next_date'],

    "duplicacyCheckFields-contact_entry_new" => ['phone_number'],

    "listFilters-contact_list" => [
                        "admin"	=>	[
                             'sort' 		=> "Contact Type/contact_type/business_type-json",
                            'state' 	=> "State/state/indian_state-json",
                            'nextdate' 	=> "Next Date/range-next_date/filter_date_range-json",
                            'status' 	=> "Status/status/contact_status-json"
                        ],
                        "portal" => [
                             'sort' 		=> "Contact Type/contact_type/business_type-json",
                            'state' 	=> "State/state/indian_state-json",
                            'nextdate' 	=> "Next Date/range-next_date/filter_date_range-json",
                            'status' 	=> "Status/status/contact_status-json"
                        ]
    ],
    "listFilters-contact_detail_update" => [
                        'admin'	=>	array(
                            $pg			=>	[
                                'Profile'		=>	"{$pg}/profile",
                                'Edit'			=>	"{$pg}/entry/update",
                                'Upload'		=>	"{$pg}/upload",
                                'View Details'	=>	"{$pg}/detail",
                                'View History'	=>	"{$pg}/history",
                                'Download Docs'	=>	\Route::get_endpoint_zip_download( $pg ),
                            ]
                        )
    ],
    "listFilters-contact_contact-report_new" => [
                        "admin"	=>	[
                            'report_type_filter'	=> "Report Type/report_type/contact_type-json",
                            'status_filter'			=> "Status/status/contact_status-json"
                        ],
                        "portal" => [
                            'report_type_filter'	=> "Report Type/report_type/contact_type-json",
                            'status_filter'			=> "Status/status/contact_status-json"
                        ]
    ],
    "permissionAdmin-contact" => [
                        'restricted'=>	[
                            '2'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']],
                            '3'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']]
                        ],
                        'allowed'	=>	[]
    ],
    "permissionRestrictedAdmin-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'settings']
    ],
    "permissionPortal-contact" => [
                        'restricted'	=>	[],
                        'allowed'		=>	[
                            ['pg' => $pg, 'sub_pg'	=>	'home'],
                            ['pg' => $pg, 'sub_pg'	=>	'profile'],
                            ['pg' => $pg, 'sub_pg'	=>	'document'],
                            ['pg' => $pg, 'sub_pg'	=>	'history'],
                        ]
    ],
    "permissionAllowedPortal-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'home'],
                        ['pg' => $pg, 'sub_pg'	=>	'profile'],
                        ['pg' => $pg, 'sub_pg'	=>	'document'],
                        ['pg' => $pg, 'sub_pg'	=>	'history'],
    ],
    "permissionAllowedFiltersPortal-contact" => [
                        "profile"	=>	[[ "contact_id"	=>	'{$login_id}' ]],
                        "list"		=>	[[ "contact_id"	=>	'{$login_id}' ]],
                        "report"	=>	[[ "contact_id"	=>	'{$login_id}' ]]
    ],
    "formPrefills-contact_entry_new" => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
    ],
    "contact_search_column-json" => ["contact_name","phone_number"],

    'contact_group_results_by-json' => [
                        'contact_type'						=>	'CUSTOMER TYPE',
                        'status'							=>	'STATUS'
    ],
    'contact_sort_results_by-json' => [
                        'contact_name'						=>	'CUSTOMER NAME',
                        'contact_id'						=>	'id'
    ],
    'contact_group_results_display_type-json' => [
                        'complete_list'						=>	'COMPLETE LIST'
    ],
    "contact_bulk_operation-list" => [
                        "view:detail"	=>	"View Contact Details",
                        "op:remove"		=>	"Delete",
                        "op:restore"	=>	"Restore"
    ]

];

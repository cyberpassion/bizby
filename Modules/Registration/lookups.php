<?php
$pg = 'registration';
$commonSettingsRoute = '/settings';

return [

'sidebar-menu' => [
    [
        'title' => ucfirst($pg),
        'href'  => "/{$pg}",
        'items' => [
            ['title' => 'Home',      'href' => "/module/{$pg}/home"],
            ['title' => 'Add New',   'href' => "/module/{$pg}/new"],
            ['title' => 'View List', 'href' => "/module/{$pg}/list"],
            ['title' => 'Report',    'href' => "/module/{$pg}/report"],
            ['title' => 'Settings',  'href' => "/module/{$pg}/settings"],
            [
                'title' => 'Plugin',
                'items' => [
                    ['title' => 'View Calendar', 'href' => "/plugin/calendar?module={$pg}"],
                ]
            ],
        ],
    ],
],
    "registration.crons" => ['registration-notification' => 'Registration Notification'],
    "registration.list-filters" => [
                        "admin"	=>	[
                            'date_filter' => "Date/date/registration_date-json",
                               'registration_type_filter' => "Type/type/registration_type-json",
                            'registration_status_filter' => "Status/status/status-json"
                        ],
                        "portal" => [
                            'date_filter' => "Date/date/registration_date-json",
                            'registration_type_filter' => "Type/type/registration_type-json",
                               'registration_status_filter' => "Status/status/status-json"
                        ]
	],
    "registration.bulk-operations" => [
                        "registration:detail"	=>	"Move to",
                        "view:detail"			=>	"View Detail",
                        "op:remove"				=>	"Delete",
                        "op:restore"			=>	"Restore"
	],




	"communicationTemplate-registration" => [
                        "registration_entry_new_sms"		=>	"New Registration Entry SMS",
                        "registration_entry_new_whatsapp"	=>	"New Registration Entry Whatsapp",
                        "registration_entry_new_email"		=>	"New Registration Entry Email",
	],
	"columnNameMapping-registration" => [
		                "registration_entry_new_sms"		=>	"New Registration Entry SMS",
                        "registration_entry_new_whatsapp"	=>	"New Registration Entry Whatsapp",
                        "registration_entry_new_email"		=>	"New Registration Entry Email",
	],
	"mandatoryOptionsBeforeUsing-registration" => [
                        'missing_option'	=>	[
                            'Registration Type'	=>	'registration_type-json'
                        ]
	],
	"jsonOption-registration" => [
                        'registration_type-json'	=>	'Registration Type'
	],
	"moduleTable-registration" => [
                        "terms",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "uploads",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_registration"
	],
	"defaultColumns-registration" => [
		                'entry'				=>	['date', 'name', 'phone_number', 'email_id', 'permanent_address', 'registration_type','tags', 'status'],
                        'list'				=>	['date', 'name', 'phone_number', 'email_id', 'permanent_address', 'registration_type','tags', 'status'],
                        'detail'			=>	['date', 'name', 'phone_number', 'email_id', 'permanent_address', 'registration_type','tags', 'status'],
                        'report'			=>	['date', 'name', 'phone_number', 'email_id', 'permanent_address', 'registration_type','tags', 'status'],
                        'sample_export'		=>	['sno', 'date', 'name', 'phone_number', 'email_id', 'permanent_address'],
                        'selected_columns'	=>	['date', 'name', 'phone_number', 'email_id', 'permanent_address', 'registration_type']
	],
	"interactiveEntity-registration" => ['registration'],

	"mandatoryFields-registration-entry-update" => ['name','phone_number'],

	"dateFields-registration-public-entry-update" => ['date','dob'],

	"listFilters-registration-fee-entry" =>  [
                        "admin"	=>	[],
                        "portal" =>	[
                            $pg			=>	[
                                //'View'					=>	"{$pg}/registration-slip",
                                'Download Slip'			=>	"{$pg}/registration-slip&futher=download",
                            ]
                        ]
	],
	"permissionAdmin-registration" => [
                        'restricted'=>	[
                            '2'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']],
                            '3'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']]
                        ],
                        'allowed'	=>	[]
    ],
	"permissionRestrictedAdmin-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'settings']
	],
	"permissionPortal-registration" => [
                        'restricted'	=>	[],
                        'allowed'		=>	[
                            ['pg' => $pg, 'sub_pg'	=>	'home'],
                            ['pg' => $pg, 'sub_pg'	=>	'profile'],
                            ['pg' => $pg, 'sub_pg'	=>	'list'],
                            ['pg' => $pg, 'sub_pg'	=>	'detail'],
                            ['pg' => $pg, 'sub_pg'	=>	'document'],
                            ['pg' => $pg, 'sub_pg'	=>	'history'],
                            ['pg' => $pg, 'sub_pg'	=>	'upload'],
                            ['pg' => $pg, 'sub_pg'	=>	'report'],
                            ['pg' => $pg, 'sub_pg'	=>	"{$pg}-report"], // logic is different in portal_page_access_barricade
                        ]
	],
	"permissionAllowedPortal-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'home'],
                        ['pg' => $pg, 'sub_pg'	=>	'profile'],
                        ['pg' => $pg, 'sub_pg'	=>	'list'],
                        ['pg' => $pg, 'sub_pg'	=>	'detail'],
                        ['pg' => $pg, 'sub_pg'	=>	'document'],
                        ['pg' => $pg, 'sub_pg'	=>	'history'],
                        ['pg' => $pg, 'sub_pg'	=>	'upload'],
                        ['pg' => $pg, 'sub_pg'	=>	'report'],
                        ['pg' => $pg, 'sub_pg'	=>	"{$pg}-report"], // logic is different in portal_page_access_barricade
	],
	"permissionAllowedFiltersPortal-registration" => [
                        "profile"=>	[[ "phone_number" => '{$phone_number}' ]],
                        "list"   => [[ "phone_number" => '{$phone_number}' ]],
                        "report" => [[ "phone_number" => '{$phone_number}' ]]
	],
	"formPrefills-registration-entry-new" => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
	],
	"registration-document" => [
                        'registration-slip'		=>	'Registration Slip',
                        'registration-form'		=>	'Registration Form'
	],
	"public-registration-status" => ["1"=>"ACTIVE","11"=>"PENDING APPROVAL"],

	"public-registration-flow" => [
                        "default"	=>	"Default"
	],

];

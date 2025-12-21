<?php
$pg = 'signup';
$commonSettingsRoute = '/settings';

return [
	'menuItem-signup' => [
    'admin' => [
        'parent' => [
            $pg => '#',
        ],
        'child' => [
            $pg => [
                ['Add New'   => "/{$pg}/create"],
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
            ['title' => 'Home',      'href' => "/module/{$pg}/home"],
            ['title' => 'Add New',   'href' => "/module/{$pg}/new"],
            ['title' => 'View List', 'href' => "/module/{$pg}/list"],
            ['title' => 'Report',    'href' => "/module/{$pg}/report"],
            ['title' => 'Settings',  'href' => "/module/{$pg}/settings"],
            [
                'title' => 'Plugin',
                'items' => [
                    ['title' => 'View Calendar', 'href' => "/{$pg}/calendar"],
                ]
            ],
        ],
    ],
],
    'communicationTemplate-signup' => [
						"signup_entry_new_sms"		=>	"New Signup Entry SMS",
						"signup_entry_new_whatsapp"	=>	"New Signup Entry Whatsapp",
						"signup_entry_new_email"	=>	"New Signup Entry Email",
    ],
    'columnNameMapping-signup' => [
                        'ptr'			=>	'SNo',
						'date'			=>	'Date',
						'signup_id'		=>	'ID',
						'signup_label'	=>	'Form',
						'signup_info'	=>	'Info',
						'phone_number'	=>	'Phone',
						'payment_status'=>	'Payment',
						'entry_source'	=>	'Source',
						'form_id'		=>	'ID',
						'form_name'		=>	'Name',
						'form_fee'		=>	'Fee',
						'form_detail'	=>	'Detail'
    ],
    'mandatoryOptionsBeforeUsing-signup' => [
					'missing_option'	=>	[]
    ],
    'moduleTable-signup' => [
					"cyp_term",
					"cyp_activity",
					"cyp_advancedinfo",
					"cyp_allotment",
					"cyp_cash",
					"cyp_option",
					"cyp_upload",
					"cyp_notification",
					"cyp_message",
					"cyp_signup",
					"cyp_signup_config",
					"cyp_notification"
    ],
    'defaultColumns-signup' => [
                    'entry'				=>	['signup_id', 'name', 'phone_number', 'signup_label', 'signup_info', 'payment_status','tags', 'status'],
					'list'				=>	['signup_id', 'name', 'phone_number', 'signup_label', 'signup_info', 'payment_status','tags', 'status'],
					'detail'			=>	['signup_id', 'name', 'phone_number', 'signup_label', 'signup_info', 'payment_status','tags', 'status'],
					'report'			=>	['signup_id', 'name', 'phone_number', 'signup_label', 'signup_info', 'payment_status','tags', 'status'],
					'sample_export'		=>	['sno', 'name', 'phone_number', 'signup_label', 'signup_info', 'payment_status'],
					'selected_columns'	=>	['name', 'phone_number', 'signup_label', 'signup_info', 'payment_status']
    ],
    'mandatoryFields-signup_entry_update' => ['module','signup_official_name','signup_official_address','signup_official_email','signup_official_phone','send_notification_message'],

    'dateFields-signup_entry_update' => [],

    'additionalFields-signup_entry_update' => [],

    'signup_bulk_operation-list' => [
					"view:detail"		=>	"View Detail",
					"op:remove"			=>	"Delete",
					"op:restore"			=>	"Restore"
    ] 
];

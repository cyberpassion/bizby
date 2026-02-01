<?php
$pg = 'signup';
$commonSettingsRoute = '/settings';

return [

'sidebar-menu' => [
    [
        'title'      => ucfirst($pg),
        'href'       => "/{$pg}",
        'permission' => "{$pg}.access",
        'items'      => [

            /* Dashboard */
            [
                'title'      => 'Dashboard',
                'href'       => "/module/{$pg}/home",
                'permission' => "{$pg}.dashboard.view",
            ],

            /* Signup Management */
            [
                'title' => 'Signups',
                'items' => [
                    [
                        'title'      => 'Add New',
                        'href'       => "/module/{$pg}/new",
                        'permission' => "{$pg}.signup.create",
                    ],
                    [
                        'title'      => 'View List',
                        'href'       => "/module/{$pg}/list",
                        'permission' => "{$pg}.signup.view",
                    ],
                ],
            ],

            /* Reports */
            [
                'title' => 'Reports',
                'items' => [
                    [
                        'title'      => 'Signup Report',
                        'href'       => "/module/{$pg}/report",
                        'permission' => "{$pg}.report.signup",
                    ],
                ],
            ],

            /* Settings */
            [
                'title'      => 'Settings',
                'href'       => "/module/{$pg}/settings",
                'permission' => "{$pg}.settings.manage",
            ],

            /* Plugins */
            [
                'title' => 'Plugins',
                'items' => [
                    [
                        'title'      => 'View Calendar',
                        'href'       => "/plugin/calendar?module={$pg}",
                        'permission' => "{$pg}.plugin.manage",
                    ],
                ],
            ],
        ],
    ],
],


    'signup.bulk-operations' => [
					"view:detail"		=>	"View Detail",
					"op:remove"			=>	"Delete",
					"op:restore"			=>	"Restore"
	],
	'signup.default-columns' => [
                    'entry'				=>	['signup_id', 'name', 'phone_number', 'signup_label', 'signup_info', 'payment_status','tags', 'status'],
					'list'				=>	['signup_id', 'name', 'phone_number', 'signup_label', 'signup_info', 'payment_status','tags', 'status'],
					'detail'			=>	['signup_id', 'name', 'phone_number', 'signup_label', 'signup_info', 'payment_status','tags', 'status'],
					'report'			=>	['signup_id', 'name', 'phone_number', 'signup_label', 'signup_info', 'payment_status','tags', 'status'],
					'sample_export'		=>	['sno', 'name', 'phone_number', 'signup_label', 'signup_info', 'payment_status'],
					'selected_columns'	=>	['name', 'phone_number', 'signup_label', 'signup_info', 'payment_status']
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
    'mandatoryFields-signup-entry-update' => ['module','signup_official_name','signup_official_address','signup_official_email','signup_official_phone','send_notification_message'],

    'dateFields-signup-entry-update' => [],

    'additionalFields-signup-entry-update' => [],
 
];

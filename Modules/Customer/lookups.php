<?php
$pg = 'customer';
$commonSettingsRoute = '/settings';

return [

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
                    ['title' => 'View Calendar', 'href' => "/plugin/calendar?module={$pg}"],
                ]
            ],
        ],
    ],
],
    "customer.crons" => [
		                'customer-due_date' 	=> 'Customer Due Date',
                        'customer-birthday' 	=> 'Customer Birthday Message'
	],
    "customer.bulk-operations" => [
                        "view:detail"	=>	"View Customer Details",
                        "op:remove"		=>	"Delete",
                        "op:restore"	=>	"Restore"
    ],
    "customer.default-columns" => [
		                'entry'				=>	['customer_id', 'customer_name', 'phone_number', 'remark', 'additional_information', 'additional_contacts', 'next_date','status'],
                        'list'				=>	['customer_id', 'customer_name', 'phone_number', 'remark', 'additional_information', 'additional_contacts', 'next_date','status'],
                        'detail'				=>	['customer_id', 'customer_name', 'phone_number', 'remark', 'additional_information', 'additional_contacts', 'next_date','status'],
                        'report'				=>	['customer_id', 'customer_name', 'phone_number', 'remark', 'additional_information', 'additional_contacts', 'next_date','status'],
                        'sample_export'		=>	['sno', 'customer_name', 'phone_number', 'email_id', 'remark', 'next_date'],
                        'selected_columns'	=>	['customer_name', 'phone_number','email_id', 'remark', 'additional_information', 'additional_contacts', 'next_date']
	],
    "customer.permission-allowed-filters-portal" => [
                        "profile"	=>	[[ "customer_id"	=>	'{$login_id}' ]],
                        "list"		=>	[[ "customer_id"	=>	'{$login_id}' ]],
                        "report"	=>	[[ "customer_id"	=>	'{$login_id}' ]]
    ],
    'customer.list-columns' => [
                        'id',
                        'name',
                        'phone',
                        'customer_type',
                        'business_type',
                        'status',
    ],

    'customer.list-filters' => [
                        'name',
                        'phone',
                        'customer_type',
                        'business_type',
                        'status',
    ],

    'customer.report-columns' => [
                        'id',
                        'name',
                        'customer_type',
                        'business_type',
                        'phone',
                        'email',
                        'state',
                        'status',
    ],


    
	"communicationTemplate-customer" => [
                        "customer_entry_new_sms"				=>	"New Customer Entry SMS",
                        "customer_entry_new_whatsapp"			=>	"New Customer Entry Whatsapp",
                        "customer_entry_new_email"				=>	"New Customer Entry Email",
                        "customer_next_date_reminder_sms"		=>	"Customer Next Date Reminder SMS",
                        "customer_next_date_reminder_whatsapp"	=>	"Customer Next Date Reminder Whatsapp",
                        "customer_next_date_reminder_email"		=>	"Customer Next Date Reminder Email",
                        "customer_birthday_new_sms"				=>	"Customer Birthday SMS",
                        "customer_birthday_new_whatsapp"		=>	"Customer Birthday Whatsapp",
                        "customer_birthday_new_email"			=>	"Customer Birthday Email",
    ],
	"columnNameMapping-customer" => [
		                'customer_id'		=>	'ID',
                        'customer_name'		=>	'Name',
                        'customer_type'		=>	'Type',
                        'additional_contacts'=>	'Contacts',
                        'additional_information'=>	'Information',
                        'next_date'			=>	'Next Date'
  	],
	"moduleTable-customer" => [
                        "terms",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "uploads",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_customer"
    ],
	'customer-group-results-by' => [
		                'customer_type'						=>	'CUSTOMER TYPE',
                        'status'							=>	'STATUS'
	],
	'customer-sort-results-by' => [
		                'customer_name'						=>	'CUSTOMER NAME',
                        'customer_id'						=>	'id'
	],
	'customer-group-results-display-type' => [
		                'complete_list'						=>	'COMPLETE LIST'
	],

];

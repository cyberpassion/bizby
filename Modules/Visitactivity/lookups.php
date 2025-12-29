<?php
$pg = 'visitactivity';
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
	'visitactivity.list-filters' => [
                        "admin"	=>	[
                            'visitactivity_visitby_filter' 	=> "Visit By/visit_by_id/employee_id-json",
                            'visitactivity_date_filter' 	=> "Date/visit_date/visitactivity_date-json",
                            'visitactivity_status_filter' 	=> "Status/status/visitactivity_status-json"
                        ],
                        "portal" => [
                            'visitactivity_visitby_filter' => "Visit By/visit_by_id/employee_id-json",
                            'visitactivity_date_filter' 	=> "Date/visit_date/visitactivity_date-json",
                            'visitactivity_status_filter' 	=> "Status/status/visitactivity_status-json"
                        ]
    ],
    'visitplanner.bulk-operations' => [
                        "view:detail"			=>	"View Visit Activity Details",
                        "send:email"			=>	"Send Notification Email",
                        "op:remove"				=>	"Delete",
                        "op:restore"			=>	"Restore"
	],
    'visitactivity.default-columns' => [
                        'entry'				=>	['visitactivity_id', 'visit_date', 'visit_by_name', 'visit_team_member_json', 'company_name', 'company_official_mobile_number', 'detailed_report', 'next_action_plan', 'visit_status','tags', 'status'],
                        'list'				=>	['visitactivity_id', 'visit_date', 'visit_by_name', 'visit_team_member_json', 'company_name', 'company_official_mobile_number', 'detailed_report', 'next_action_plan', 'visit_status','tags', 'status'],
                        'detail'			=>	['visitactivity_id', 'visit_date', 'visit_by_name', 'visit_team_member_json', 'company_name', 'company_official_mobile_number', 'detailed_report', 'next_action_plan', 'visit_status','tags', 'status'],
                        'report'			=>	['visitactivity_id', 'visit_date', 'visit_by_name', 'visit_team_member_json', 'company_name', 'company_official_mobile_number', 'detailed_report', 'next_action_plan', 'visit_status','tags', 'status'],
                        'sample_export'		=>	['sno', 'visit_date', 'visit_by_name', 'visit_team_member_json', 'company_name', 'company_official_mobile_number', 'detailed_report', 'next_action_plan', 'visit_status'],
                        'selected_columns'	=>	['visit_date', 'visit_by_name', 'visit_team_member_json', 'company_name', 'company_official_mobile_number', 'detailed_report', 'next_action_plan', 'visit_status']
    ],
    'visitactivity.statuses' => [
                        1	=>	'Submitted',
                        11	=>	'Autosaved',
                        2	=>	'Deleted'
    ],
    'visitactivity.list-columns' => [
                       'visit_date',
                       'visit_by',
                       'company_name',
                       'visit_status',
                       'total_expense_amount',
	],

    'visitactivity.list-filters' => [
                       'visit_date',
                       'visit_by',
                       'company_name',
                       'visit_status',
                       'visit_region',
	],

    'visitactivity.report-columns' => [
                       'visit_date',
                       'visit_by',
                       'company_name',
                       'company_official_name',
                       'company_official_email',
                       'company_official_mobile_number',
                       'visit_status',
                       'reason_for_dissatisfaction',
                       'products_discussed',
                       'detailed_report',
                       'next_action_plan',
                       'total_expense_amount',
	],

	'visitactivity.visit-statuses' => [
                        '0'		=>	'Select',
                        '1'		=>	'Visit Done',
                        '2'		=>	'Cancelled',
                        '11'	=>	'Postponed by Client',
                        '12'	=>	'Postponed by Office'
    ],
    'visitactivity.customer-statuses' => [
                        "new-customer"			=>	"New Customer",
                        "old-customer"			=>	"Old Customer",
                        "dissatisfied-customer"	=>	"Dissatisfied Customer",
                        "biased-customer"		=>	"Biased Customer"
    ],



    'communicationTemplate-visitactivity' => [
                        "visitactivity_entry_new_sms"		=>	"New Visitactivity Entry SMS",
                        "visitactivity_entry_new_whatsapp"	=>	"New Visitactivity Entry Whatsapp",
                        "visitactivity_entry_new_email"		=>	"New Visitactivity Entry Email",
    ],
    'columnNameMapping-visitactivity' => [
                        'ptr'								=>	'SNo',
                        'visit_date'						=>	'Date',
                        'visitactivity_id'					=>	'ID',
                        'visit_by_name'						=>	'Name',
                        'visit_team_member_json'			=>	'Team Members',
                        'company_name'						=>	'Company',
                        'company_address'					=>	'Address',
                        'company_city'						=>	'City',
                        'company_state'						=>	'State',
                        'company_official_name'				=>	'Person Name',
                        'company_official_mobile_number'	=>	'Mobile',
                        'detailed_report'					=>	'Report',
                        'next_action_plan'					=>	'Next Plan',
                        'visit_status'						=>	'V/Status',
                        'options'							=>	'Options'
    ],
    'mandatoryOptionsBeforeUsing-visitactivity' => [
                        'missing_option'	=>	[
                            'Email IDs to send VAR Email (Mandatorily)'			=>	'visitactivity_default_email_recipient',
                        ]
    ],
    'moduleTable-visitactivity' => [
                        "cyp_term",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "cyp_upload",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_visitactivity"
    ],
    'mandatoryFields-visitactivity-entry-update' => ['movement_from','company_official_mobile_number','company_address'],

    'dateFields-visitactivity-entry-update' => ['visit_date','next_visit_date'],

    'additionalFields-visitactivity-entry-update' => [],

    'jsonFields-visitactivity-entry-update' => [
                        'visit_team_member_json',
                        'detailed_report',
                        'next_action_plan',
                        'visit_product',
                        'products_discussed',
                        'email_to',
                        'competitors'
    ],
    'formPrefills-visitactivity-entry-new' => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
    ],
    'sort-visitactivity-results-by-list' => [
                        'datetime'		=>	"Date & Time",
                        'total_expense'	=>	"Total Expense"
    ],

];
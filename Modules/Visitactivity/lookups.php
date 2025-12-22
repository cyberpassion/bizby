<?php
$pg = 'visitactivity';
$commonSettingsRoute = '/settings';

return [
	'menuItem-visitactivity' => [
    'admin' => [
        'parent' => [
            $pg => '#',
        ],
        'child' => [
            $pg => [
                ['Add New'   => "/{$pg}/new"],
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
                    ['title' => 'View Calendar', 'href' => "/plugin/calendar?module={$pg}"],
                ]
            ],
        ],
    ],
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
    'defaultColumns-visitactivity' => [
                        'entry'				=>	['visitactivity_id', 'visit_date', 'visit_by_name', 'visit_team_member_json', 'company_name', 'company_official_mobile_number', 'detailed_report', 'next_action_plan', 'visit_status','tags', 'status'],
                        'list'				=>	['visitactivity_id', 'visit_date', 'visit_by_name', 'visit_team_member_json', 'company_name', 'company_official_mobile_number', 'detailed_report', 'next_action_plan', 'visit_status','tags', 'status'],
                        'detail'			=>	['visitactivity_id', 'visit_date', 'visit_by_name', 'visit_team_member_json', 'company_name', 'company_official_mobile_number', 'detailed_report', 'next_action_plan', 'visit_status','tags', 'status'],
                        'report'			=>	['visitactivity_id', 'visit_date', 'visit_by_name', 'visit_team_member_json', 'company_name', 'company_official_mobile_number', 'detailed_report', 'next_action_plan', 'visit_status','tags', 'status'],
                        'sample_export'		=>	['sno', 'visit_date', 'visit_by_name', 'visit_team_member_json', 'company_name', 'company_official_mobile_number', 'detailed_report', 'next_action_plan', 'visit_status'],
                        'selected_columns'	=>	['visit_date', 'visit_by_name', 'visit_team_member_json', 'company_name', 'company_official_mobile_number', 'detailed_report', 'next_action_plan', 'visit_status']
    ],
    'mandatoryFields-visitactivity_entry_update' => ['movement_from','company_official_mobile_number','company_address'],

    'dateFields-visitactivity_entry_update' => ['visit_date','next_visit_date'],

    'additionalFields-visitactivity_entry_update' => [],

    'jsonFields-visitactivity_entry_update' => [
                        'visit_team_member_json',
                        'detailed_report',
                        'next_action_plan',
                        'visit_product',
                        'products_discussed',
                        'email_to',
                        'competitors'
    ],
    'listFilters-visitactivity_list' => [
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
    'formPrefills-visitactivity_entry_new' => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
    ],
    'visitactivity_visit_status-json' => [
                        '0'		=>	'Select',
                        '1'		=>	'Visit Done',
                        '2'		=>	'Cancelled',
                        '11'	=>	'Postponed by Client',
                        '12'	=>	'Postponed by Office'
    ],
    'visitactivity_customer_type-json' => [
                        "new-customer"			=>	"New Customer",
                        "old-customer"			=>	"Old Customer",
                        "dissatisfied-customer"	=>	"Dissatisfied Customer",
                        "biased-customer"		=>	"Biased Customer"
    ],
    'sort_visitactivity_results_by-list' => [
                        'datetime'		=>	"Date & Time",
                        'total_expense'	=>	"Total Expense"
    ],
    'visitactivity_status-json' => [
                        1	=>	'Submitted',
                        11	=>	'Autosaved',
                        2	=>	'Deleted'
    ],
    'visitactivity_bulk_operation-list' => [
                        "view:detail"			=>	"View Visit Activity Details",
                        "send:email"			=>	"Send Notification Email",
                        "op:remove"				=>	"Delete",
                        "op:restore"			=>	"Restore"
    ]

];
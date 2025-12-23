<?php
$pg = 'visitplanner';
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
'visitplanner.visitactivity-generation-status' => [
                        'all'	=>	"All",
                        '1'		=>	"VAR Generated",
                        '2'		=>	"Pending VAR"
    ],
'visitplanner.week-name' => ["week-1","week-2","week-3","week-4","week-5"],
'visitplanner.bulk-operations' => [
                        "view:detail"		=>	"View Visit Planner Details",
                        "send:email"		=>	"Send Email",
                        "send:sms"			=>	"Send SMS",
                        "op:remove"			=>	"Delete",
                        "op:restore"		=>	"Restore"
],
'visitplanner.crons' => ['visitplanner-scheduledvisits' => 'Scheduled Visits'],
'visitplanner.list-filters' => [
                        "admin"	=>	[
                            'visitplanner_session_filter' => "Session/session/session-json",
                            'visitplanner_employee_filter' => "Employee/visit_by_id/employee_id-json",
                            'visitplanner_month_filter' => "Month/month/month-json",
                            'visitplanner_week_filter' => "Week/week/visitplanner_week-json",
                            'visitplanner_status_filter' => "Status/status/status-json"
                        ],
                        "portal" => [
                            'visitplanner_session_filter' => "Session/session/session-json",
                            'visitplanner_employee_filter' => "Employee/visit_by_id/employee_id-json",
                            'visitplanner_month_filter' => "Month/month/month-json",
                            'visitplanner_week_filter' => "Week/week/visitplanner_week-json",
                            'visitplanner_status_filter' => "Status/status/status-json"
                        ]
    ],



    'communicationTemplate-visitplanner' => [
                        "visitplanner_entry_new_sms"				=>	"New Visitplanner Entry SMS",
                        "visitplanner_entry_new_whatsapp"			=>	"New Visitplanner Entry Whatsapp",
                        "visitplanner_entry_new_email"				=>	"New Visitplanner Entry Email",
                        "visitplanner_scheduledvisits_new_sms"		=>	"New Visitplanner Scheduled Visits SMS",
                        "visitplanner_scheduledvisits_new_whatsapp"	=>	"New Visitplanner Scheduled Visits Whatsapp",
                        "visitplanner_scheduledvisits_new_email"	=>	"New Visitplanner Scheduled Visits Email"
    ],
    'columnNameMapping-visitplanner' => [
                        'visitplanner_id'	=>	'VID',
                        'visit_by_name'		=>	'Name',
                        'visit_date'		=>	'V/Date',
                        'visit_time'		=>	'Time',
                        'visit_company'		=>	'Company',
                        'session'			=>	'Session',
                        'month'				=>	'Month',
                        'week'				=>	'Week',
                        'created_by_name'	=>	'Created By',
                        'visit_address'		=>	'Address',
                        'visit_count'		=>	'V/Count',
                        'visit_expectation'	=>	'Expectation',
                        'visit_product'		=>	'Products'
    ],
    'mandatoryOptionsBeforeUsing-visitplanner' => [
                        'missing_option'	=>	[]
    ],
    'moduleTable-visitplanner' => [
                        "cyp_term",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "cyp_upload",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_visitplanner"
    ],
    'defaultColumns-visitplanner' => [
                        'entry'				=>	['ID','visitplanner_id','visit_company','visit_by_name', 'month', 'week', 'created_by_name','tags', 'status'],
                        'list'				=>	['ID','visitplanner_id','visit_company','visit_by_name', 'month', 'week', 'created_by_name','tags', 'status'],
                        'detail'			=>	['ID','visitplanner_id','visit_company','visit_by_name', 'month', 'week', 'created_by_name','tags', 'status'],
                        'report'			=>	['ID','visitplanner_id','visit_company','visit_by_name', 'month', 'week', 'created_by_name','tags', 'status'],
                        'sample_export'		=>	['sno', 'visit_company', 'visit_meetingwith', 'visit_mobile_number', 'visit_email', 'session', 'month', 'week'],
                        'selected_columns'	=>	['visitplanner_id','visit_company','visit_by_name', 'session', 'month', 'week', 'created_by_name']
    ],

    'mandatoryFields-visitplanner-entry-update' => ['visit_company', 'visit_meetingwith', 'visit_mobile_number', 'visit_email', 'session', 'month', 'week'],

    'dateFields-visitplanner-entry-update' => ['date','visit_date'],

    'additionalFields-visitplanner-entry-update' => [],

    'jsonFields-visitplanner-entry-update' => ['visit_team_member_json','visit_product'],

    'permissionAllowedFiltersPortal-visitplanner' => [
                        "entry"  => [[ "visit_by_type" => '{$login_type}', "visit_by_id" => '{$login_id}' ]],
                        "list"   => [[ "visit_by_type" => '{$login_type}', "visit_by_id" => '{$login_id}' ]],
                        "report" => [[ "visit_by_type" => '{$login_type}', "visit_by_id" => '{$login_id}' ]]
    ],
    'formPrefills-visitplanner-entry-new' => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
    ],
    'visitplanner-expectation' => [
                        "high"		=>	"High",
                        "average"	=>	"Average",
                        "low"		=>	"Low"
    ],
    'visitplanner-status' => [
                        "1"		=>	"Active",
                        "11"	=>	"Postponed",
                        "2"		=>	"Deleted",
                        "21"	=>	"Cancelled"
    ],
    

    'sort-visitplanner-results-by-list' => [
                        'datetime'			=>	"Date & Time",
                        'expectedexpense'	=>	"Expected Expense"
    ],

];
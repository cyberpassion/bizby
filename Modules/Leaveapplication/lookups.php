<?php
$pg = 'leaveapplication';
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

    'leaveapplication.leave-type' => [
                        'casual-leave'		=>	'Casual Leave',
                        'sick-leave'		=>	'Sick Leave',
                        'medical-leave'		=>	'Medical Leave',
                        'maternity-leave'	=>	'Maternity Leave',
                        'paternity-leave'	=>	'Paternity Leave'
    ],
    'leaveapplication.crons' => [
        'leaveapplication-notificationtohr'=>'Leave Application Notification to HR'
    ],
    'leaveapplication.list-filters' => [
                        "admin"	=>	[
                            'session_filter' => 'Session/current_session/session-json',
                            'month_filter' => 'Month/month/month-json',
                            'interval_filter' => 'Interval/leave_days/leave_days-list',
                            'leave_reason_filter' => 'Date/leave_date/leave_reason_type-list',
                            'status_filter' => 'Status/status/leaveapplication_status-json',
    
                        ],
                        "portal" => [
                            'session_filter' => 'Session/current_session/session-json',
                            'month_filter' => 'Month/month/month-json',
                            'interval_filter' => 'Interval/leave_days/leave_days-list',
                            'leave_reason_filter' => 'Date/leave_date/leave_reason_type-list',
                            'status_filter' => 'Status/status/leaveapplication_status-json',
                        ]
    ],
    'leaveapplication.bulk-operations' => [
                        "view:detail"		=>	"View Detail",
                        "op:remove"			=>	"Delete",
                        "op:restore"			=>	"Restore"
    ],
    'leaveapplication.default-columns' => [
                        'entry'				=>	['leaveapplication_id', 'date','applicant_name','leave_all_dats','leave_type','tags', 'status'],
                        'list'				=>	['leaveapplication_id', 'date','applicant_name','leave_all_dats','leave_type','tags', 'status'],
                        'detail'			=>	['leaveapplication_id', 'date','applicant_name','leave_all_dats','leave_type','tags', 'status'],
                        'report'			=>	['leaveapplication_id', 'date','applicant_name','leave_all_dats','leave_type','tags', 'status'],
                        'sample_export'		=>	['sno', 'applicant_name', 'applicant_type', 'leave_all_dats', 'leave_duration', 'leave_reason', 'status'],
                        'selected_columns'	=>	['applicant_name', 'applicant_type', 'leave_all_dats', 'leave_duration', 'leave_reason', 'status']
    ],
    'leaveapplication.statuses' => [
                        '1'		=>	'In-Review',
                        '10'	=>	'Accepted',
                        '11'	=>	'Rejected',
                        //'12'	=>	'Not Reviewed by HR',
                        //'13'	=>	'Modified by HR',
                        //'15'	=>	'Out of Office Work',
                        '2'		=>	'Canceled by Applicant'
    ],




    
    'communicationTemplate-leaveapplication' => [
                        "leaveapplication_entry_new_sms"			=>	"New Leaveapplication Entry SMS",
                        "leaveapplication_entry_new_whatsapp"		=>	"New Leaveapplication Entry Whatsapp",
                        "leaveapplication_entry_new_email"			=>	"New Leaveapplication Entry Email",
                        "leaveapplication_tohr_entry_new_sms"		=>	"New Leaveapplication Notification to HR SMS",
                        "leaveapplication_tohr_entry_new_whatsapp"	=>	"New Leaveapplication Notification to HR Whatsapp",
                        "leaveapplication_tohr_entry_new_email"		=>	"New Leaveapplication Notification to HR Email",
                        "leaveapplication_toapplicant_new_sms"		=>	"New Leaveapplication Notification to Applicant SMS",
                        "leaveapplication_toapplicant_new_whatsapp"	=>	"New Leaveapplication Notification to Applicant Whatsapp",
                        "leaveapplication_toapplicant_new_email"	=>	"New Leaveapplication Notification to Applicant Email",
                        "leaveapplication_hrresponsetoapplicant_new_sms" => "New Leaveapplication Reply Notification to Applicant SMS",
                        "leaveapplication_hrresponsetoapplicant_new_whatsapp" => "New Leaveapplication Reply Notification to Applicant Whatsapp",
                        "leaveapplication_hrresponsetoapplicant_new_email" => "New Leaveapplication Reply Notification to Applicant Email"
    ],
    'columnNameMapping-leaveapplication' => [
                        'ptr'					=>	'SNo',
                        'date'					=>	'Date',
                        'leaveapplication_id'	=>	'ID',
                        'applicant_id'			=>	'Applicant ID',
                        'applicant_name'		=>	'Name',
                        'applicant_type'		=>	'Type',
                        'leave_dates'			=>	'Leave Dates',
                        'leave_all_dats'		=>	'Leave Dates',
                        'leave_type'			=>	'Type',
                        'leave_duration'		=>	'Days',
                        'leave_reason'			=>	'Reason',
                        'approved leaves'		=>	'Approved',
                        'rejected_leaves'		=>	'Rejected',
                        'pending_leaves'		=>	'Pending',
                        'applied_leaves'		=>	'Applied',
                        'working_days'			=>	'Working Days',
                        'status'				=>	'Status'
    ],
    'mandatoryOptionsBeforeUsing-leaveapplication' => [
                        'missing_option'	=>	[]
    ],
    'moduleTable-leaveapplication' => [
                        "cyp_term",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "cyp_upload",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_attendance",
                        "cyp_leaveapplication"
    ],
    'mandatoryFields-leaveapplication-entry-update' => [

    ],
    'dateFields-leaveapplication-entry-update' => [
        
    ],
    'additionalFields-leaveapplication-entry-update' => [

    ],
    
    'listFilters-leaveapplication-sheet-filters-entry-new' => [
                        "admin"	=>	[
                            'session_filter'	=> "Session/current_session/session-json",
                            'month_filter'		=> "Month/month/month-json",
                        ],
                        "portal" => [
                            'session_filter'	=> "Session/current_session/session-json",
                            'month_filter'		=> "Month/month/month-json",
                        ]
    ],
    'leave-day' => ["single"=>"One Day","half-day"=>"Half Day","multiple"=>"Multiple Days"],
    'leave-shift' => ["morning"=>"Morning","afternoon"=>"Afternoon"],
    'leaveapplication_report_type-list' => [
                        "singleday"				=>	"SingleDay Report",
                        "multiday"				=>	"Multiday Report"
    ],
    'leave-days-list' => ['1 day','2 days','3 days','4 days','5 days','6 days','> 7 days'],

];
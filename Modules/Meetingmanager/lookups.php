<?php
$pg = 'meetingmanager';
$commonSettingsRoute = '/settings';

return [
	'menuItem-meetingmanager' => [
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
                    ['title' => 'View Calendar', 'href' => "/module/{$pg}/calendar"],
                ]
            ],
        ],
    ],
],
    'communicationTemplate-meetingmanager' => [
                        "meetingmanager_entry_new_sms"		=>	"New Meetingmanager Entry SMS",
                        "meetingmanager_entry_new_whatsapp"	=>	"New Meetingmanager Entry Whatsapp",
                        "meetingmanager_entry_new_email"	=>	"New Meetingmanager Entry Email",
     ],
     'columnNameMapping-meetingmanager' => [
                        'meeting_id'		=>	'ID',
                        'requested_by_name'	=>	'Name',
                        'meeting_with'		=>	'Meeting With',
                        'meeting_date'		=>	'M/Date',
                        'meeting_time'		=>	'M/Time',
                        'meeting_exit_time'	=>	'Exit Time'
     ],
     'moduleTable-meetingmanager' => [
                        "cyp_term",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "cyp_upload",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_meeting"
     ],
     'defaultColumns-meetingmanager' => [
                        'entry'				=>	['meeting_id', 'requested_by_name', 'phone_number', 'meeting_with', 'meeting_date', 'meeting_time', 'meeting_exit_time', 'tags', 'status'],
                        'list'				=>	['meeting_id', 'requested_by_name', 'phone_number', 'meeting_with', 'meeting_date', 'meeting_time', 'meeting_exit_time', 'tags', 'status'],
                        'detail'				=>	['meeting_id', 'requested_by_name', 'phone_number', 'meeting_with', 'meeting_date', 'meeting_time', 'meeting_exit_time', 'tags', 'status'],
                        'report'				=>	['meeting_id', 'requested_by_name', 'phone_number', 'meeting_with', 'meeting_date', 'meeting_time', 'meeting_exit_time', 'tags', 'status'],
                        'sample_export'		=>	['sno', 'requested_by_name', 'phone_number', 'meeting_with', 'meeting_date', 'meeting_time', 'meeting_exit_time'],
                        'selected_columns'	=>	['requested_by_name', 'phone_number', 'meeting_with', 'meeting_date', 'meeting_time', 'meeting_exit_time']
     ],
     'cronList-meetingmanager' => ['meetingmanager-remindernotification' => 'Meeting Reminder'],
     'mandatoryFields-meetingmanager_entry_update' => ['requested_by_name'],

     'dateFields-meetingmanager_entry_update' => ['meeting_date','meeting_exit_date'],

     'additionalFields-meetingmanager_entry_update' => [],

     'listFilters-meetingmanager_list' => [
                        "admin"	=>	[
                             'meeting_head_filter' 	=> "Head/meeting_type/meeting_type-json",
                            'date_filter' 			=> "Date/meeting_date/meeting_date-json",
                            'meeting_with_filter' 	=> "Meeting With/meeting_with/meeting_with-list",
                            'status_filter' 		=> "Status/status/status-json"
                        ],
                        "portal" => [
                             'meeting_head_filter' 	=> "Head/meeting_type/meeting_type-json",
                            'date_filter' 			=> "Date/meeting_date/meeting_date-json",
                            'meeting_with_filter' 	=> "Meeting With/meeting_with/meeting_with-list",
                            'status_filter' 		=> "Status/status/status-json"
                        ]
    ],
    'formPrefills-meetingmanager_entry_new' => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
    ],
    'meetingmanager_document-json' => [
                        'meetingmanager-slip'		=>	'Meeting Slip'
    ],
    'meeting_priority-json' => [1,2,3,4,5],

    'meeting_manager_bulk_operation-list' => [
                        "view:detail"					=>	"Print Detail",
                        "document:slip"					=>	"Print Slip",
                        "op:remove"						=>	"Delete",
                        "op:restore"					=>	"Restore",
                        "meetingmanager:reminder-sms"	=>	"Send Reminder SMS"
    ]
];

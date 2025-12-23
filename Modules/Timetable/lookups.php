<?php
$pg = 'timetable';
$commonSettingsRoute = '/settings';

return [

'sidebar-menu' => [
    [
        'title' => ucfirst($pg),
        'href'  => "/{$pg}",
        'items' => [
            ['title' => 'Add New',     'href' => "/module/{$pg}/new"],
            ['title' => 'View List',   'href' => "/module/{$pg}/list"],
            ['title' => 'View Report', 'href' => "/module/{$pg}/report"],
            ['title' => 'Settings',    'href' => "/module/{$pg}/settings"],
            [
                'title' => 'Plugin',
                'items' => [
                    ['title' => 'View Calendar', 'href' => "/plugin/calendar?module={$pg}"],
                ]
            ],
        ],
    ],
],
     'communicationTemplate-timetable' => [
						"timetable_entry_new_sms"		=>	"New Timetable Entry SMS",
						"timetable_entry_new_whatsapp"	=>	"New Timetable Entry Whatsapp",
						"timetable_entry_new_email"		=>	"New Timetable Entry Email",
     ],
     'columnNameMapping-timetable' => [
                        'timetable_id'		=>	'ID',
						'subjects_duration'	=>	'Subjects & Duration'
     ],
     'mandatoryOptionsBeforeUsing-timetable' => [
					'missing_option'	=>	[]
     ],
     'moduleTable-timetable' => [
					"cyp_term",
					"cyp_activity",
					"cyp_advancedinfo",
					"cyp_allotment",
					"cyp_cash",
					"cyp_option",
					"cyp_upload",
					"cyp_notification",
					"cyp_message",
					"cyp_timetable"
     ],
     'defaultColumns-timetable' => [
                    'entry'				=>	['timetable_id', 'session', 'recipient', 'months', 'subjects_duration','tags', 'status'],
					'list'				=>	['timetable_id', 'session', 'recipient', 'months', 'subjects_duration','tags', 'status'],
					'detail'			=>	['timetable_id', 'session', 'recipient', 'months', 'subjects_duration','tags', 'status'],
					'report'			=>	['timetable_id', 'session', 'recipient', 'months', 'subjects_duration','tags', 'status'],
					'sample_export'		=>	['sno', 'timetable_id', 'recipient', 'session', 'months', 'subjects_duration', 'status'],
					'selected_columns'	=>	['timetable_id', 'recipient', 'session', 'months', 'subjects_duration', 'status']
     ],
     'listFilters-timetable-list' => [
					"admin"	=>	[
    					'current_session_filter' => "Session/session/session-json",
    					'current_class_filter' => "Class/class/class-json",
    					'current_section_filter' => "Section/section/section-json",
    					'status_filter' => "Status/status/status-json"
					],
					"portal" => [
    					'current_session_filter' => "Session/session/session-json",
    					'current_class_filter' => "Class/class/class-json",
						'current_section_filter' => "Section/section/section-json",
    					'status_filter' => "Status/status/status-json"
					]
    ],
    'timetable-bulk-operation-list' => [
					"view:detail"		=>	"View Detail",
					"op:remove"			=>	"Delete",
					"op:restore"		=>	"Restore"
    ],
    'formPrefills-timetable-entry-new' => [
					"columns"	=>	[
						'product'		=>	'default_product',
						'contact_mode'	=>	'default_contact_mode',
						'state'			=>	'default_indian_state'
					],
					"groups"	=>	[
						'current_date'	=>	['contact_date']
					]
    ],
    'mandatoryFields-timetable-entry-update' => ['module','timetable_official_name','timetable_official_address','timetable_official_email','timetable_official_phone','send_notification_message'],

    'dateFields-timetable-entry-update' => [],

    'additionalFields-timetable-entry-update' => []

];

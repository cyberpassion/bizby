<?php
$pg = 'note';
$commonSettingsRoute = '/settings';

return [
    'sidebar-menu' => [
        [
            'title' => ucfirst($pg),
            'href' => "/{$pg}",
            'items' => [
                ['title' => 'Home', 'href' => "/module/{$pg}/home"],
				['title' => 'Add New', 'href' => "/module/{$pg}/new"],
                ['title' => 'View List', 'href' => "/module/{$pg}/list"],
                ['title' => 'Report', 'href' => "/module/{$pg}/report"],
                ['title' => 'Settings', 'href' => "/module/{$pg}/settings"],
            ],
        ],
    ],

	"note.statuses" => [
		"1"		=>	"All",
		"11"	=>	"Pending Only",
		"12"	=>	"Resolved Only",
		"2"		=>	"Deleted"
	],

	"communicationTemplate-note" => [
                        "note_entry_new_sms"		=>	"New Note Entry SMS",
                        "note_entry_new_whatsapp"	=>	"New Note Entry Whatsapp",
                        "note_entry_new_email"		=>	"New Note Entry Email",
                        "note_reciever_new_sms"		=>	"New Note Reciever SMS",
                        "note_reciever_new_whatsapp"=>	"New Note Reciever Whatsapp",
                        "note_reciever_new_email"	=>	"New Note Reciever Email",
                        "note_sender_new_sms"		=>	"New Note Sender SMS",
                        "note_sender_new_whatsapp"	=>	"New Note Sender Whatsapp",
                        "note_sender_new_email"		=>	"New Note Sender Email",
                        "note_comment_new_sms"		=>	"New Note Comment SMS",
                        "note_comment_new_whatsapp"	=>	"New Note Comment Whatsapp",
                        "note_comment_new_email"	=>	"New Note Comment Email",
	],
	"columnNameMapping-note" => [
		                'note_id'			=>	'ID',
                        'added_by'			=>	'Name',
                        'note_type'			=>	'Type',
                        'added_for'			=>	'For',
                        'response_status'	=>	'R/Status'
	],
	"mandatoryOptionsBeforeUsing-note" => [
                        'missing_option'	=>	[
                            'Note Category'	=>	'note_type-json'
                        ]
	],
	"moduleTable-note" => [
                        "terms",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "uploads",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_note"
	],
	"defaultColumns-note" => [
		                'entry'				=>	['note_id', 'added_by', 'subject', 'note_type', 'added_for', 'response_status','tags', 'status'],
                        'list'				=>	['note_id', 'added_by', 'subject', 'note_type', 'added_for', 'response_status','tags', 'status'],
                        'detail'			=>	['note_id', 'added_by', 'subject', 'note_type', 'added_for', 'response_status','tags', 'status'],
                        'report'			=>	['note_id', 'added_by', 'subject', 'note_type', 'added_for', 'response_status','tags', 'status'],
                        'sample_export'		=>	['sno', 'added_by', 'subject', 'note_type', 'added_for', 'added_by', 'context', 'response_status'],
                        'selected_columns'	=>	['note_id', 'added_by', 'subject', 'note_type', 'added_for', 'added_by', 'context', 'response_status']
	],
	"cronList-note" => ['note-timeboundnotification' => 'Note Reminders'],

	"mandatoryFields-note-entry-update" => ['information'],

	"dateFields-note-entry-update" => ['date','note_end_date'],

	"mandatoryFields-note-comment-entry-update" => ['thread_parent'],

	"duplicacyCheckFields-note-entry-new" => ['added_by_type','added_by','added_for_type','added_for_id','information'],

	"listFilters-note-list" => [
                        "admin"	=>	[
                            'date_filter' => "date/date/note_date-json",
                            'session_filter' => "Session/session/session-json",
                            'added_by_filter' => "added by/added_by_type/added_by_type-list",
                            'note_type' => "note type/note_type/student_note_type-json",
                            'status' => "status/status/status-json"
                        ],
                        "portal" => [
                            'date_filter' => "date/date/note_date-json",
                            'session_filter' => "Session/session/session-json",
                            'added_by_filter' => "added by/added_by_type/added_by_type-list",
                            'note_type' => "note type/note_type/student_note_type-json",
                            'status' => "status/status/status-json"
                        ]
	],
	"listFilters-note-detail-update" => [
                        'admin'	=>	array(
                            $pg			=>	[
                                'Edit'			=>	"{$pg}/entry/update",
                                'Upload'		=>	"{$pg}/upload",
                                'View Details'	=>	"{$pg}/detail",
                                'View History'	=>	"{$pg}/history",
                            ]
                        )
	],
	"permissionAdmin-note" => [
                        'restricted'=>	[
                            '2'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']],
                            '3'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']]
                        ],
                        'allowed'	=>	[]
    ],
	"permissionRestrictedAdmin-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'settings']
	],
	"permissionPortal-note" => [
                        'restricted'	=>	[],
                        'allowed'		=>	[
                            ['pg' => $pg, 'sub_pg'	=>	'home'],
                            ['pg' => $pg, 'sub_pg'	=>	'e2e-entry'],
                            ['pg' => $pg, 'sub_pg'	=>	'qa-entry'],
                            ['pg' => $pg, 'sub_pg'	=>	'list'],
                            ['pg' => $pg, 'sub_pg'	=>	'report'],
                            ['pg' => $pg, 'sub_pg'	=>	'note-report'],
                        ]
	],
	"permissionAllowedPortal-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'home'],
                        ['pg' => $pg, 'sub_pg'	=>	'e2e-entry'],
                        ['pg' => $pg, 'sub_pg'	=>	'qa-entry'],
                        ['pg' => $pg, 'sub_pg'	=>	'list'],
                        ['pg' => $pg, 'sub_pg'	=>	'report'],
                        ['pg' => $pg, 'sub_pg'	=>	'note-report'],
	],
	"permissionAllowedFiltersPortal-note" => [
                        "entry"				=>	[[ "added_by"	=>	'{$login_type}-{$login_id}' ]],
                        "list"				=>	[[ "added_by"	=>	'{$login_type}-{$login_id}' ]],
                        "sent_by_me-list"	=>	[[ "added_by"	=>	'{$login_type}-{$login_id}' ]],
                        "report"			=>	[[ "added_by"	=>	'{$login_type}-{$login_id}' ]]
	],
	"formPrefills-note-entry-new" => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
	],

	"note-bulk-operation-list" => [
                        "view:detail"		=>	"View Detail",
                        "op:remove"			=>	"Delete",
                        "op:restore"			=>	"Restore"
    ]

];

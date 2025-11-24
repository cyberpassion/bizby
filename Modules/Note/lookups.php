<?php
$pg = 'note';

return [

    // -------------------------------
    // Communication Templates
    // -------------------------------
    "communicationTemplate-note" => [
        "note_entry_new_sms"         => "New Note Entry SMS",
        "note_entry_new_whatsapp"   => "New Note Entry Whatsapp",
        "note_entry_new_email"       => "New Note Entry Email",
        "note_reciever_new_sms"     => "New Note Reciever SMS",
        "note_reciever_new_whatsapp"=> "New Note Reciever Whatsapp",
        "note_reciever_new_email"   => "New Note Reciever Email",
        "note_sender_new_sms"       => "New Note Sender SMS",
        "note_sender_new_whatsapp"  => "New Note Sender Whatsapp",
        "note_sender_new_email"     => "New Note Sender Email",
        "note_comment_new_sms"      => "New Note Comment SMS",
        "note_comment_new_whatsapp" => "New Note Comment Whatsapp",
        "note_comment_new_email"    => "New Note Comment Email"
    ],

    // -------------------------------
    // Column Name Mapping
    // -------------------------------
    "columnNameMapping-note" => [
        'note_id'          => 'ID',
        'added_by'         => 'Name',
        'note_type'        => 'Type',
        'added_for'        => 'For',
        'response_status'  => 'R/Status'
    ],

    // -------------------------------
    // Menu
    // -------------------------------
    "menuItem-note" => [
        "admin" => [
            'parent' => [
                ucfirst($pg) => [$pg.'/home', $pg.'/list']
            ],
            'child' => [
                $pg => [
                    'Add Note' => $pg.'/e2e-entry',
                    'List'     => $pg.'/list',
                    'Report'   => $pg.'/report'
                ]
            ]
        ],
        "portal" => [
            'parent' => [
                ucfirst($pg) => [$pg.'/home', $pg.'/list']
            ],
            'child' => [
                $pg => [
                    'Add Note' => $pg.'/e2e-entry',
                    'List'     => $pg.'/list',
                    'Report'   => $pg.'/report'
                ]
            ]
        ]
    ],

    // -------------------------------
    // Page Structure
    // -------------------------------
    "pgStructure-note" => [
        $pg => [
            'forms/form'  => ['entry','e2e-entry','qa-entry','comment-entry','report','settings','upload','parent'],
            'lists/list'  => ['list'],
            'views/view'  => ['home','document','profile','detail','history']
        ]
    ],

    // -------------------------------
    // Mandatory Options
    // -------------------------------
    "mandatoryOptionsBeforeUsing-note" => [
        'missing_option' => [
            'Note Category' => 'note_type-json'
        ]
    ],

    // -------------------------------
    // Module Tables
    // -------------------------------
    "moduleTable-note" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_note"
    ],

    // -------------------------------
    // Default Columns
    // -------------------------------
    "defaultColumns-note" => [
        'entry'           => ['note_id','added_by','subject','note_type','added_for','response_status','tags','status'],
        'list'            => ['note_id','added_by','subject','note_type','added_for','response_status','tags','status'],
        'detail'          => ['note_id','added_by','subject','note_type','added_for','response_status','tags','status'],
        'report'          => ['note_id','added_by','subject','note_type','added_for','response_status','tags','status'],
        'sample_export'   => ['sno','added_by','subject','note_type','added_for','added_by','context','response_status'],
        'selected_columns'=> ['note_id','added_by','subject','note_type','added_for','added_by','context','response_status']
    ],

    // -------------------------------
    // Cron List
    // -------------------------------
    "cronList-note" => [
        'note-timeboundnotification' => 'Note Reminders'
    ],

    // -------------------------------
    // Mandatory Fields
    // -------------------------------
    "mandatoryFields-note_entry" => ['information'],
    "mandatoryFields-note-comment_entry" => ['thread_parent'],

    // -------------------------------
    // Date Fields
    // -------------------------------
    "dateFields-note_entry" => ['date','note_end_date'],
    "dateFields-note-comment_entry" => [],

    // -------------------------------
    // Additional Fields
    // -------------------------------
    "additionalFields-note_entry" => [],
    "additionalFields-note-comment_entry" => [],

    // -------------------------------
    // Duplicacy Check Fields
    // -------------------------------
    "duplicacyCheckFields-note_entry" => ['added_by_type','added_by','added_for_type','added_for_id','information'],

    // -------------------------------
    // List Filters
    // -------------------------------
    "listFilters-note_entry" => [
        "admin" => [
            'date_filter'    => "date/date/note_date-json",
            'session_filter' => "Session/session/session-json",
            'added_by_filter'=> "added by/added_by_type/added_by_type-list",
            'note_type'      => "note type/note_type/student_note_type-json",
            'status'         => "status/status/status-json"
        ],
        "portal" => [
            'date_filter'    => "date/date/note_date-json",
            'session_filter' => "Session/session/session-json",
            'added_by_filter'=> "added by/added_by_type/added_by_type-list",
            'note_type'      => "note type/note_type/student_note_type-json",
            'status'         => "status/status/status-json"
        ]
    ],

    // -------------------------------
    // List Options for Admin
    // -------------------------------
    "listFilters-note_entry_update" => [
        'admin' => [
            $pg => [
                'Edit'         => "{$pg}/entry/update",
                'Upload'       => "{$pg}/upload",
                'View Details' => "{$pg}/detail",
                'View History' => "{$pg}/history"
            ]
        ]
    ],

    // -------------------------------
    // Permissions for Admin
    // -------------------------------
    "permissionAdmin-note" => [
        'restricted' => [
            '2' => [['pg'=>$pg,'sub_pg'=>'settings']],
            '3' => [['pg'=>$pg,'sub_pg'=>'settings']]
        ],
        'allowed' => []
    ],

    // -------------------------------
    // Permissions for Portal
    // -------------------------------
    "permissionPortal-note" => [
        'restricted' => [],
        'allowed' => [
            ['pg'=>$pg,'sub_pg'=>'home'],
            ['pg'=>$pg,'sub_pg'=>'e2e-entry'],
            ['pg'=>$pg,'sub_pg'=>'qa-entry'],
            ['pg'=>$pg,'sub_pg'=>'list'],
            ['pg'=>$pg,'sub_pg'=>'report'],
            ['pg'=>$pg,'sub_pg'=>'note-report']
        ]
    ],

    // -------------------------------
    // Allowed Filters for Portal
    // -------------------------------
    // "permissionAllowedFiltersPortal-note" => [
    //     "entry"         => [[ "added_by" => '{$login_type}-{$login_id}' ]],
    //     "list"          => [[ "added_by" => '{$login_type}-{$login_id}' ]],
    //     "sent_by_me-list"=> [[ "added_by" => '{$login_type}-{$login_id}' ]],
    //     "report"        => [[ "added_by" => '{$login_type}-{$login_id}' ]]
    // ],

    // -------------------------------
    // Form Prefills
    // -------------------------------
    "formPrefills-note_entry" => [
        "columns" => [
            'product'      => 'default_product',
            'contact_mode' => 'default_contact_mode',
            'state'        => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

    // -------------------------------
    // Note Status
    // -------------------------------
    "note_status-json" => [
        "1"  => "All",
        "11" => "Pending Only",
        "12" => "Resolved Only",
        "2"  => "Deleted"
    ],

    // -------------------------------
    // Note Bulk Operations
    // -------------------------------
    "note_bulk_operation-list" => [
        "view:detail" => "View Detail",
        "op:remove"   => "Delete",
        "op:restore"  => "Restore"
    ]

];

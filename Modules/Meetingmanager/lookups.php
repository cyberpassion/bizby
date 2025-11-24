<?php
$pg = 'meetingmanager';

return [

    // -------------------------------
    // Communication Templates
    // -------------------------------
    "communicationTemplate-meetingmanager" => [
        "meetingmanager_entry_new_sms"       => "New Meetingmanager Entry SMS",
        "meetingmanager_entry_new_whatsapp" => "New Meetingmanager Entry Whatsapp",
        "meetingmanager_entry_new_email"    => "New Meetingmanager Entry Email"
    ],

    // -------------------------------
    // Column Name Mapping
    // -------------------------------
    "columnNameMapping-meetingmanager" => [
        'meeting_id'        => 'ID',
        'requested_by_name' => 'Name',
        'meeting_with'      => 'Meeting With',
        'meeting_date'      => 'M/Date',
        'meeting_time'      => 'M/Time',
        'meeting_exit_time' => 'Exit Time'
    ],

    // -------------------------------
    // Menu
    // -------------------------------
    "menuItem-meetingmanager" => [
        "admin" => [
            'parent' => [
                ucfirst($pg) => [$pg.'/home', $pg.'/list']
            ],
            'child' => [
                $pg => [
                    'New Meeting' => $pg.'/entry/new',
                    'My Meetings' => $pg.'/list',
                    'Report'      => $pg.'/report'
                ]
            ]
        ],
        "portal" => [
            'parent' => [
                ucfirst($pg) => [$pg.'/home', $pg.'/list']
            ],
            'child' => [
                $pg => [
                    'New Meeting' => $pg.'/entry/new',
                    'My Meetings' => $pg.'/list',
                    'Report'      => $pg.'/report'
                ]
            ]
        ]
    ],

    // -------------------------------
    // Page Structure
    // -------------------------------
    "pgStructure-meetingmanager" => [
        $pg => [
            'forms/form' => ['entry','settings','report','upload'],
            'lists/list' => ['list'],
            'views/view'=> ['home','document','profile','detail','history']
        ]
    ],

    // -------------------------------
    // Mandatory Options before using module
    // -------------------------------
    "mandatoryOptionsBeforeUsing-meetingmanager" => [
        'all' => [
            'missing_option' => [
                ['label'=>'Meeting Default Duration','option_name'=>'meeting_default_duration','routeLabel'=>'Set Now','routes'=>['php'=>$pg.'/settings','pwa'=>'/'.$pg.'/settings','app'=>'/'.$pg.'/settings']],
                ['label'=>'Meeting Start Time','option_name'=>'meeting_start_time','routeLabel'=>'Set Now','routes'=>['php'=>$pg.'/settings','pwa'=>'/'.$pg.'/settings','app'=>'/'.$pg.'/settings']],
                ['label'=>'Meeting End Time','option_name'=>'meeting_end_time','routeLabel'=>'Set Now','routes'=>['php'=>$pg.'/settings','pwa'=>'/'.$pg.'/settings','app'=>'/'.$pg.'/settings']]
            ]
        ]
    ],

    // -------------------------------
    // Module Tables
    // -------------------------------
    "moduleTable-meetingmanager" => [
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

    // -------------------------------
    // Default Columns
    // -------------------------------
    "defaultColumns-meetingmanager" => [
        'entry'           => ['meeting_id','requested_by_name','phone_number','meeting_with','meeting_date','meeting_time','meeting_exit_time','tags','status'],
        'list'            => ['meeting_id','requested_by_name','phone_number','meeting_with','meeting_date','meeting_time','meeting_exit_time','tags','status'],
        'detail'          => ['meeting_id','requested_by_name','phone_number','meeting_with','meeting_date','meeting_time','meeting_exit_time','tags','status'],
        'report'          => ['meeting_id','requested_by_name','phone_number','meeting_with','meeting_date','meeting_time','meeting_exit_time','tags','status'],
        'sample_export'   => ['sno','requested_by_name','phone_number','meeting_with','meeting_date','meeting_time','meeting_exit_time'],
        'selected_columns'=> ['requested_by_name','phone_number','meeting_with','meeting_date','meeting_time','meeting_exit_time']
    ],

    // -------------------------------
    // Cron List
    // -------------------------------
    "cronList-meetingmanager" => [
        'meetingmanager-remindernotification' => 'Meeting Reminder'
    ],

    // -------------------------------
    // Mandatory Fields
    // -------------------------------
    "mandatoryFields-meetingmanager_entry" => ['requested_by_name'],

    // -------------------------------
    // Date Fields
    // -------------------------------
    "dateFields-meetingmanager_entry" => ['meeting_date','meeting_exit_date'],

    // -------------------------------
    // Additional Fields
    // -------------------------------
    "additionalFields-meetingmanager_entry" => [],

    // -------------------------------
    // List Filters
    // -------------------------------
    "listFilters-meetingmanager_entry" => [
        "admin" => [
            'meeting_head_filter' => "Head/meeting_type/meeting_type-json",
            'date_filter'        => "Date/meeting_date/meeting_date-json",
            'meeting_with_filter'=> "Meeting With/meeting_with/meeting_with-list",
            'status_filter'      => "Status/status/status-json"
        ],
        "portal" => [
            'meeting_head_filter' => "Head/meeting_type/meeting_type-json",
            'date_filter'        => "Date/meeting_date/meeting_date-json",
            'meeting_with_filter'=> "Meeting With/meeting_with/meeting_with-list",
            'status_filter'      => "Status/status/status-json"
        ]
    ],

    // -------------------------------
    // List Options (Admin)
    // -------------------------------
    "listFilters-meetingmanager_entry_update" => [
        'admin' => [
            $pg => [
                'Edit'         => $pg.'/entry/update',
                'Print'        => $pg.'/document',
                'Upload'       => $pg.'/upload',
                'View Details' => $pg.'/detail',
                'View History' => $pg.'/history'
            ]
        ]
    ],

    // -------------------------------
    // Permissions for Admin
    // -------------------------------
    "permissionAdmin-meetingmanager" => [
        'restricted'=> [
            '2'=> [['pg'=>$pg,'sub_pg'=>'settings']],
            '3'=> [['pg'=>$pg,'sub_pg'=>'settings']]
        ],
        'allowed'=> []
    ],

    // -------------------------------
    // Permissions for Portal
    // -------------------------------
    "permissionPortal-meetingmanager" => [
        'restricted'=> [],
        'allowed'=> [
            ['pg'=>$pg,'sub_pg'=>'home'],
            ['pg'=>$pg,'sub_pg'=>'entry'],
            ['pg'=>$pg,'sub_pg'=>'list'],
            ['pg'=>$pg,'sub_pg'=>'report']
        ]
    ],

    // -------------------------------
    // Allowed Filters for Portal
    // -------------------------------
    // "permissionAllowedFiltersPortal-meetingmanager" => [
    //     "entry"=> [['meeting_with_type'=>'{$login_type}','meeting_with_id'=>'{$login_id}']],
    //     "list" => [['meeting_with_type'=>'{$login_type}','meeting_with_id'=>'{$login_id}']],
    //     "report"=> [['meeting_with_type'=>'{$login_type}','meeting_with_id'=>'{$login_id}']]
    // ],

    // -------------------------------
    // Form Prefills
    // -------------------------------
    "formPrefills-meetingmanager_entry" => [
        "columns"=> [
            'product'      => 'default_product',
            'contact_mode' => 'default_contact_mode',
            'state'        => 'default_indian_state'
        ],
        "groups"=> [
            'current_date'=> ['contact_date']
        ]
    ],

    // -------------------------------
    // Meetingmanager Documents
    // -------------------------------
    "meetingmanager_document-json" => [
        'meetingmanager-slip' => 'Meeting Slip'
    ],

    // -------------------------------
    // Meeting Priorities
    // -------------------------------
    "meeting_priority-json" => [1,2,3,4,5],

    // -------------------------------
    // Meeting Status
    // -------------------------------
    "meeting_status-json" => [
        '1' => 'Active',
        '2' => 'Inactive'
    ],

    // -------------------------------
    // Bulk Operations
    // -------------------------------
    "meeting_manager_bulk_operation-list" => [
        "view:detail"                 => "Print Detail",
        "document:slip"               => "Print Slip",
        "op:remove"                   => "Delete",
        "op:restore"                  => "Restore",
        "meetingmanager:reminder-sms" => "Send Reminder SMS"
    ],

    // -------------------------------
    // Meeting With List (placeholder)
    // -------------------------------
    "meeting_with-list" => []

];

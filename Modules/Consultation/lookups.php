<?php
$pg = 'consultation';
$commonSettingsRoute = '/settings';

return [
	'menuItem-consultation' => [
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

	'consultation_mode-json'	=>	['call'=>'Call'],
    'consultation_status-json' => [
        1 => 'Active',
        2 => 'Deleted',
    ],

	'communicationTemplate-consultation' => [
        "consultation_entry_new_sms"         => "New Consultation Entry SMS",
        "consultation_entry_new_whatsapp"    => "New Consultation Entry Whatsapp",
        "consultation_entry_new_email"       => "New Consultation Entry Email",
        "consultation_reminder_new_sms"      => "New Consultation Reminder SMS",
        "consultation_reminder_new_whatsapp" => "New Consultation Reminder Whatsapp",
        "consultation_reminder_new_email"    => "New Consultation Reminder Email",
    ],

    'columnNameMapping-consultation' => [
        'consultation_id'        => 'ID',
        'consultation_group_id'  => 'GID',
        'patient_name'           => 'Name',
        'consultation_with'      => 'Doctor',
        'consultation_date'      => 'Date',
        'consultation_fee'       => 'Fee',
        'day_token_id'           => 'Token No',
        'consultation_time'      => 'Time',
        'consultation_through'   => 'Mode',
        'next_date'              => 'Next Visit',
        'age'                    => 'Age'
    ],

	'mandatoryOptionsBeforeUsing-consultation' => [
        'consultation-entry' => [
            [
                'table'       => '',
                'params'      => [],
                'label'       => 'Please add employee to get started',
                'routeLabel'  => 'Set Now',
                'routes'      => [
                    'php'=> '/employee/entry/create',
                    'pwa'=> "/employee/entry/entry",
                    'app'=> "/employee/entry"
                ]
            ]
        ],
        'all' => [
            'missing_option' => [
                [
                    'label'       => 'Consulation Default Duration',
                    'option_name' => 'consultation_default_duration',
                    'routeLabel'  => 'Set Now',
                    'routes'      => $commonSettingsRoute
                ],
                [
                    'label'       => 'Consultation Start Time',
                    'option_name' => 'consultation_start_time',
                    'routeLabel'  => 'Set Now',
                    'routes'      => $commonSettingsRoute
                ],
                [
                    'label'       => 'Consultation End Time',
                    'option_name' => 'consultation_end_time',
                    'routeLabel'  => 'Set Now',
                    'routes'      => $commonSettingsRoute
                ]
            ]
        ]
    ],

	'moduleTable-consultation' => [
        "terms",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "uploads",
        "cyp_notification",
        "cyp_message",
        "consultations"
    ],

	'defaultColumns-consultation' => [
        'entry'   => ['consultation_id','consultation_date','patient_name','phone_number','consultation_with','day_token_id','next_date','consultation_fee','tags','status'],
        'list'    => ['consultation_id','consultation_date','patient_name','phone_number','consultation_with','day_token_id','next_date','consultation_fee','tags','status'],
        'detail'  => ['consultation_id','consultation_date','patient_name','phone_number','consultation_with','day_token_id','next_date','consultation_fee','tags','status'],
        'report'  => ['consultation_id','consultation_date','patient_name','phone_number','consultation_with','day_token_id','next_date','consultation_fee','tags','status'],
        'sample_export' => ['sno','consultation_date','patient_name','phone_number','age','next_date','consultation_fee'],
        'selected_columns' => ['consultation_date','patient_name','phone_number','consultation_with','day_token_id','next_date','consultation_fee']
    ],

    'interactiveEntity-consultation' => ['consultation'],

    'cronList-consultation' => [
        'consultation-visitreminder' => 'Consultation Visit Reminder'
    ],

    'mandatoryFields-consultation_entry' => ['patient_name','phone_number','age','consultation_date'],

    'dateFields-consultation_entry' => ['dob','consultation_date'],

    'mandatoryFields-consultation_followup-entry' => ['thread_parent'],

    'dateFields-consultation_followup-entry' => ['consultation_date'],

    'jsonFields-consultation_entry' => ["consultation_for"],

    'listFilters-consultation_list' => [
        "admin" => [
            'consultation_date_filter' => "Date/consultation_date/consultation_entry_date-json",
            'consultation_nextdate_filter' => "Next Date/next_date/consultation_next_entry_date-json",
            'consultation_with_filter one' => "Doctor/consultation_with/employee_id-json",
            'consultation_through_filter one' => "Mode/consultation_through/consultation_through_mode-json",
            'consultation_status_filter' => "Status/status/consultation_status-json"
        ],
        "portal" => [
            'consultation_date_filter' => "Date/consultation_date/consultation_entry_date-json",
            'consultation_nextdate_filter' => "Next Date/next_date/consultation_next_entry_date-json",
            'consultation_with_filter one' => "Doctor/consultation_with/employee_id-json",
            'consultation_through_filter one' => "Mode/consultation_through/consultation_through_mode-json",
            'consultation_status_filter' => "Status/status/consultation_status-json"
        ]
    ],

    'listFilters-consultation_detail_update' => [
        'admin'  => [
            $pg => [
                'Edit'         => "{$pg}/entry/update",
                'Print'        => "{$pg}/document",
                'Upload'       => "{$pg}/upload",
                'View Details' => "{$pg}/detail",
                'View History' => "{$pg}/history",
                'Download Docs'=> ""
            ]
        ],
        'portal' => [
            $pg => [
                'Print'        => "{$pg}/document",
                'View Details' => "{$pg}/detail",
                'View History' => "{$pg}/history",
                'Download Docs'=> ""
            ]
        ]
    ],

    'consultation_consultation-report' => [
        "admin" => [
            'consultation_with_filter' => "Consultation With/consultation_with/consultation_with-json"
        ],
        "portal" => [
            'consultation_with_filter' => "Consultation With/consultation_with/consultation_with-json"
        ]
    ],

    'permissionAdmin-consultation' => [
        'restricted' => [
            '2' => [['pg'=>$pg,'sub_pg'=>'settings']],
            '3' => [['pg'=>$pg,'sub_pg'=>'settings']]
        ],
        'allowed' => []
    ],

    'permissionPortal-consultation' => [
        'restricted' => [],
        'allowed' => [
            ['pg'=>$pg,'sub_pg'=>'home'],
            ['pg'=>$pg,'sub_pg'=>'profile'],
            ['pg'=>$pg,'sub_pg'=>'list'],
            ['pg'=>$pg,'sub_pg'=>'detail'],
            ['pg'=>$pg,'sub_pg'=>'report'],
            ['pg'=>$pg,'sub_pg'=>'document'],
            ['pg'=>$pg,'sub_pg'=>'upload'],
            ['pg'=>$pg,'sub_pg'=>'history'],
            ['pg'=>$pg,'sub_pg'=>"$pg-report"]
        ]
    ],

    'permissionAllowedFiltersPortal-consultation' => [
        "profile"  => [["phone_number" => '{$phone_number}']],
        "list"     => [["phone_number" => '{$phone_number}']],
        "detail"   => [["phone_number" => '{$phone_number}']],
        "history"  => [["phone_number" => '{$phone_number}']],
        "document" => [["phone_number" => '{$phone_number}']],
        "report"   => [["phone_number" => '{$phone_number}']]
    ],

    'formPrefills-consultation_entry' => [
        "columns" => [
            'product'       => 'default_product',
            'contact_mode'  => 'default_contact_mode',
            'state'         => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

    'consultation_through_mode-json' => [
        'call'          => 'Call',
        'direct-visit'  => 'Direct Visit'
    ],

    'consultation_document-json' => [
        'consultation-slip' => 'Consultation Slip'
    ],

    'consultation_plan_tag-json' => [
        'regular'   => 'Regular',
        'urgent'    => 'Urgent',
        'emergency' => 'Emergency'
    ],

    'consultation_status-json' => [
        '1'  => 'Active',
        '2'  => 'Deleted',
        '21' => 'Departed',
        '22' => 'Cancelled'
    ],

    'treatment_type-json' => ["consultation","test","room-allotment"],

    'consultation_bulk_operation-list' => [
        "document:consultation-slip" => "Print Consultation Slip",
        "send:sms"                   => "Send Consultation SMS",
        "send:email"                 => "Send Consultation Email",
        "op:remove"                  => "Delete Consultation",
        "op:restore"                 => "Restore Consultation"
    ],

    'consultation_slip_copy-list' => [
        "all"     => "All",
        "patient" => "Patient Copy Only",
        "office"  => "Office Copy Only"
    ],

    'consultation_sort_results_by-json' => [
        "consultation_date" => "Consultation Date",
        "patient_name"      => "Patient Name",
        "age"               => "Age",
        "father_name"       => "Father Name"
    ],

];

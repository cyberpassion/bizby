<?php
$pg = 'consultation';
$commonSettingsRoute = '/settings';

return [

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
'consultation.consultation-default-intervals'	=>	[
	'5'  => '5 Minutes',
    '10' => '10 Minutes',
    '15' => '15 Minutes',
    '20' => '20 Minutes',
    '30' => '30 Minutes',
],
'consultation.consultation-slip-copies'	=>	[
	'1' => '1 Copy',
    '2' => '2 Copies',
    '3' => '3 Copies',
    '4' => '4 Copies',
],
'consultation.next-days'	=>	[
	'3 d'	=>	'3 Days',
	'4 d'	=>	'4 Days',
	'5 d'	=>	'5 Days',
	'6 d'	=>	'6 Days',
	'7 d'	=>	'7 Days',
	'10 d'	=>	'10 Days',
	'12 d'	=>	'12 Days',
	'15 d'	=>	'15 Days',
	'30 d'	=>	'30 Days'
],
'consultation.crons' => [
        'consultation-visitreminder' => 'Consultation Visit Reminder'
],
'consultation.list-filters' => [
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
'consultation.bulk-operations' => [
        "document:consultation-slip" => "Print Consultation Slip",
        "send:sms"                   => "Send Consultation SMS",
        "send:email"                 => "Send Consultation Email",
        "op:remove"                  => "Delete Consultation",
        "op:restore"                 => "Restore Consultation"
],
'consultation.default-columns' => [
        'entry'   => ['consultation_id','consultation_date','patient_name','phone_number','consultation_with','day_token_id','next_date','consultation_fee','tags','status'],
        'list'    => ['consultation_id','consultation_date','patient_name','phone_number','consultation_with','day_token_id','next_date','consultation_fee','tags','status'],
        'detail'  => ['consultation_id','consultation_date','patient_name','phone_number','consultation_with','day_token_id','next_date','consultation_fee','tags','status'],
         'report'  => ['consultation_id','consultation_date','patient_name','phone_number','consultation_with','day_token_id','next_date','consultation_fee','tags','status'],
         'sample_export' => ['sno','consultation_date','patient_name','phone_number','age','next_date','consultation_fee'],
         'selected_columns' => ['consultation_date','patient_name','phone_number','consultation_with','day_token_id','next_date','consultation_fee']
],
'consultation.permission-allowed-filters-portal' => [
        "profile"  => [["phone_number" => '{$phone_number}']],
        "list"     => [["phone_number" => '{$phone_number}']],
        "detail"   => [["phone_number" => '{$phone_number}']],
        "history"  => [["phone_number" => '{$phone_number}']],
        "document" => [["phone_number" => '{$phone_number}']],
        "report"   => [["phone_number" => '{$phone_number}']]
],
'consultation.statuses' => [
        '1'  => 'Active',
        '2'  => 'Deleted',
        '21' => 'Departed',
        '22' => 'Cancelled'
],
 
  
 
	'consultatio  n-mode'	=>	['call'=>'Call'],
    'consultation_status' => [
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
        ' all' => [
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
 
    'interactiveEntity-consultation' => ['consultation'],

    'mandatoryFields-consultation-entry' => ['patient_name','phone_number','age','consultation_date'],

    'dateFields-consultation-entry' => ['dob','consultation_date'],
 
     'mandatoryFields-consultation-followup-entry' => ['thread_parent'],
 
         'dateFields-consultation-followup-entry' => ['consultation_date'],
 
    'jsonFields-consultation-entry' => ["consultation_for"],

    'listFilters-consultation-detail-update' => [
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
  
    'consultat ion-consultation-report' => [
        "admi n" => [
              'consultation_with_filter' => "Consultation With/consultation_with/consultation_with-json"
        ], 
        "por tal" => [
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
        'allowe d' => [
            [  'pg'=>$pg,'sub_pg'=>'home'],
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

    'formPrefills-consultation-entry' => [
        "columns" => [
            'product'       => 'default_product',
            'contact_mode'  => 'default_contact_mode',
            'state'         => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

    'consultation-through-mode' => [
        'call'          => 'Call',
        'direct-visit'  => 'Direct Visit'
    ],

    'consultation-document' => [
        'consultation-slip' => 'Consultation Slip'
    ],

    'consultation-plan-tag' => [
        'regular'   => 'Regular',
        'urgent'    => 'Urgent',
        'emergency' => 'Emergency'
    ],


    'treatment-type' => ["consultation","test","room-allotment"],

    'consultation-slip-copy-list' => [
        "all"     => "All",
        "patient" => "Patient Copy Only",
        "office"  => "Office Copy Only"
    ],

    'consultation-sort-results-by' => [
        "consultation_date" => "Consultation Date",
        "patient_name"      => "Patient Name",
        "age"               => "Age",
        "father_name"       => "Father Name"
    ],

];

<?php
$pg = 'communication';
$commonSettingsRoute = '/settings';

return [

    'sidebar-menu' => [
        [
            'title' => ucfirst($pg),
            'href'  => "/{$pg}",
            'items' => [

                ['title' => 'Home', 'href' => "/module/{$pg}/home"],

                [
                    'title' => 'Send',
                    'items' => [
                        ['title' => 'Send SMS',      'href' => "/module/{$pg}/new"],
                        ['title' => 'Send Email',    'href' => "/module/{$pg}/new"],
                        ['title' => 'Send Whatsapp', 'href' => "/module/{$pg}/new"],
                    ]
                ],

                ['title' => 'View List', 'href' => "/module/{$pg}/list"],
                ['title' => 'Report',    'href' => "/module/{$pg}/report"],
                ['title' => 'Settings',  'href' => "/module/{$pg}/settings"],

                [
                    'title' => 'Template',
                    'items' => [
                        ['title' => 'Add New',   'href' => "/module/{$pg}/new"],
                        ['title' => 'View List', 'href' => "/module/{$pg}/list"],
                    ]
                ],

                [
                    'title' => 'Plugin',
                    'items' => [
                        ['title' => 'View Calendar', 'href' => "/plugin/calendar?module={$pg}"],
                    ]
                ],
            ],
        ],
    ],

     "communication.list-filters" => [
                        "admin"	=>	[
                            'date_filter' => "Date/date/communication_date-json",
                            'recipient_filter' => "Recipient/recipient_type/communication_recipient_type-json",
                            'communication_mode_filter one' => "Mode/mode/communication_mode-json"
                        ],
                        "portal" => [
                            'date_filter' => "Date/date/communication_date-json",
                            'recipient_filter' => "Recipient/recipient_type/communication_recipient_type-json",
                            'communication_mode_filter one' => "Mode/mode/communication_mode-json"
                        ]
    ],
    "communication.bulk-operations" => [
                        "view:detail"	=>	"View Detail"
    ],
    "communication.default-columns" => [
                        'entry'				=>	['batch_id', 'datetime', 'message', 'mode', 'recipient_type', 'recipients', 'messages_count'],
                        'list'				=>	['batch_id', 'datetime', 'message', 'mode', 'recipient_type', 'recipients', 'messages_count'],
                        'detail'			=>	['batch_id', 'datetime', 'message', 'mode', 'recipient_type', 'recipients', 'messages_count'],
                        'report'			=>	['batch_id', 'datetime', 'message', 'mode', 'recipient_type', 'recipients', 'messages_count'],
                        'sample_export'		=>	['sno', 'message', 'mode', 'recipient_type', 'recipients', 'messages_count'],
                        'selected_columns'	=>	['message', 'mode', 'recipient_type', 'recipients', 'messages_count']
    ],
    "communication.permission-allowed-filters-portal" => [
                        "entry"	=>	[
                            [
                                "recipient_type"	=>	'{$login_type}',
                                "recipient_id"		=>	'{$login_id}'
                            ],
                        ],
                        "list"	=>	[
                            [
                                "recipient_type"	=>	'{$login_type}',
                                "recipient_id"		=>	'{$login_id}'
                            ],
                        ],
                        "report"	=>	[
                            [
                                "recipient_type"	=>	'{$login_type}',
                                "recipient_id"		=>	'{$login_id}'
                            ],
                        ]
    ],


    "columnNameMapping-communication" => [
                        'ptr'			=>	'SNo',
                        'date'			=>	'Date',
                        'datetime'		=>	'Date & Time',
                        'batch_id'		=>	'ID',
                        'message'		=>	'Content',
                        'mode'			=>	'Mode',
                        'messages_count' =>	'Count',
                        'recipient_type' =>	'R/Type',
                        'recipients'	=>	'Recipients'
    ],
    "moduleTable-communication" => [
                        "terms",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                         "cyp_cash",
                        "cyp_option",
                        "uploads",
                        "cyp_notification",
                        "cyp_message",
    ],
    "mandatoryFields-communication-entry-update" => ['template_key'],

    "listFilters-communication-detail-update" => [
                        'admin'	=>	array(
                            $pg			=>	[
                                'Edit'			=>	"{$pg}/entry/update",
                                'Upload'		=>	"{$pg}/upload",
                                'View Details'	=>	"{$pg}/detail"
                            ]
                        )
    ],
    "permissionAdmin-communication" => [
                        'restricted'=>	[
                            '2'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']],
                            '3'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']]
                        ],
                        'allowed'	=>	[]
    ],
    "permissionRestrictedAdmin-module" => ['pg' => $pg, 'sub_pg'	=>	'settings'],

    "permissionPortal-communication" => [
                        'restricted'	=>	[],
                        'allowed'		=>	[
                            ['pg' => $pg, 'sub_pg'	=>	'home'],
                            //['pg' => $pg, 'sub_pg'	=>	'entry'],
                            ['pg' => $pg, 'sub_pg'	=>	'list'],
                            ['pg' => $pg, 'sub_pg'	=>	'report'],
                            //['pg' => $pg, 'sub_pg'	=>	'settings']
                        ]
    ],
    "permissionAllowedPortal-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'home'],
                        //['pg' => $pg, 'sub_pg'	=>	'entry'],
                        ['pg' => $pg, 'sub_pg'	=>	'list'],
                        ['pg' => $pg, 'sub_pg'	=>	'report'],
                        //['pg' => $pg, 'sub_pg'	=>	'settings']
    ],
    "formPrefills-communication-entry-new" => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
    ],
    "communication-report-type-list" => [
                        "singleday-messages"			=>	"Single Day Messages",
                        "multiday-messages-with-count"	=>	"Multiday Messages with Count"
    ],
    "communication-language" => [
                        "en"	=>	"English",
                        "hi"	=>	"Hindi",
                        "bn"	=>	"Bengali",
                        "gu"	=>	"Gujarati",
                        "kn"	=>	"Kannada",
                        "ml"	=>	"Malayalam",
                        "mr"	=>	"Marathi",
                        "ne"	=>	"Nepali",
                        "pa"	=>	"Punjabi",
                        "te"	=>	"Telugu",
                        "ta"	=>	"Tamil",
                        "ur"	=>	"Urdu"
    ],
    "communication-document-upload-type" => ["pdf"]

];

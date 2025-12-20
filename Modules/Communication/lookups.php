<?php
$pg = 'communication';
$commonSettingsRoute = '/settings';

return [

    'menuItem-communication' => [
        'admin' => [
            'parent' => [
                $pg => '#',
            ],
            'child' => [
                $pg => [

                    [
                        'Send' => [
                            ['Send SMS'      => "/{$pg}/create"],
                            ['Send Email'    => "/{$pg}/create"],
                            ['Send Whatsapp' => "/{$pg}/create"],
                        ]
                    ],

                    ['View List' => "/{$pg}/list"],
                    ['Report'    => "/{$pg}/report"],
                    ['Settings'  => "/{$pg}/settings"],

                    [
                        'Template' => [
                            ['Add New'   => "/{$pg}/create"],
                            ['View List' => "/{$pg}/list"],
                        ]
                    ],

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
                        ['title' => 'View Calendar', 'href' => "/{$pg}/calendar"],
                    ]
                ],
            ],
        ],
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
    "defaultColumns-communication" => [
                        'entry'				=>	['batch_id', 'datetime', 'message', 'mode', 'recipient_type', 'recipients', 'messages_count'],
                        'list'				=>	['batch_id', 'datetime', 'message', 'mode', 'recipient_type', 'recipients', 'messages_count'],
                        'detail'			=>	['batch_id', 'datetime', 'message', 'mode', 'recipient_type', 'recipients', 'messages_count'],
                        'report'			=>	['batch_id', 'datetime', 'message', 'mode', 'recipient_type', 'recipients', 'messages_count'],
                        'sample_export'		=>	['sno', 'message', 'mode', 'recipient_type', 'recipients', 'messages_count'],
                        'selected_columns'	=>	['message', 'mode', 'recipient_type', 'recipients', 'messages_count']
    ],
    "mandatoryFields-communication_entry_update" => ['template_key'],

    "listFilters-communication_list" => [
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
    "listFilters-communication_detail_update" => [
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
    "permissionAllowedFiltersPortal-communication" => [
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
    "formPrefills-communication_entry_new" => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
    ],
    "communication_report_type-list" => [
                        "singleday-messages"			=>	"Single Day Messages",
                        "multiday-messages-with-count"	=>	"Multiday Messages with Count"
    ],
    "communication_language-json" => [
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
    "communication_bulk_operation-list" => [
                        "view:detail"	=>	"View Detail"
    ],
    "communication_document_upload_type-json" => ["pdf"]

];

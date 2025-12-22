<?php
$pg = 'vendor';
$commonSettingsRoute = '/settings';

return [
	'menuItem-vendor' => [
    'admin' => [
        'parent' => [
            $pg => '#',
        ],
        'child' => [
            $pg => [
                ['Add New'   => "/{$pg}/create"],
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
    'communicationTemplate-vendor' => [
                        "vendor_entry_new_sms"		=>	"New Vendor Entry SMS",
                        "vendor_entry_new_whatsapp"	=>	"New Vendor Entry Whatsapp",
                        "vendor_entry_new_email"	=>	"New Vendor Entry Email",
    ],
    'columnNameMapping-vendor' => [
                        'ptr'						=>	'SNo',
                        'date'						=>	'Date',
                        'vendor_id' 				=>	'ID',
                        'vendor_code'				=>	'V/Code',
                        'vendor_official_name'		=>	'Name',
                        'vendor_official_phone'		=>	'Phone',
                        'vendor_official_email'		=>	'Email',
                        'vendor_official_address'	=>	'Address',
                        'vendor_person'				=>	'Person',
                        'vendor_person_phone'		=>	'P/Phone',
                        'vendor_person_email'		=>	'P/Email',
                        'code_attaches'				=>	'C/Attaches',
                        'expected_income'			=>	'Exp Income'
    ],
    'moduleTable-vendor' => [
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "cyp_upload",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_vendor"
    ],
    'defaultColumns-vendor' => [
                        'entry'				=>	['vendor_id', 'vendor_official_name', 'vendor_code', 'vendor_person', 'vendor_person_phone', 'code_attaches', 'expected_income', 'tags', 'status'],
                        'list'				=>	['vendor_id', 'vendor_official_name', 'vendor_code', 'vendor_person', 'vendor_person_phone', 'code_attaches', 'expected_income', 'tags', 'status'],
                        'detail'			=>	['vendor_id', 'vendor_official_name', 'vendor_code', 'vendor_person', 'vendor_person_phone', 'code_attaches', 'expected_income', 'tags', 'status'],
                        'report'			=>	['vendor_id', 'vendor_official_name', 'vendor_person', 'vendor_person_phone', 'code_attaches', 'expected_income', 'tags', 'status'],
                        'sample_export'		=>	['sno', 'vendor_official_name', 'vendor_official_address', 'vendor_official_email', 'vendor_official_phone', 'vendor_terms_and_condition', 'vendor_person', 'vendor_person_designation', 'vendor_person_email', 'vendor_person_phone'],
                        'selected_columns'	=>	['vendor_official_name', 'vendor_person', 'vendor_person_phone']
    ],
    'mandatoryFields-vendor_entry_update' => [
                        'vendor_official_name',
                        'vendor_official_address',
                        'vendor_official_email',
                        'vendor_official_phone',
                        'vendor_terms_and_condition',
                        'vendor_person',
                        'vendor_person_designation',
                        'vendor_person_email',
                        'vendor_person_phone'
    ],
    'dateFields-vendor_entry_update' => [],

    'additionalFields-vendor_entry_update' => [],

    'jsonFields-vendor_entry_update' => ['region'],

    'vendor_setting-json' => [
                       'Settings'					=>	'settings',
                       'Client Settings'			=>	['vendor','settings'],
                       'Vendor Settings'			=>	['vendor','settings']
    ],
    'listFilters-vendor_list' => [
                        "admin"	=>	[
                            'vendor_status_filter one'		=> "Status/status/vendor_status-json"
                        ],
                        "portal" => [
                            'vendor_status_filter one'		=> "Status/status/vendor_status-json"
                        ]
    ],
    'listFilters-vendor_activity-list' => [
                        "admin"	=>	[
                            'vendor_status_filter one'		=> "Activity/activity/vendor_activity-json",
                            'vendor_operation_filter one'	=> "Operation/operation/vendor_operation-json"
                        ],
                        "portal" => [
                            'vendor_status_filter one'		=> "Activity/activity/vendor_activity-json",
                            'vendor_operation_filter one'	=> "Operation/operation/vendor_operation-json"
                        ]
    ],
    'vendor_status-json' => [
                        "1"				=>	"Active",
                        "11"			=>	"Awaiting Approval",
                        "2"				=>	"Inactive",
    ],
    'vendor_document-json' => [
                        'performance'					=>	'Performance',
                        'agreement'						=> 'Agreement',
                        'certificate'					=> 'Certificate',
                        'vendor-id-card'				=> 'ID Card'
    ],
    'vendor_bulk_operation-list' => [
                        "document:performance"			=>	'Performance',
                        "document:agreement"			=>	'Agreement',
                        "document:certificate"			=>	'Certificate',
                        "document:vendor-id-card"		=>	'ID Card'
    ],
    'vendor_level-json' => ["Silver","Gold","Platinum"],

    'interactiveEntity-vendor' => ['vendor'],

    'vendor_bulk_operation-list' => [
                        "view:detail"		=>	"View Detail",
                        "op:remove"			=>	"Delete",
                        "op:restore"		=>	"Restore"
    ]

];

<?php
$pg = 'service';
$commonSettingsRoute = '/settings';

return [
	'menuItem-service' => [
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
                    ['title' => 'View Calendar', 'href' => "/plugin/calendar?module={$pg}"],
                ]
            ],
        ],
    ],
],
    'communicationTemplate-service' => [
                        "service_entry_new_sms"		    =>	"New Service Entry SMS",
                        "service_entry_new_whatsapp"	=>	"New Service Entry Whatsapp",
                        "service_entry_new_email"		=>	"New Service Entry Email",
    ],
    'columnNameMapping-service' => [
                        'service_id'		=>	'ID',
                        'service_name'		=>	'Name',
                        'service_type'		=>	'Type',
                        'provided_by'		=>	'By'
    ],
    'columnNames-service' => [
                        'unit_price'		 =>	'price',
                        'size'				 =>	'service_size',
                        'unit'				 =>	'service_size_unit'
    ],
    'moduleTable-service' => [
                        "cyp_term",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "cyp_upload",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_saleservice",
                        "cyp_service_listing"
    ],
    'defaultColumns-service' => [
                        'entry'				=>	['request_id', 'date', 'service_type', 'provided_by', 'service_name', 'requested_by_info', 'request_size', 'request_price', 'request_description'],
                        'list'				=>	['request_id', 'date', 'service_type', 'provided_by', 'service_name', 'requested_by_info', 'request_size', 'request_price', 'request_description'],
                        'detail'			=>	['request_id', 'date', 'service_type', 'provided_by', 'service_name', 'requested_by_info', 'request_size', 'request_price', 'request_description'],
                        'report'			=>	['request_id', 'date', 'service_type', 'provided_by', 'service_name', 'requested_by_info', 'request_size', 'request_price', 'request_description'],
                        'sample_export'		=>	['sno', 'date', 'service_type', 'provided_by', 'service_name', 'requested_by_info', 'request_size', 'request_price', 'request_description'],
                        'selected_columns'	=>	['date', 'service_type', 'provided_by', 'service_name', 'requested_by_info', 'request_size', 'request_price', 'request_description']
    ],
    'listFilters-service-list' => [
                        "admin"	=>	[
                               'service_price_filter one' => "Price/service_price/service_price-json",
                            'service_type_filter one' => "Type/service_type/service_type-json"
                        ],
                        "portal" => [
                            'service_price_filter one' => "Price/service_price/service_price-json",
                            'service_type_filter one' => "Type/service_type/service_type-json"
                        ]
    ],
    'listFilters-service-listing-entry-new' => [
                        "admin"	=>	[
                            'service_price_filter one' => "Price/service_price/service_price-json",
                            'service_type_filter one' => "Type/service_type/service_type-json"
                        ],
                        "portal" => [
                            'service_price_filter one' => "Price/service_price/service_price-json",
                            'service_type_filter one' => "Type/service_type/service_type-json"
                        ]
    ],
    'formPrefills-service-entry-new' => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
    ],
    'mandatoryFields-service-entry-update' => ['service_name', 'provided_by', 'service_name', 'service_size', 'price'],

    'dateFields-service-entry-update' => ['date'],

    'additionalFields-service-entry-update' => [],

    'mandatoryFields-service-request-entry-update' => ['date', 'service_id'],

    'dateFields-service-request-entry-update' => ['date'],

    'additionalFields-service-request-entry-update' => [],

    'duplicacyCheckFields-service-listing-entry-update' => ['provided_by', 'service_name'],

    'duplicacyCheckFields-service-request-new' => ['date', 'requested_by_type', 'requested_by', 'service_id'],

    'service-status' => [
                        1	=>	'Active',
                        2	=>	'Deleted'
    ],
    'service-document' => [
                        'request-slip'		=>	'Request Slip',
                        'request-report'	=>	'Final Report',
                        'request-invoice'	=>	'Invoice',
                        'service-brochure'	=>	'Service Brochure'
    ],
    'service-availability-status' => [
                        'in-stock'			=>	'AVAILABLE',
                        'out-of-stock'		=>	'NOT AVAILABLE'
    ],
    'service-status' => [
                        "1"			=>	"Requested",
                        "2"			=>	"Completed"
    ],
    'service-unit' => [
                        'unit',
                        'kg',
                        'session',
                        'day',
                        'visit'
    ],
    'service-listing-bulk-operation-list' => [
                        "view:detail"				=>	"View Details",
                        "document:request-slip"		=>	"Print Request Slip",
                        "document:request-report"	=>	"Print Request Report",
                        "op:remove"					=>	"Delete",
                        "op:restore"				=>	"Restore"
    ]

];

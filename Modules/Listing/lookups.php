<?php
$pg = 'listing';
$commonSettingsRoute = '/settings';

return [

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
    'communicationTemplate-listing' => [
						"listing_entry_new_sms"		    =>	"New Listing Entry SMS",
						"listing_entry_new_whatsapp"	=>	"New Listing Entry Whatsapp",
						"listing_entry_new_email"		=>	"New Listing Entry Email",
    ],
    'columnNameMapping-listing' => [
                        'ptr'			=>	'SNo',
						'added_by'		=>	'Added By'
    ],
    'mandatoryOptionsBeforeUsing-listing' => [
					'missing_option'	=>	[
						'Listing Category'	=>	'listing_category-json'
					]
    ],
    'moduleTable-listing' => [
					"cyp_term",
					"cyp_activity",
					"cyp_advancedinfo",
					"cyp_allotment",
					"cyp_cash",
					"cyp_option",
					"cyp_upload",
					"cyp_notification",
					"cyp_message",
					"cyp_listing"
    ],
    'defaultColumns-listing' => [
                    'entry'				=>	['date', 'listing_id', 'listing_name', 'category', 'phone_number', 'email', 'locality', 'place', 'state', 'info','tags', 'status'],
					'list'				=>	['date', 'listing_id', 'listing_name', 'category', 'phone_number', 'email', 'locality', 'place', 'state', 'info','tags', 'status'],
					'detail'			=>	['date', 'listing_id', 'listing_name', 'category', 'phone_number', 'email', 'locality', 'place', 'state', 'info','tags', 'status'],
					'report'			=>	['date', 'listing_id', 'listing_name', 'category', 'phone_number', 'email', 'locality', 'place', 'state', 'info','tags', 'status'],
					'sample_export'		=>	[],
					'selected_columns'	=>	[]
    ],
    'listFilters-listing-list' => [
					"admin"	=>	[
					    'listing_category_filter' => "Catgory/category/listing_category-json",
						'listing_status_filter' => "Status/status/status-json"
					],
					"portal" => [
					    'listing_category_filter' => "Catgory/category/listing_category-json",
						'listing_status_filter' => "Status/status/status-json"
					]
    ],
    'listing-bulk-operation-list' => [
					"view:detail"		=>	"View Detail",
					"op:remove"			=>	"Delete",
					"op:restore"			=>	"Restore"
    ],
    
];

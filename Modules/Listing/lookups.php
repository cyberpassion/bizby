<?php
$pg = 'listing';
$commonSettingsRoute = '/settings';

return [

'sidebar-menu' => [
    [
        'title'      => ucfirst($pg),
        'href'       => "/{$pg}",
        'permission' => "{$pg}.access",
        'items'      => [

            /* =========================
             | Dashboard
             ========================= */
            [
                'title'      => 'Dashboard',
                'href'       => "/module/{$pg}/home",
                'permission' => "{$pg}.dashboard.view",
            ],

            /* =========================
             | Listing Management
             ========================= */
            [
                'title' => 'Listings',
                'items' => [
                    [
                        'title'      => 'Add Listing',
                        'href'       => "/module/{$pg}/new",
                        'permission' => "{$pg}.listing.create",
                    ],
                    [
                        'title'      => 'View List',
                        'href'       => "/module/{$pg}/list",
                        'permission' => "{$pg}.listing.view",
                    ],
                ],
            ],

            /* =========================
             | Reports
             ========================= */
            [
                'title' => 'Reports',
                'items' => [
                    [
                        'title'      => 'Listing Report',
                        'href'       => "/module/{$pg}/report",
                        'permission' => "{$pg}.report.listing",
                    ],
                ],
            ],

            /* =========================
             | Settings
             ========================= */
            [
                'title' => 'Settings',
                'items' => [
                    [
                        'title'      => 'Basic Settings',
                        'href'       => "/module/{$pg}/settings",
                        'permission' => "{$pg}.settings.basic",
                    ],
                ],
            ],

            /* =========================
             | Plugins
             ========================= */
            [
                'title' => 'Plugins',
                'items' => [
                    [
                        'title'      => 'View Calendar',
                        'href'       => "/plugin/calendar?module={$pg}",
                        'permission' => "{$pg}.plugin.manage",
                    ],
                ],
            ],

        ],
    ],
],

    'listing.list-filters' => [
					"admin"	=>	[
					    'listing_category_filter' => "Catgory/category/listing_category-json",
						'listing_status_filter' => "Status/status/status-json"
					],
					"portal" => [
					    'listing_category_filter' => "Catgory/category/listing_category-json",
						'listing_status_filter' => "Status/status/status-json"
					]
    ],
    'listing.bulk-operations' => [
					"view:detail"		=>	"View Detail",
					"op:remove"			=>	"Delete",
					"op:restore"			=>	"Restore"
    ],
    'listing.default-columns' => [
                    'entry'				=>	['date', 'listing_id', 'listing_name', 'category', 'phone_number', 'email', 'locality', 'place', 'state', 'info','tags', 'status'],
					'list'				=>	['date', 'listing_id', 'listing_name', 'category', 'phone_number', 'email', 'locality', 'place', 'state', 'info','tags', 'status'],
					'detail'			=>	['date', 'listing_id', 'listing_name', 'category', 'phone_number', 'email', 'locality', 'place', 'state', 'info','tags', 'status'],
					'report'			=>	['date', 'listing_id', 'listing_name', 'category', 'phone_number', 'email', 'locality', 'place', 'state', 'info','tags', 'status'],
					'sample_export'		=>	[],
					'selected_columns'	=>	[]
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
    
];

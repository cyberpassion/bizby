<?php
$pg = 'booking';
$commonSettingsRoute = '/settings';

return [
	'menuItem-booking' => [
		'admin'	=>	[
			'parent'		=>	[
				$pg	=>	'#',
			],
			'child'		=>	[
				$pg	=>	[
					['Add New'		=> "/{$pg}/create"],
	                ['View List'	=> "/{$pg}/list"],
    	            ['Report'		=> "/{$pg}/report"],
        	        ['Settings'		=> "/{$pg}/settings"],
				],
			],
		],
	],
    'sidebar-menu' => [
        [
            'title' => ucfirst($pg),
            'href' => "/{$pg}",
            'items' => [
                ['title' => 'Home', 'href' => "/module/{$pg}/home"],
				['title' => 'Add New', 'href' => "/module/{$pg}/new"],
                ['title' => 'View List', 'href' => "/module/{$pg}/list"],
                ['title' => 'Report', 'href' => "/module/{$pg}/report"],
                ['title' => 'Settings', 'href' => "/module/{$pg}/settings"],
            ],
        ],
    ],
    "communicationTemplate-booking" => [
                        "booking_entry_new_sms"			=>	"New Booking Entry SMS",
                        "booking_entry_new_whatsapp"	=>	"New Booking Entry Whatsapp",
                        "booking_entry_new_email"		=>	"New Booking Entry Email",
    ],
    "columnNameMapping-booking" => [
                        'ptr'						=>	'SNo',
                        'building_id'				=>	'BID',
                        'building_name'				=>	'B/Name',
                        'building_incharge'			=>	'Incharge',
                        'building_incharge_phone'	=>	'Incharge Phone',
                        'building_description'		=>	'Description',
                        'building_employees'		=>	'Employees',
                        'booking_id'				=>	"B/ID",
                        'booking_type'				=>	'B/Type',
                        'slot_id'					=>	'Slot',
                        'slot_name'					=>	'S/Name',
                        'slot_type'					=>	'Type',
                        'space_id'					=>	'Space',
                        'expected_checkin_datetime'	=>	'Exp/Checkin',
                        'expected_checkout_datetime'=>	'Exp/Checkout',
                        'checkin_datetime'			=>	'Checkin',
                        'checkout_datetime'			=>	'Checkout',
                        'occupant_name'				=>	'Name',
                        'is_available'				=>	'Status',
                        'options'					=>	'Options',
                        'chain_options'				=>	'Options'
    ],
    "columnNames-booking" => [
                        'type_name'				=>	'occupant_type',
                        'type_id'				=>	'occupant_id'
    ],
    "moduleCashType-booking" => [
                         'booking-fee'	=>	'Booking Fee'
    ],
    "mandatoryOptionsBeforeUsing-booking" => [
                        'booking-allotment-entry'	=>	[
                            'empty'			=>	[
                                [
                                    'table'	=>	'#',
                                    'params'=>	[],
                                    'label'	=>	'Please add building to get started',
                                    'routeLabel'	=>	'Set Now',
                                    'routes'=>	[
                                        'php'=>	'#',
                                        'pwa'=>	"/{$pg}/building-entry/entry",
                                        'app'=>	"/{$pg}/building-entry"
                                    ]
                                ],
                                [
                                    'table'	=>	'#',
                                    'params'=>	[],
                                    'label'	=>	'Building Slots not Added',
                                    'routeLabel'	=>	'Set Now',
                                    'routes'=>	[
                                        'php'=>	'#',
                                        'pwa'=>	"/{$pg}/slot-entry/entry",
                                        'app'=>	"/{$pg}/slot-entry"
                                    ]
                                ]
                            ]
                        ],
                        'booking-slot-entry'		=>	array(
                            'empty'			=>	[
                                [
                                    'table'	=>	'#',
                                    'params'=>	[],
                                    'label'	=>	'Please add building to get started',
                                    'routeLabel'	=>	'Set Now',
                                    'routes'=>	[
                                        'php'=>	'#',
                                        'pwa'=>	"/{$pg}/building-entry",
                                        'app'=>	"/{$pg}/building-entry"
                                    ]
                                ]
                            ]
                        ),
                        'all'	=>	array(
                            'missing_option'			=>	[
                                [
                                    'label'			=>	'Standard Checkin Time',
                                    'option_name'	=>	'booking_standard_checkin_time',
                                    'routeLabel'	=>	'Set Now',
                                    'routes'		=>	[
                                        'php'=>	'#',
                                        'pwa'=>	"/{$pg}/settings",
                                        'app'=>	"/{$pg}/settings"
                                    ]
                                ],
                                [
                                    'label'			=>	'Standard Checkout Time',
                                    'option_name'	=>	'booking_standard_checkout_time',
                                    'routeLabel'	=>	'Set Now',
                                    'routes'		=>	[
                                        'php'=>	'#',
                                        'pwa'=>	"/{$pg}/settings",
                                        'app'=>	"/{$pg}/settings"
                                    ]
                                ]
                            ]
                            //'Single Day Count Rule'		=>	'booking_single_day_count_rule'
                        )
    ],
    "moduleTable-booking" => [
                        "terms",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "uploads",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_booking",
                        "cyp_booking_building",
                        "cyp_booking_listing"
    ],
    "defaultColumns-booking" => [
                        'entry'				=>	['booking_id', 'occupant_name', 'booking_type', 'slot_type', 'slot_name', 'checkin_datetime', 'expected_checkout_datetime', 'checkout_datetime'],
                        'list'				=>	['booking_id', 'occupant_name', 'booking_type', 'slot_type', 'slot_name', 'checkin_datetime', 'expected_checkout_datetime', 'checkout_datetime'],
                        'detail'			=>	['booking_id', 'occupant_name', 'booking_type', 'slot_type', 'slot_name', 'checkin_datetime', 'expected_checkout_datetime', 'checkout_datetime'],
                        'report'			=>	['booking_id', 'occupant_name', 'booking_type', 'slot_type', 'slot_name', 'checkin_datetime', 'expected_checkout_datetime', 'checkout_datetime'],
                        'sample_export'		=>	['sno', 'date', 'payee_name', 'paid', 'cash_type', 'additional_info', 'status'],
                        'selected_columns'	=>	['date', 'payee_name', 'paid', 'cash_type', 'cash_type_remark', 'additional_info'],
                        'building-entry'	=>	['building_id', 'building_name', 'building_incharge', 'building_incharge_phone', 'building_description', 'building_employees', 'options'],
    ],
    "interactiveEntity-booking" => ['booking'],

    "mandatoryFields-booking_building-entry_new" => ['building_name'],

    "mandatoryFields-booking_building-entry_update" => ['building_id'],

    "dateFields-booking_entry_update" => ['date'],

    "duplicacyCheckFields-booking_slot-entry_new" => ['building_id', 'slot_name'],

    "mandatoryFields-booking_slot-entry_update" => ['building_id','slot_type','slot_type','day_cost'],

    "mandatoryFields-booking_quickdeallot-entry_update" => ['checkout_datetime'],

    "dateFields-booking_transfer_entry_update" => ['booking_date'],

    "dateFields-booking_quickdeallot-entry_update" => ['booking_datetime'],

    "mandatoryFields-booking-building_entry_update" => ['building_name'],

    "listFilters-booking_building_list" => [
                        "admin"	=>	[
                            'building_id_filter' => "Building/building_id/building-json",
                        ],
                        "portal" => [
                            'building_id_filter' => "Building/building_id/building-json",
                        ]
    ],
    "listFilters-booking_entry_new" => [
                        "admin"	=>	[
                            'booking_type_filter' 	=> "Booking Type/booking_type/booking_type-json",
                            'booking_status_filter' => "Status/status/booking_status-json",
    
                        ],
                        "portal" => [
                            'booking_type_filter' 	=> "Booking Type/booking_type/booking_type-json",
                            'booking_status_filter' => "Status/status/booking_status-json",
                        ]
    ],
    "listFilters-booking_building-entry" => [
                        "admin"	=>	[
                            'booking_allotment_filter' => "Building/building_id/building-json",
                            'building_status_filter' => "Status/status/building_status-json",
                        ],
                        "portal" => [
                            'booking_allotment_filter' => "Building/building_id/building-json",
                            'building_status_filter' => "Status/status/building_status-json",
                        ]
    ],
    "listFilters-booking_building-detail_update" => [
                        'admin'	=>	array(
                            $pg			=>	[
                                'Edit'			=>	"{$pg}/building-entry/update",
                                'Add Slots'		=>	"{$pg}/slot-entry",
                                'Perform Allotment'	=>	"{$pg}/allotment-entry",
                                'Upload'		=>	[
                                    "path"		=>	"{$pg}/upload",
                                    "params"	=>	["type"	=>	"building"]
                                ],
                                'View Details'	=>	"{$pg}/detail"
                            ]
                        )
    ],
    "listFilters-booking_listing-detail_update" => [
                        'admin'	=>	array(
                            $pg			=>	[
                                'Edit'			=>	"{$pg}/slot-entry/update",
                                'View Details'	=>	"{$pg}/detail",
                                'Allot/Deallot'	=>	"{$pg}/allotment-entry",
                                "Upload"		=>	"{$pg}/upload"
                            ]
                        )
    ],
    "listFilters-booking_slot-detail_update" => [
                        'admin'	=>	array(
                            $pg			=>	[
                                'Edit'			=>	"{$pg}/slot-entry/update",
                                'View Details'	=>	"{$pg}/detail",
                                'Allot/Deallot'	=>	"{$pg}/allotment-entry",
                                "Upload"		=>	"{$pg}/upload"
                            ]
                        )
    ],
    "listFilters-booking_allotment-entry_update" => [
                        'admin'	=>	array(
                            $pg			=>	[
                                'Edit'			=>	"{$pg}/allotment-entry/update",
                                'Print'			=>	"{$pg}/document",
                            ]
                        )
    ],
    "listFilters-booking_booking-report_new" => [
                        "admin"	=>	[
                            'booking_allotment_filter' 			=> "Building/building_id/building-json",
                            'report_booking_type_filter'		=> "Booking Type/booking_type/booking_type-json",
                            'report_availability_type_filter'	=> "Availability/status/booking_availability_status-json"
                        ],
                        "portal" => [
                            'booking_allotment_filter' 			=> "Building/building_id/building-json",
                            'report_booking_type_filter'		=> "Booking Type/booking_type/booking_type-json",
                            'report_availability_type_filter'	=> "Availability/status/booking_availability_status-json"
                        ]
    ],
    "permissionAdmin-booking" => [
                        'restricted'=>	[
                            '2'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']],
                            '3'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']]
                        ],
                        'allowed'	=>	[]
    ],
    "permissionRestrictedAdmin-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'settings']
    ],
    "permissionPortal-booking" => [
                        'restricted'	=>	[],
                        'allowed'		=>	[
                            ['pg' => $pg, 'sub_pg'	=>	'home'],
                            ['pg' => $pg, 'sub_pg'	=>	'list'],
                            ['pg' => $pg, 'sub_pg'	=>	'detail'],
                            ['pg' => $pg, 'sub_pg'	=>	'report'],
                        ]
    ],
    "permissionAllowedPortal-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'home'],
                        ['pg' => $pg, 'sub_pg'	=>	'list'],
                        ['pg' => $pg, 'sub_pg'	=>	'detail'],
                        ['pg' => $pg, 'sub_pg'	=>	'report'],
    ],
    "permissionAllowedFiltersPortal-booking" => [
                        "profile"=>	[[ "phone_number" => '{$phone_number}' ]],
                        "list"   => [[ "phone_number" => '{$phone_number}' ]],
                        "report" => [[ "phone_number" => '{$phone_number}' ]]
    ],
    "jsonFields-booking-building_entry" => ['building_employee'],

    "interactiveEntity-booking" => ['booking'],

    "booking_status-json" => [
                        '1'		=>	'Active',
                        '11'	=>	'Expected',
                        '2'		=>	'Departed',
                        '21'	=>	'Cancelled'
    ],
    "booking_single_day_count_rule-json" => [
                        "default"	=>	"As per Checkin and Checkout Time",
                        "12-hours"	=>	"12 Hours",
                        "24-hours"	=>	"24 Hours"
    ],
    "booking_single_unit-json" => [
                        'day',
                        'hour',
                        'minute'
    ],
    "booking_fee_type-json" => ['total' => 'Total', 'per-day' => 'Per Day'],

    "booking_document-json" => [
                        'booking-invoice'			=>	'Booking Invoice',
                        'booking-confirmation-slip'	=>	'Booking Confirmation Slip'
    ],
    "booking_type-json" => [
                        ""			=>	"Select",
                        "regular"	=>	"Regular Booking",
                        "scheduled"	=>	"Scheduled Booking"
    ],
    "booking_status-json" => [
                        "1"			=>	"Confirmed",
                        "11"		=>	"Not Confirmed"
    ],
    "booking_availability_status-json" => [
                        "1"			=>	"Available",
                        "11"		=>	"Partially Available",
                        "2"			=>	"Not Available",
                        "all"			=>	"All"
    ],
    "cash_report_type-list" => [
                        "cash_collection_minified"					=>	"Cash Collection (Minified)",
                        "cash_collection_detailed"					=>	"Cash Collection (Detailed)",
                        "inward_outward_flow_minified"				=>	"Inward-Outward Cash Flow (Minified)",
                        "inward_outward_flow_detailed"				=>	"Inward-Outward Cash Flow (Detailed)",
                        "inward_outward_flow_minified_cumulative"	=>	"Inward-Outward Cash Flow (Minified & Cumulative)"
    ],
    "booking_bulk_operation-list" => [
                        "document:booking-confirmation-slip"	=>	"Booking Confirmation Slip",
                        "document:booking-invoice"				=>	"Booking Invoice",
                        "document:gst-invoice-slip"				=>	"GST Slip",
                        "document:simple-invoice-slip"			=>	"Simple Slip",
                        "view:detail"							=>	"View Detail",
                        "form:booking/deallotment-entry/new"	=>	"Exit",
                        //"op:perform_booking-extension"			=>	"Extend Booking",
                        //"op:perform_booking-cancellation"		=>	"Cancel Booking",
                        //"op:perform_booking-transfer"			=>	"Transfer Booking",
                        "send:email"							=>	"Send Email",
                        "send:sms"								=>	"Send SMS",
                        "op:remove"								=>	"Delete",
                        "op:restore"							=>	"Restore"
    ],
    "sort_booking_results_by-json" => [
                        "building_id"						=>	"Building",
                        "booking_group_id"					=>	"Booking Group ID"
    ]

];

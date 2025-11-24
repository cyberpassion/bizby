<?php
$pg = 'booking';

return [

    "communicationTemplate-booking" => [
        "booking_entry_new_sms"        => "New Booking Entry SMS",
        "booking_entry_new_whatsapp"   => "New Booking Entry Whatsapp",
        "booking_entry_new_email"      => "New Booking Entry Email",
    ],

    "columnNameMapping-booking" => [
        'ptr'                       => 'SNo',
        'building_id'               => 'BID',
        'building_name'             => 'B/Name',
        'building_incharge'         => 'Incharge',
        'building_incharge_phone'   => 'Incharge Phone',
        'building_description'      => 'Description',
        'building_employees'        => 'Employees',
        'booking_id'                => "B/ID",
        'booking_type'              => 'B/Type',
        'slot_id'                   => 'Slot',
        'slot_name'                 => 'S/Name',
        'slot_type'                 => 'Type',
        'space_id'                  => 'Space',
        'expected_checkin_datetime' => 'Exp/Checkin',
        'expected_checkout_datetime'=> 'Exp/Checkout',
        'checkin_datetime'          => 'Checkin',
        'checkout_datetime'         => 'Checkout',
        'occupant_name'             => 'Name',
        'is_available'              => 'Status',
        'options'                   => 'Options',
        'chain_options'             => 'Options',
    ],

    "columnNames-booking" => [
        'type_name' => 'occupant_type',
        'type_id'   => 'occupant_id'
    ],

    "moduleCashType-booking" => [
        'booking-fee' => 'Booking Fee'
    ],

    "pgStructure-booking" => [
        'booking' => [
            'forms' => [
                'building-entry',
                'slot-entry',
                'allotment-entry',
                'transfer-entry',
                'upload',
                'report',
                'settings'
            ],
            'lists' => [
                'list',
                'building-list',
                'allotment-list'
            ],
            'views' => [
                'home', 'document', 'profile', 'detail'
            ]
        ]
    ],

    "mandatoryOptionsBeforeUsing-booking" => [
        'booking-allotment-entry' => [
            'empty' => [
                [
                    'label' => 'Please add building to get started'
                ],
                [
                    'label' => 'Building Slots not Added'
                ]
            ]
        ],
        'booking-slot-entry' => [
            'empty' => [
                [
                    'label' => 'Please add building to get started'
                ]
            ]
        ],
        'all' => [
            'missing_option' => [
                ['label' => 'Standard Checkin Time'],
                ['label' => 'Standard Checkout Time']
            ]
        ]
    ],

    "moduleTable-booking" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_booking",
        "cyp_booking_building",
        "cyp_booking_listing"
    ],

    "defaultColumns-booking" => [
        'entry'   => ['booking_id','occupant_name','booking_type','slot_type','slot_name','checkin_datetime','expected_checkout_datetime','checkout_datetime'],
        'list'    => ['booking_id','occupant_name','booking_type','slot_type','slot_name','checkin_datetime','expected_checkout_datetime','checkout_datetime'],
        'detail'  => ['booking_id','occupant_name','booking_type','slot_type','slot_name','checkin_datetime','expected_checkout_datetime','checkout_datetime'],
        'report'  => ['booking_id','occupant_name','booking_type','slot_type','slot_name','checkin_datetime','expected_checkout_datetime','checkout_datetime'],
        'sample_export' => ['sno','date','payee_name','paid','cash_type','additional_info','status'],
        'selected_columns' => ['date','payee_name','paid','cash_type','cash_type_remark','additional_info'],
        'building-entry' => ['building_id','building_name','building_incharge','building_incharge_phone','building_description','building_employees','options'],
    ],

    "interactiveEntity-booking" => [
        'booking'
    ],

    "mandatoryFields-booking_building-entry" => ['building_name'],
    "mandatoryFields-booking_building-entry_new" => ['building_name'],
    "mandatoryFields-booking_building-entry_update" => ['building_id'],

    "dateFields-booking_entry" => ['date'],
    "dateFields-booking_entry_new" => ['date'],
    "dateFields-booking_entry_update" => ['date'],

    "additionalFields-booking_entry" => [],
    "additionalFields-booking_entry_new" => [],
    "additionalFields-booking_entry_update" => [],

    "duplicacyCheckFields-booking_slot-entry" => ['building_id','slot_name'],
    "duplicacyCheckFields-booking_slot-entry_new" => ['building_id','slot_name'],

    "mandatoryFields-booking_slot-entry" => ['building_id','slot_type','slot_type','day_cost'],

    "mandatoryFields-booking_quickdeallot-entry" => ['checkout_datetime'],
    "dateFields-booking_transfer_entry" => ['booking_date'],
    "dateFields-booking_quickdeallot-entry" => ['booking_datetime'],

    "listFilters-booking-building-entry" => [
        "admin" => [
            'building_id_filter' => "Building/building_id/building-json",
        ],
        "portal" => [
            'building_id_filter' => "Building/building_id/building-json",
        ]
    ],

    "listFilters-booking_entry" => [
        "admin" => [
            'booking_type_filter'  => "Booking Type/booking_type/booking_type-json",
            'booking_status_filter'=> "Status/status/booking_status-json",
        ],
        "portal" => [
            'booking_type_filter'  => "Booking Type/booking_type/booking_type-json",
            'booking_status_filter'=> "Status/status/booking_status-json",
        ]
    ],

    "permissionAdmin-booking" => [
        'restricted' => [
            '2' => [['pg'=>'booking','sub_pg'=>'settings']],
            '3' => [['pg'=>'booking','sub_pg'=>'settings']]
        ],
        'allowed' => []
    ],

    "permissionPortal-booking" => [
        'restricted' => [],
        'allowed' => [
            ['pg'=>'booking','sub_pg'=>'home'],
            ['pg'=>'booking','sub_pg'=>'list'],
            ['pg'=>'booking','sub_pg'=>'detail'],
            ['pg'=>'booking','sub_pg'=>'report'],
        ]
    ]

];

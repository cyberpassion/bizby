<?php
$pg = 'transport';
$commonSettingsRoute = '/settings';

return [

'sidebar-menu' => [
    [
        'title' => ucfirst($pg),
        'href'  => "/{$pg}",
        'items' => [
            ['title' => 'Home',              'href' => "/module/{$pg}/home"],
            ['title' => 'New Vehicle Entry', 'href' => "/module/{$pg}/new"],
            ['title' => 'View List',         'href' => "/module/{$pg}/list"],
            ['title' => 'Stops',             'href' => "/module/{$pg}/stops"],
            ['title' => 'Settings',          'href' => "/module/{$pg}/settings"],
            [
                'title' => 'Plugin',
                'items' => [
                    ['title' => 'View Calendar', 'href' => "/plugin/calendar?module={$pg}"],
                ]
            ],
        ],
    ],
],
    'transport.list-filters' => [
                        "admin"	=>	[
                            'route_filter one'			=> 'Route/route_name/transport_route-list',
                            'vehicle_type_filter one'	=> 'Vehicle Type/vehicle_type/transport_vehicle_type-list',
                            'status_filter one'			=> 'Status/status/status-json',
                        ],
                        "portal" => [
                            'route_filter one'			=> 'Route/route_name/transport_route-list',
                            'vehicle_type_filter one'	=> 'Vehicle Type/vehicle_type/transport_vehicle_type-list',
                            'status_filter one'			=> 'Status/status/status-json',
                        ]
    ],
    'transport.bulk-operations' => [
                        "view:detail"		=>	"View Detail",
                        "op:remove"			=>	"Delete",
                        "op:restore"		=>	"Restore"
    ],





    'communicationTemplate-transport' => [
                        "transport_entry_new_sms"		=>	"New Transport Entry SMS",
                        "transport_entry_new_whatsapp"	=>	"New Transport Entry Whatsapp",
                        "transport_entry_new_email"		=>	"New Transport Entry Email",
    ],
    'columnNameMapping-transport' => [
                        'ptr'								=>	'SNo',
                        'route_name'						=>	'Name',
                        'registration_number'				=>	'Reg No',
                        'transport_id'						=>	'ID',
                        'transport_vehicle_id'				=>	'ID',
                        'driver_name'						=>	'Driver Name'
    ],
    'mandatoryOptionsBeforeUsing-transport' => [
                        'missing_option'	=>	[]
    ],
    'moduleTable-transport' => [
                        "cyp_term",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "cyp_upload",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_transport_vehicle",
                        "cyp_transport_vehicle_reading",
                        "cyp_transport_vehicle_stoppage",
                        "cyp_transport_vehicle_tracking"
    ],
    'defaultColumns-transport' => [
                        'entry'				=>	['transport_vehicle_id', 'route_name', 'registration_number', 'driver_name', 'remark','tags', 'status'],
                        'list'				=>	['transport_vehicle_id', 'route_name', 'registration_number', 'driver_name', 'remark','tags', 'status'],
                        'detail'			=>	['transport_vehicle_id', 'route_name', 'registration_number', 'driver_name', 'remark','tags', 'status'],
                        'report'			=>	['transport_vehicle_id', 'route_name', 'registration_number', 'driver_name', 'remark','tags', 'status'],
                        'sample_export'		=>	['sno', 'route_name', 'registration_number', 'driver_name', 'remark'],
                        'selected_columns'	=>	['route_name', 'registration_number', 'driver_name', 'remark']
    ],
    'mandatoryFields-transport-vehicle-entry-update' => ['selected-ids'],

    'dateFields-transport-entry-update' => ['insurance_renewal_date'],

    'additionalFields-transport-entry-update' => [],

    'listFilters-transport-vehicle-stoppage-entry-new' => [
                        "admin"	=>	[
                            'session_filter one'		=> 'Session/session/session-json',
                            'status_filter one'			=> 'Status/status/status-json',
                        ],
                        "portal" => [
                            'session_filter one'		=> 'Session/session/session-json',
                            'status_filter one'			=> 'Status/status/status-json',
                        ]
    ],
    'transport-vehicle-tracking-event-list' => [
                        "overspeed"		=>	"Overspeeding",
                        "sent-sos"		=>	"Sent SOS"
    ],
    'transport-vehicle-gps-update-interval' => [
                        "10"	=>	"10 seconds",
                        "15"	=>	"15 seconds",
                        "30"	=>	"30 seconds",
                        "60"	=>	"60 seconds",
                        "120"	=>	"2 minutes",
                        "180"	=>	"3 minutes",
                        "300"	=>	"5 minutes"
    ],
    'sort-student-results-by-list' => [
                        "student_name"				=>	"STUDENT NAME",
                        "father_name"				=>	"FATHER NAME",
                        "sr_no"						=>	"SR NO.",
                        "admission_id"				=>	"ADMISSION ID",
                        "dob"						=>	"DOB",
                        "current_class"				=>	"CLASS",
                        "admission_datetime"		=>	"ADMISSION DATE",
                        "punch_id"					=>	"ATTENDANCE PUNCH ID",
                        "transport_pickup_location"	=>	"TRANSPORT STOP"
    ],
    'sort-student-cash-results-by-list' => [
                        "student_name"				=>	"STUDENT NAME",
                        "father_name"				=>	"FATHER NAME",
                        "sr_no"						=>	"SR NO.",
                        "admission_id"				=>	"ADMISSION ID",
                        "dob"						=>	"DATE OF BIRTH",
                        "current_class"				=>	"CLASS",
                        "admission_datetime"		=>	"ADMISSION DATE & TIME",
                        "paid"						=>	"PAID AMOUNT",
                        "balance"					=>	"BALANCE AMOUNT",
                        "concession"				=>	"CONCESSION AMOUNT"
    ],
    'sort-student-fee-history-results-by-list' => [
                        "date"						=>	"Fee Date",
                        "cash_code"					=>	"Cash Code"
    ],
    'removal-reason' => ["Moved to Another School","Name Striked"],

    'fee-slip-copy-list' => [
                        "all"			=>	"All",
                        "parent"		=>	"Parent Copy Only",
                        "office"		=>	"Office Copy Only"
    ],
    'fee-intake-pattern-list' => [
                        "monthly"		=>	"Monthly",
                        "bimonthly"		=>	"Bi-Monthly",
                        "quarterly"		=>	"Quarterly",
                        "semesterwise"	=>	"Semester-Wise",
                        "yearly"		=>	"Yearly"
    ],
    'fee-intake-student-type-list' => ["all"=>"All Students","new"=>"New Students Only","old"=>"Old Students Only"],

    'old-new' => ["OLD","NEW"],

    'student-report-format-list' => ["tabled"=>"Tabled Report","graphical"=>"Graphical Report"],

    'student-report-type-list' => [
                        "all-studying"		=>	"All Studying Students",
                        "new-admission"		=>	"New Admission in Session",
                        "old-admission"		=>	"Old Admission in Session",
                        "promoted-only"		=>	"Previous Session Students",
                        "registration-only"	=>	"Registration Only Students",
    ],
    'cash-report-type-list' => [
                        "fee_collection_minified"					=>	"Fee Collection (Minified)",
                        "fee_collection_detailed"					=>	"Fee Collection (Detailed)",
                        "inward_outward_flow_minified"				=>	"Inward-Outward Cash Flow (Minified)",
                        "inward_outward_flow_detailed"				=>	"Inward-Outward Cash Flow (Detailed)",
                        "inward_outward_flow_minified_cumulative"	=>	"Inward-Outward Cash Flow (Minified & Cumulative)"
    ],
    'religion-list' => ["HINDU","MUSLIM","CHRISTIAN","SIKH","BUDDHIST","JAIN","OTHER","ATHIEST"],

    'exam-type-list' => [
                        "annual"		=>	"Annual",
                        "half-yearly"	=>	"Half Yearly",
                        "quarterly"		=>	"Quarterly",
                        "monthly"		=>	"Monthly",
                        "weekly"		=>	"Weekly",
                        "other"			=>	"Other"
    ],
    'affiliation-board' => [
                        "other"				=>	"OTHER",
                        "cbse"				=>	"CBSE",
                        "icse"				=>	"ICSE",
                        "up_board"			=>	"UP BOARD",
                        "rajasthan_baord"	=>	"RAJASTHAN BOARD",
                        "dbrau"				=>	"DBRAU"
    ],
    'student-cash-report-type-list' => [
                        "minified"				=>	"Total Paid Amount (Minified)",
                        "detailed-all-fee"		=>	"Total Paid Amount (Detailed Fee)",
                        "detailed-regular-fee"	=>	"Total Paid Amount (Detailed Regular Fee)"
    ],
    'student-cash-report-subtype-list' => [
                        "all"				=>	"Complete Report",
                        'dues-only'			=>	"Student with Dues",
                        "fully-paid"		=>	"Students with Full Payment Done",
                        'none-paid'			=>	"Students with No Payment Done",
                        'concession-given'	=>	"Concession Given"
    ],
    'sort-cash-results-by-list' => [
                        "date"					=>	"Date",
                        "cash_context_id"		=>	"Single Receipt No",
                        "cash_id"				=>	"Receipt No",
                        "payment_mode"			=>	"Payment Mode",
                        "fee_remark"			=>	"Remark"
    ],
    'group-results-by-list' => [
                        "current_section"					=>	"SECTION",
                        "gender"							=>	"GENDER",
                        "category"							=>	"CATEGORY",
                        "age"								=>	"AGE",
                        "current_section,gender"			=>	"SECTION & GENDER",
                        "gender,category"					=>	"GENDER & CATEGORY",
                        "current_section,gender,category"	=>	"SECTION & GENDER,CATEGORY",
                        "transport_pickup_location"			=>	"TRANSPORT PICKUP LOCATION",
                        "transport_name"					=>	"TRANSPORT ROUTE",
                        "phone_number"						=>	"PHONE NUMBER",
                        "student_name"						=>	"STUDENT NAME",
                        "father_name"						=>	"FATHER NAME",
                        "mother_name"						=>	"MOTHER NAME",
                        "father_name,mother_name"			=>	"FATHER & MOTHER NAME",
                        "status"							=>	"STATUS",
                        "category>gender"					=>	"CATEGORY > GENDER",
                        "gender>age"						=>	"GENDER > AGE",
                        "age|current_class>gender"			=>	"AGE | CLASS > GENDER"
    ],
    'bdayfilter-list' => [
                        "today"		=>	"BDAY TODAY",
                        "tomorrow"	=>	"BDAY TOMORROW",
                        "-7 days"	=>	"PAST 7 DAYS",
                        "+7 days"	=>	"NEXT 7 DAYS"
    ],
    'student-resident-type' => [
                        "day-scholar"		=>	"Day Scholar",
                        "hosteler"			=>	"Hosteler"
    ],
    'sms-type' => [
                        "registration_sms"	=>	"Registration SMS",
                        "sms_student_entry_new"		=>	"Admission SMS",
                        "birthday_sms"		=>	"Birthday SMS",
                        "tc_sms"			=>	"Transfer Certificate SMS",
                        "absentee_sms"		=>	"Absentee SMS",
                        "sms_student_feereminder_new"	=>	"Fee Reminder SMS",
                        "exammarks_sms"		=>	"Exam Marks SMS",
                        "custom_sms"		=>	"Custom SMS"
    ],
    'student-module-document-upload-type' => [
                        /*"logo"						=> "Logo",
                        "watermark"					=> "Watermark",
                        "cover-image"				=> "Cover Image",
                        "document-border"			=> "Document Border",*/
                        "principal-signature"		=> "Principal Signature",
                        "cashier-signature"			=> "Cashier Signature",
                        "fee-structure"				=> "Fee Structure Excel"
    ],
    'subject-type' => [
                        "compulsory"	=>	"Compulsory",
                        "optional"		=>	"Optional"
    ]


];
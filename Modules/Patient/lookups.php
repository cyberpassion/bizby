<?php
$pg = 'patient';
$commonSettingsRoute = '/settings';

return [
	'menuItem-patient' => [
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

    "communicationTemplate-patient" => [
                        "patient_entry_new_sms"		    =>	"New Patient Entry SMS",
                        "patient_entry_new_whatsapp"	=>	"New Patient Entry Whatsapp",
                        "patient_entry_new_email"		=>	"New Patient Entry Email",
    ],
    "columnNameMapping-patient" => [
                         'patient_name'	=>	'Name',
                        'patient_id'	=>	'ID',
                        'patient_type'	=>	'Type',
                        'building_number'	=>	'Building',
                        'room_number'		=>	'Room',
                        'bed_number'		=>	'Bed',
                        'treatment_id'	=>	'ID',
                        'treatment_date' =>	'Date',
                        'treatment_time' =>	'Time',
                        'treatment_given'	=>	'Treatment',
                        'treatment_remark'	=>	'Remark'
    ],
    "mandatoryOptionsBeforeUsing-patient" => [
                        'missing_option'	=>	[]
    ],
    "moduleTable-patient" => [
                        "cyp_term",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "cyp_upload",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_employee",
                        "cyp_patient"
    ],
    "defaultColumns-patient" => [
                        'entry'				=>	['patient_id', 'patient_name', 'phone_number', 'age','tags', 'status'],
                        'list'				=>	['patient_id', 'patient_name', 'phone_number', 'age','tags', 'status'],
                        'detail'			=>	['patient_id', 'patient_name', 'phone_number', 'age','tags', 'status'],
                        'report'			=>	['patient_id', 'patient_name', 'phone_number', 'age','tags', 'status'],
                        'sample_export'		=>	['sno', 'patient_name', 'phone_number', 'age'],
                        'selected_columns'	=>	['patient_name', 'phone_number', 'age']
    ],
    "interactiveEntity-patient" => ['patient'],

    "mandatoryFields-patient_entry_update" => ['patient_name','phone_number','age'],

    "dateFields-patient_entry_update" => ['dob','admission_date','discharge_date'],

    "duplicacyCheckFields-patient_entry_new" => ['date','patient_name','phone_number'],

    "listFilters-patient_list" => [
                        "admin"	=>	[
                            'patient_status_filter' => "Status/status/patient_status-json"
                        ],
                        "portal" => [
                            'patient_status_filter' => "Status/status/patient_status-json"
                        ]
    ],
    "permissionAdmin-patient" => [
                        'restricted'=>	[
                            '2'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']],
                            '3'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']]
                        ],
                        'allowed'	=>	[]
    ],
    "permissionRestrictedAdmin-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'settings']
    ],
    "permissionPortal-patient" => [
                        'restricted'	=>	[],
                        'allowed'		=>	[
                            ['pg' => $pg, 'sub_pg'	=>	'home'],
                            ['pg' => $pg, 'sub_pg'	=>	'profile'],
                            ['pg' => $pg, 'sub_pg'	=>	'list'],
                            ['pg' => $pg, 'sub_pg'	=>	'detail'],
                            ['pg' => $pg, 'sub_pg'	=>	'document'],
                            ['pg' => $pg, 'sub_pg'	=>	'history'],
                            ['pg' => $pg, 'sub_pg'	=>	'upload'],
                            ['pg' => $pg, 'sub_pg'	=>	'report'],
                            ['pg' => $pg, 'sub_pg'	=>	"{$pg}-report"], // logic is different in portal_page_access_barricade
                        ]
    ],
    "permissionAllowedPortal-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'home'],
                        ['pg' => $pg, 'sub_pg'	=>	'profile'],
                        ['pg' => $pg, 'sub_pg'	=>	'list'],
                        ['pg' => $pg, 'sub_pg'	=>	'detail'],
                        ['pg' => $pg, 'sub_pg'	=>	'document'],
                        ['pg' => $pg, 'sub_pg'	=>	'history'],
                        ['pg' => $pg, 'sub_pg'	=>	'upload'],
                        ['pg' => $pg, 'sub_pg'	=>	'report'],
                        ['pg' => $pg, 'sub_pg'	=>	"{$pg}-report"], // logic is different in portal_page_access_barricade
    ],
    "permissionAllowedFiltersPortal-patient" => [
                        "profile"	=>	[[ "patient_id"	=>	'{$login_id}' ]],
                        "list"		=>	[[ "patient_id"	=>	'{$login_id}' ]],
                        "report"	=>	[[ "patient_id"	=>	'{$login_id}' ]]
    ],
    "formPrefills-patient_entry_new" => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
    ],
    "patient_document-json" => [
                        'id-card' => 'ID Card',
                        'discharge-card' => 'Discharge Card',
                        'patient-invoice' => 'Patient Invoice',
    ],
    "patient_status-json" => [
                        "1"		=>	"ACTIVE",
                        "11"	=>	"Referred to Affiliate Hospital",
                        "12"	=>	"Payment Issue",
                        "2"		=>	"Relieved from this Hospital",
                        "21"	=>	"Referred to Other Hospital",
                        "22"	=>	"Deceased"
    ],
    "patient_sort_results_by-json" => ["patient_name"=>"Patient Name","age"=>"Age","father_name"=>"Father Name"],

    "patient_bulk_operation-list" => [
                        "document:registration-form"	=>	"Print Registration Form",
                        "document:id-card"				=>	'ID Card',
                        "document:discharge-card"		=>	'Discharge Card',
                        "document:patient-invoice"		=>	'Patient Invoice',
                        "document:medical-certificate"	=>	'Medical Certificate',
                        "document:transfer-certificate"	=>	'Transfer Certificate',
                        "send:sms"						=>	"Send SMS to Patient",
                        "send:email"					=>	"Send Email to Patient",
                        "op:remove"						=>	"Delete Patient",
                        "op:restore"					=>	"Restore Patient"
    ],
    "patient_slip_copy-list" => [
                        "all"			=>	"All",
                        "patient"		=>	"Patient Copy Only",
                        "office"		=>	"Office Copy Only"
    ]

     
];

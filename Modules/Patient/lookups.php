<?php
$pg = 'patient';

return [

    // -------------------------------
    // Communication Templates
    // -------------------------------
    "communicationTemplate-patient" => [
        "patient_entry_new_sms"      => "New Patient Entry SMS",
        "patient_entry_new_whatsapp" => "New Patient Entry Whatsapp",
        "patient_entry_new_email"    => "New Patient Entry Email",
    ],

    // -------------------------------
    // Column Name Mapping
    // -------------------------------
    "columnNameMapping-patient" => [
        'patient_name'     => 'Name',
        'patient_id'       => 'ID',
        'patient_type'     => 'Type',
        'building_number'  => 'Building',
        'room_number'      => 'Room',
        'bed_number'       => 'Bed',
        'treatment_id'     => 'ID',
        'treatment_date'   => 'Date',
        'treatment_time'   => 'Time',
        'treatment_given'  => 'Treatment',
        'treatment_remark' => 'Remark'
    ],

    // -------------------------------
    // Menu
    // -------------------------------
    "menuItem-patient" => [
        "admin"  => \v3\C\Module::default_features_menu_list(['name' => $pg, 'label' => ucfirst($pg)]),
        "portal" => \v3\C\Module::default_features_menu_list(['name' => $pg, 'label' => ucfirst($pg)], 'portal'),
    ],

    // -------------------------------
    // Page Structure
    // -------------------------------
    "pgStructure-patient" => [
        $pg => [
            'forms/form' => ['entry', 'upload', 'settings', 'report'],
            'lists/list' => ['list'],
            'views/view' => array_merge(array_keys([
                'id-card' => 'ID Card',
                'discharge-card' => 'Discharge Card',
                'patient-invoice' => 'Patient Invoice'
            ]), ['home','document','profile','detail','history'])
        ]
    ],

    // -------------------------------
    // Mandatory Options
    // -------------------------------
    "mandatoryOptionsBeforeUsing-patient" => [
        'missing_option' => []
    ],

    // -------------------------------
    // Module Tables
    // -------------------------------
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

    // -------------------------------
    // Default Columns
    // -------------------------------
    "defaultColumns-patient" => [
        'entry'           => ['patient_id', 'patient_name', 'phone_number', 'age','tags','status'],
        'list'            => ['patient_id', 'patient_name', 'phone_number', 'age','tags','status'],
        'detail'          => ['patient_id', 'patient_name', 'phone_number', 'age','tags','status'],
        'report'          => ['patient_id', 'patient_name', 'phone_number', 'age','tags','status'],
        'sample_export'   => ['sno','patient_name','phone_number','age'],
        'selected_columns'=> ['patient_name','phone_number','age']
    ],

    // -------------------------------
    // Interactive Entity
    // -------------------------------
    "interactiveEntity-patient" => ['patient'],

    // -------------------------------
    // Mandatory Fields
    // -------------------------------
    "mandatoryFields-patient_entry" => ['patient_name','phone_number','age'],

    // -------------------------------
    // Date Fields
    // -------------------------------
    "dateFields-patient_entry" => ['dob','admission_date','discharge_date'],

    // -------------------------------
    // Additional Fields
    // -------------------------------
    "additionalFields-patient_entry" => [],

    // -------------------------------
    // Duplicacy Check Fields
    // -------------------------------
    "duplicacyCheckFields-patient_entry" => ['date','patient_name','phone_number'],

    // -------------------------------
    // List Filters
    // -------------------------------
    "listFilters-patient_entry" => [
        "admin"  => ['patient_status_filter' => "Status/status/patient_status-json"],
        "portal" => ['patient_status_filter' => "Status/status/patient_status-json"]
    ],

    // -------------------------------
    // List Options for Admin
    // -------------------------------
    "listFilters-patient_entry_update" => [
        'admin' => [
            $pg => [
                'Edit'          => "{$pg}/entry/update",
                'Print Invoice' => "{$pg}/document",
                'Upload'        => "{$pg}/upload",
                'View Details'  => "{$pg}/detail",
                'View History'  => "{$pg}/history",
                'Download Docs' => \Route::get_endpoint_zip_download($pg),
            ]
        ]
    ],

    // -------------------------------
    // Permissions
    // -------------------------------
    "permissionAdmin-patient" => [
        'restricted'=> [
            '2' => [['pg' => $pg, 'sub_pg' => 'settings']],
            '3' => [['pg' => $pg, 'sub_pg' => 'settings']]
        ],
        'allowed' => []
    ],

    "permissionPortal-patient" => [
        'restricted' => [],
        'allowed' => [
            ['pg'=>$pg,'sub_pg'=>'home'],
            ['pg'=>$pg,'sub_pg'=>'profile'],
            ['pg'=>$pg,'sub_pg'=>'list'],
            ['pg'=>$pg,'sub_pg'=>'detail'],
            ['pg'=>$pg,'sub_pg'=>'document'],
            ['pg'=>$pg,'sub_pg'=>'history'],
            ['pg'=>$pg,'sub_pg'=>'upload'],
            ['pg'=>$pg,'sub_pg'=>'report'],
            ['pg'=>$pg,'sub_pg'=>"{$pg}-report"],
        ]
    ],

    // "permissionAllowedFiltersPortal-patient" => [
    //     "profile" => [[ "patient_id" => '{$login_id}' ]],
    //     "list"    => [[ "patient_id" => '{$login_id}' ]],
    //     "report"  => [[ "patient_id" => '{$login_id}' ]]
    // ],

    // -------------------------------
    // Form Prefills
    // -------------------------------
    "formPrefills-patient_entry" => [
        "columns" => [
            'product'      => 'default_product',
            'contact_mode' => 'default_contact_mode',
            'state'        => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

    // -------------------------------
    // Patient Documents
    // -------------------------------
    "patient_document-json" => [
        'id-card'          => 'ID Card',
        'discharge-card'   => 'Discharge Card',
        'patient-invoice'  => 'Patient Invoice',
    ],

    // -------------------------------
    // Patient Status
    // -------------------------------
    "patient_status-json" => [
        "1"  => "ACTIVE",
        "11" => "Referred to Affiliate Hospital",
        "12" => "Payment Issue",
        "2"  => "Relieved from this Hospital",
        "21" => "Referred to Other Hospital",
        "22" => "Deceased"
    ],

    // -------------------------------
    // Patient Sort Results
    // -------------------------------
    "patient_sort_results_by-json" => [
        "patient_name" => "Patient Name",
        "age"          => "Age",
        "father_name"  => "Father Name"
    ],

    // -------------------------------
    // Patient Bulk Operations
    // -------------------------------
    "patient_bulk_operation-list" => [
        "document:registration-form"    => "Print Registration Form",
        "document:id-card"              => "ID Card",
        "document:discharge-card"       => "Discharge Card",
        "document:patient-invoice"      => "Patient Invoice",
        "document:medical-certificate"  => "Medical Certificate",
        "document:transfer-certificate" => "Transfer Certificate",
        "send:sms"                      => "Send SMS to Patient",
        "send:email"                     => "Send Email to Patient",
        "op:remove"                      => "Delete Patient",
        "op:restore"                     => "Restore Patient"
    ],

    // -------------------------------
    // Slip Copies
    // -------------------------------
    "patient_slip_copy-list" => [
        "all"     => "All",
        "patient" => "Patient Copy Only",
        "office"  => "Office Copy Only"
    ],

    // -------------------------------
    // Patient Entry Dates (static)
    // -------------------------------
    "patient_entry_date-json" => [
        '2025-01-01' => '01 Jan 2025',
        '2025-01-02' => '02 Jan 2025'
    ],

    // -------------------------------
    // Patient Admission Dates (static)
    // -------------------------------
    "patient_admission_date-json" => [
        '2025-01-01' => '01 Jan 2025',
        '2025-01-02' => '02 Jan 2025'
    ]

];

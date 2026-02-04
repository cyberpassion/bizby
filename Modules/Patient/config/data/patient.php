<?php
$pg = 'patient';

return [

    /* =========================
     | Status
     ========================= */
    "patient.statuses" => [
        "1"  => "ACTIVE",
        "11" => "Referred to Affiliate Hospital",
        "12" => "Payment Issue",
        "2"  => "Relieved from this Hospital",
        "21" => "Referred to Other Hospital",
        "22" => "Deceased"
    ],

    /* =========================
     | Filters
     ========================= */
    "patient.list-filters" => [
        "admin" => [
            'patient_status_filter' => "Status/status/patient_status-json"
        ],
        "portal" => [
            'patient_status_filter' => "Status/status/patient_status-json"
        ]
    ],

    /* =========================
     | Bulk Operations
     ========================= */
    "patient.bulk-operations" => [
        "document:registration-form"   => "Print Registration Form",
        "document:id-card"             => "ID Card",
        "document:discharge-card"      => "Discharge Card",
        "document:patient-invoice"     => "Patient Invoice",
        "document:medical-certificate" => "Medical Certificate",
        "document:transfer-certificate"=> "Transfer Certificate",
        "send:sms"                     => "Send SMS to Patient",
        "send:email"                   => "Send Email to Patient",
        "op:remove"                    => "Delete Patient",
        "op:restore"                   => "Restore Patient"
    ],

    /* =========================
     | Columns
     ========================= */
    "patient.default-columns" => [
        'entry'   => ['patient_id','patient_name','phone_number','age','tags','status'],
        'list'    => ['patient_id','patient_name','phone_number','age','tags','status'],
        'detail'  => ['patient_id','patient_name','phone_number','age','tags','status'],
        'report'  => ['patient_id','patient_name','phone_number','age','tags','status'],
    ],

    "patient.report-columns" => [
        'id','name','gender','age','phone','patient_type',
        'admission_date','room_number','bed_number',
        'is_emergency_case','provisional_diagnosis','discharge_date'
    ],

    /* =========================
     | Documents
     ========================= */
    "patient.documents" => [
        'id-card'         => 'ID Card',
        'discharge-card'  => 'Discharge Card',
        'patient-invoice' => 'Patient Invoice',
    ],

    /* =========================
     | Communication Templates
     ========================= */
    "communicationTemplate-patient" => [
        "patient_entry_new_sms"      => "New Patient Entry SMS",
        "patient_entry_new_whatsapp" => "New Patient Entry Whatsapp",
        "patient_entry_new_email"    => "New Patient Entry Email",
    ],

    /* =========================
     | Column Name Mapping
     ========================= */
    "columnNameMapping-patient" => [
        'patient_id'      => 'ID',
        'patient_name'    => 'Name',
        'patient_type'    => 'Type',
        'room_number'     => 'Room',
        'bed_number'      => 'Bed',
    ],

    /* =========================
     | DB Tables
     ========================= */
    "moduleTable-patient" => [
        "terms",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_notification",
        "cyp_message",
        "cyp_patient"
    ],

    /* =========================
     | Validation & Rules
     ========================= */
    "mandatoryFields-patient-entry-update" => ['patient_name','phone_number','age'],
    "dateFields-patient-entry-update"      => ['dob','admission_date','discharge_date'],
    "duplicacyCheckFields-patient-entry-new"=> ['date','patient_name','phone_number'],

    /* =========================
     | Misc
     ========================= */
    "interactiveEntity-patient" => ['patient'],
    "patient-sort-results-by" => [
        "patient_name"=>"Patient Name",
        "age"=>"Age",
        "father_name"=>"Father Name"
    ],
    "patient-slip-copy-list" => [
        "all"     => "All",
        "patient" => "Patient Copy Only",
        "office"  => "Office Copy Only"
    ],

];

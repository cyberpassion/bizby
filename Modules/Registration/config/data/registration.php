<?php
$pg = 'registration';

return [

    /* =========================
     | CRON & AUTOMATION
     ========================= */
    "registration.crons" => [
        'registration-notification' => 'Registration Notification'
    ],

    /* =========================
     | LIST FILTERS
     ========================= */
    "registration.list-filters" => [
        "admin" => [
            'date_filter' => "Date/date/registration_date-json",
            'registration_type_filter' => "Type/type/registration_type-json",
            'registration_status_filter' => "Status/status/status-json"
        ],
        "portal" => [
            'date_filter' => "Date/date/registration_date-json",
            'registration_type_filter' => "Type/type/registration_type-json",
            'registration_status_filter' => "Status/status/status-json"
        ]
    ],

    /* =========================
     | BULK OPERATIONS
     ========================= */
    "registration.bulk-operations" => [
        "registration:detail" => "Move to",
        "view:detail"         => "View Detail",
        "op:remove"           => "Delete",
        "op:restore"          => "Restore"
    ],

    /* =========================
     | COLUMNS
     ========================= */
    "registration.default-columns" => [
        'entry'   => ['date','name','phone_number','email_id','permanent_address','registration_type','tags','status'],
        'list'    => ['date','name','phone_number','email_id','permanent_address','registration_type','tags','status'],
        'detail'  => ['date','name','phone_number','email_id','permanent_address','registration_type','tags','status'],
        'report'  => ['date','name','phone_number','email_id','permanent_address','registration_type','tags','status'],
        'sample_export' => ['sno','date','name','phone_number','email_id','permanent_address'],
        'selected_columns' => ['date','name','phone_number','email_id','permanent_address','registration_type']
    ],

    /* =========================
     | DOCUMENTS
     ========================= */
    "registration.documents" => [
        'registration-slip' => 'Registration Slip',
        'registration-form' => 'Registration Form'
    ],

    /* =========================
     | REPORT CONFIG
     ========================= */
    'registration.report-columns' => [
        'id','registration_type','session','name','gender','dob',
        'age','phone','email','category','nationality','created_at'
    ],

    /* =========================
     | OPTIONS & TYPES
     ========================= */
    'registration.registration-types' => [
        'default' => 'Default'
    ],

    "jsonOption-registration" => [
        'registration_type-json' => 'Registration Type'
    ],

    /* =========================
     | DATABASE TABLES
     ========================= */
    "moduleTable-registration" => [
        "terms",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "uploads",
        "cyp_notification",
        "cyp_message",
        "cyp_registration"
    ],

    /* =========================
     | VALIDATION
     ========================= */
    "mandatoryFields-registration-entry-update" => ['name','phone_number'],
    "dateFields-registration-public-entry-update" => ['date','dob'],

    /* =========================
     | FORM PREFILL
     ========================= */
    "formPrefills-registration-entry-new" => [
        "columns" => [
            'product' => 'default_product',
            'contact_mode' => 'default_contact_mode',
            'state' => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

    /* =========================
     | PUBLIC FLOW
     ========================= */
    "public-registration-status" => [
        "1"  => "ACTIVE",
        "11" => "PENDING APPROVAL"
    ],

    "public-registration-flow" => [
        "default" => "Default"
    ],

];

<?php
$pg = 'communication';

return [

    /* ===============================
     | Module Tables
     =============================== */
    'tables' => [
        "terms",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "uploads",
        "cyp_notification",
        "cyp_message",
    ],

    /* ===============================
     | List Filters (Admin / Portal)
     =============================== */
    'list-filters-advanced' => [
        'admin' => [
            'date_filter'            => "Date/date/communication_date-json",
            'recipient_filter'       => "Recipient/recipient_type/communication_recipient_type-json",
            'communication_mode'     => "Mode/mode/communication_mode-json",
        ],
        'portal' => [
            'date_filter'            => "Date/date/communication_date-json",
            'recipient_filter'       => "Recipient/recipient_type/communication_recipient_type-json",
            'communication_mode'     => "Mode/mode/communication_mode-json",
        ],
    ],

    /* ===============================
     | Bulk Operations
     =============================== */
    'bulk-operations' => [
        "view:detail" => "View Detail"
    ],

    /* ===============================
     | Default Columns
     =============================== */
    'default-columns' => [
        'entry'  => ['batch_id','datetime','message','mode','recipient_type','recipients','messages_count'],
        'list'   => ['batch_id','datetime','message','mode','recipient_type','recipients','messages_count'],
        'detail' => ['batch_id','datetime','message','mode','recipient_type','recipients','messages_count'],
        'report' => ['batch_id','datetime','message','mode','recipient_type','recipients','messages_count'],
    ],

    /* ===============================
     | List Columns
     =============================== */
    'list-columns' => [
        'request_id',
        'recipient_type',
        'sent_to',
        'mode',
        'service_name',
        'status',
    ],

    /* ===============================
     | Report Columns
     =============================== */
    'report-columns' => [
        'message_id',
        'request_id',
        'batch_id',
        'recipient_type',
        'recipient_id',
        'sent_to',
        'mode',
        'service_name',
        'status',
        'session',
        'created_at',
    ],

    /* ===============================
     | Simple Filters
     =============================== */
    'filters' => [
        'session',
        'recipient_type',
        'mode',
        'service_name',
        'status',
        'batch_id',
        'created_at',
    ],

    /* ===============================
     | Mandatory Fields
     =============================== */
    'mandatory-fields' => [
        'entry-update' => ['template_key']
    ],

    /* ===============================
     | Column Name Mapping
     =============================== */
    'column-name-mapping' => [
        'ptr'              => 'SNo',
        'date'             => 'Date',
        'datetime'         => 'Date & Time',
        'batch_id'         => 'ID',
        'message'          => 'Content',
        'mode'             => 'Mode',
        'messages_count'   => 'Count',
        'recipient_type'   => 'R/Type',
        'recipients'       => 'Recipients',
    ],

    /* ===============================
     | Report Types
     =============================== */
    'report-types' => [
        "singleday-messages"            => "Single Day Messages",
        "multiday-messages-with-count"  => "Multiday Messages with Count"
    ],

    /* ===============================
     | Languages
     =============================== */
    'languages' => [
        "en" => "English",
        "hi" => "Hindi",
        "bn" => "Bengali",
        "gu" => "Gujarati",
        "kn" => "Kannada",
        "ml" => "Malayalam",
        "mr" => "Marathi",
        "ne" => "Nepali",
        "pa" => "Punjabi",
        "te" => "Telugu",
        "ta" => "Tamil",
        "ur" => "Urdu"
    ],

    /* ===============================
     | Document Upload Types
     =============================== */
    'document-upload-type' => ['pdf'],
];

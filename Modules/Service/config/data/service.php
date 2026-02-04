<?php
$pg = 'service';

return [

    /* =========================
     | LIST FILTERS
     ========================= */
    'service.list-filters' => [
        "admin" => [
            'service_price_filter' => "Price/service_price/service_price-json",
            'service_type_filter'  => "Type/service_type/service_type-json"
        ],
        "portal" => [
            'service_price_filter' => "Price/service_price/service_price-json",
            'service_type_filter'  => "Type/service_type/service_type-json"
        ]
    ],

    /* =========================
     | BULK OPERATIONS
     ========================= */
    'service.bulk-operations' => [
        "view:detail"            => "View Details",
        "document:request-slip"  => "Print Request Slip",
        "document:request-report"=> "Print Request Report",
        "op:remove"              => "Delete",
        "op:restore"             => "Restore"
    ],

    /* =========================
     | DEFAULT COLUMNS
     ========================= */
    'service.default-columns' => [
        'entry'  => ['request_id','date','service_type','provided_by','service_name','requested_by_info','request_size','request_price','request_description'],
        'list'   => ['request_id','date','service_type','provided_by','service_name','requested_by_info','request_size','request_price','request_description'],
        'detail' => ['request_id','date','service_type','provided_by','service_name','requested_by_info','request_size','request_price','request_description'],
        'report' => ['request_id','date','service_type','provided_by','service_name','requested_by_info','request_size','request_price','request_description'],
        'sample_export' => ['sno','date','service_type','provided_by','service_name','requested_by_info','request_size','request_price'],
        'selected_columns' => ['date','service_type','provided_by','service_name','request_size','request_price']
    ],

    /* =========================
     | STATUS
     ========================= */
    'service.statuses' => [
        "1" => "Requested",
        "2" => "Completed"
    ],

    /* =========================
     | DOCUMENTS
     ========================= */
    'service.documents' => [
        'request-slip'     => 'Request Slip',
        'request-report'   => 'Final Report',
        'request-invoice'  => 'Invoice',
        'service-brochure' => 'Service Brochure'
    ],

    /* =========================
     | LIST / REPORT CONFIG
     ========================= */
    'service.list-columns' => [
        'request_group_id',
        'requested_by',
        'request_size',
        'request_size_unit',
        'service_price',
        'status',
    ],

    'service.report-columns' => [
        'request_group_id',
        'requested_by_type',
        'requested_by',
        'request_size',
        'request_size_unit',
        'request_description',
        'service_id',
        'service_done_by',
        'service_price',
        'gst',
        'status',
    ],

    /* =========================
     | COMMUNICATION
     ========================= */
    'communicationTemplate-service' => [
        "service_entry_new_sms"      => "New Service Entry SMS",
        "service_entry_new_whatsapp" => "New Service Entry Whatsapp",
        "service_entry_new_email"    => "New Service Entry Email",
    ],

    /* =========================
     | COLUMN MAPPING
     ========================= */
    'columnNameMapping-service' => [
        'service_id'   => 'ID',
        'service_name' => 'Name',
        'service_type' => 'Type',
        'provided_by'  => 'By'
    ],

    'columnNames-service' => [
        'unit_price' => 'price',
        'size'       => 'service_size',
        'unit'       => 'service_size_unit'
    ],

    /* =========================
     | DATABASE TABLES
     ========================= */
    'moduleTable-service' => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_saleservice",
        "cyp_service_listing"
    ],

    /* =========================
     | VALIDATION
     ========================= */
    'mandatoryFields-service-entry-update' => [
        'service_name','provided_by','service_size','price'
    ],
    'dateFields-service-entry-update' => ['date'],

    'mandatoryFields-service-request-entry-update' => [
        'date','service_id'
    ],

    /* =========================
     | DUPLICACY CHECK
     ========================= */
    'duplicacyCheckFields-service-listing-entry-update' => [
        'provided_by','service_name'
    ],
    'duplicacyCheckFields-service-request-new' => [
        'date','requested_by_type','requested_by','service_id'
    ],

    /* =========================
     | OTHER CONFIG
     ========================= */
    'service-availability-status' => [
        'in-stock'  => 'AVAILABLE',
        'out-of-stock' => 'NOT AVAILABLE'
    ],

    'service-unit' => [
        'unit','kg','session','day','visit'
    ],

    /* =========================
     | FORM PREFILL
     ========================= */
    'formPrefills-service-entry-new' => [
        "columns" => [
            'product'       => 'default_product',
            'contact_mode'  => 'default_contact_mode',
            'state'         => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

];

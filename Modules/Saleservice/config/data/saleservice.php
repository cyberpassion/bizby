<?php
$pg = 'saleservice';

return [

    /* =========================
     | CRONS
     ========================= */
    'saleservice.crons' => [
        'saleservice-duedate'  => 'Sale/Service Due Date',
        'saleservice-nextdate' => 'Sale/Service Next Date'
    ],

    /* =========================
     | LIST FILTERS
     ========================= */
    'saleservice.list-filters' => [
        "admin" => [
            'product_filter' => "Product/offering_id/offerring_id-json",
            'doneby_filter'  => "Done By/saleservice_by/employee_id-json",
            'date_filter'    => "Date/saleservice_date/saleservice_date-json",
            'nextdate_filter'=> "Next Date/range-next_date/filter_date_range-json",
            'status_filter'  => "Status/status/saleservice_status-json"
        ],
        "portal" => [
            'product_filter' => "Product/offering_id/offerring_id-json",
            'doneby_filter'  => "Done By/saleservice_by/employee_id-json",
            'date_filter'    => "Date/saleservice_date/saleservice_date-json",
            'nextdate_filter'=> "Next Date/range-next_date/filter_date_range-json",
            'status_filter'  => "Status/status/saleservice_status-json"
        ]
    ],

    /* =========================
     | BULK OPERATIONS
     ========================= */
    'saleservice.bulk-operations' => [
        "view:detail" => "View Sales/Service Details",
        "send:email"  => "Send Email",
        "send:sms"    => "Send SMS",
        "op:remove"   => "Delete",
        "op:restore"  => "Restore"
    ],

    /* =========================
     | COLUMNS
     ========================= */
    'saleservice.default-columns' => [
        'entry'   => ['saleservice_id','saleservice_date','buyer','amount','balance','payment_info','next_date','status'],
        'list'    => ['saleservice_id','saleservice_date','buyer','amount','balance','payment_info','next_date','status'],
        'detail'  => ['saleservice_id','saleservice_date','buyer','amount','balance','payment_info','next_date','status'],
        'report'  => ['saleservice_id','saleservice_date','buyer','amount','balance','payment_info','next_date','status'],
        'sample_export' => ['sno','buyer','amount','balance','payment_info'],
        'selected_columns' => ['buyer','amount','balance','payment_info']
    ],

    /* =========================
     | STATUS
     ========================= */
    'saleservice.statuses' => [
        '1'  => 'ACTIVE',
        '11' => 'EXCHANGED',
        '2'  => 'RETURNED/DELETED'
    ],

    /* =========================
     | DOCUMENTS
     ========================= */
    'saleservice.documents' => [
        'saleservice-invoice' => 'Print Invoice'
    ],

    /* =========================
     | REPORT CONFIG
     ========================= */
    'saleservice.report-columns' => [
        'invoice_prefix','invoice_number','saleservice_date','buyer_id',
        'buyer_type','category','offering_type','offering_quantity',
        'offering_unit','taxable_price','gst_percentage','total_price'
    ],

    /* =========================
     | COMMUNICATION
     ========================= */
    'communicationTemplate-saleservice' => [
        "saleservice_entry_new_sms"      => "New Sales/Service Entry SMS",
        "saleservice_entry_new_whatsapp" => "New Sales/Service Entry Whatsapp",
        "saleservice_entry_new_email"    => "New Sales/Service Entry Email",
    ],

    /* =========================
     | DATABASE TABLES
     ========================= */
    'moduleTable-saleservice' => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_saleservice"
    ],

    /* =========================
     | VALIDATION
     ========================= */
    'mandatoryFields-saleservice-entry-update' => [
        'buyer','saleservice_date','due_date'
    ],
    'dateFields-saleservice-entry-update' => [
        'saleservice_date','due_date','next_date'
    ],

    /* =========================
     | FORM PREFILL
     ========================= */
    'formPrefills-saleservice-entry-new' => [
        "columns" => [
            'product' => 'default_product',
            'contact_mode' => 'default_contact_mode',
            'state' => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

];

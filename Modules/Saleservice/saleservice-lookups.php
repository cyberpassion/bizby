<?php
$pg = 'saleservice';

return [

    // -------------------------------
    // Communication Templates
    // -------------------------------
    "communicationTemplate-saleservice" => [
        "saleservice_entry_new_sms"       => "New Sales/Service Entry SMS",
        "saleservice_entry_new_whatsapp" => "New Sales/Service Entry Whatsapp",
        "saleservice_entry_new_email"    => "New Sales/Service Entry Email",
    ],

    // -------------------------------
    // Column Name Mapping
    // -------------------------------
    "columnNameMapping-saleservice" => [
        'ptr'                   => 'SNo',
        'saleservice_id'        => 'ID',
        'saleservice_date'      => 'Date',
        'due_date'              => 'Due Date',
        'next_date'             => 'Next Date',
        'buyer_name'            => 'Name',
        'offering_name'         => 'Offering',
        'invoice_number'        => 'Invoice',
        'invoice_type'          => 'Type',
        'offering_hsn_code'     => 'HSN',
        'offering_quantity'     => 'Qty',
        'offering_price'        => 'Price',
        'taxable_price'         => 'Net Price',
        'discount_amount'       => 'Discount',
        'igst_amount'           => 'IGST Amt',
        'cgst_amount'           => 'CGST Amt',
        'sgst_amount'           => 'SGST Amt',
        'total_price'           => 'Total',
        'saleservice_type'      => 'Type',
        'saleservice_quantity'  => 'Qty',
        'payment_info'          => 'Payment Info',
        'options'               => 'Options'
    ],

    // -------------------------------
    // Column Names for User
    // -------------------------------
    "columnNames-saleservice" => [
        'type_name' => 'offering_type',
        'type_id'   => 'offering_id'
    ],

    // -------------------------------
    // Cash Types
    // -------------------------------
    "moduleCashType-saleservice" => [
        'saleservice-payment' => 'Sale & Service Payment'
    ],

    // -------------------------------
    // Menu
    // -------------------------------
    "menuItem-saleservice" => [
        "admin"  => \v3\C\Module::default_features_menu_list(['name' => $pg, 'label' => do_ucf($pg)]),
        "portal" => [
            'parent' => [
                do_ucf($pg) => [
                    \Route::to_home($pg),
                    \v4\C\UI::sidebarmenu_list($pg)
                ]
            ],
            'child' => [
                $pg => [
                    'My Purchases' => \Route::to_list($pg),
                ]
            ]
        ]
    ],

    // -------------------------------
    // Page Structure
    // -------------------------------
    "pgStructure-saleservice" => [
        $pg => [
            'forms/form'  => ['entry', 'exchange', 'cancel', 'upload', 'send-message', 'report', 'settings'],
            'lists/list'  => ['list'],
            'views/view'  => array_merge(array_keys(\v3\M\Res::get("saleservice_document-json")), ['home', 'document', 'profile', 'detail', 'history'])
        ]
    ],

    // -------------------------------
    // Cron List
    // -------------------------------
    "cronList-saleservice" => [
        'saleservice-duedate' => 'Sale/Service Due Date',
        'saleservice-nextdate' => 'Sale/Service Next Date'
    ],

    // -------------------------------
    // Mandatory Options
    // -------------------------------
    "mandatoryOptionsBeforeUsing-saleservice" => [
        'missing_option' => [
            'Official Name'      => 'official_name',
            'Official Address'   => 'official_address',
            'Invoice Prefix'     => 'saleservice_invoice_prefix',
            'GST Number'         => 'saleservice_business_gstin',
        ]
    ],

    // -------------------------------
    // Module Tables
    // -------------------------------
    "moduleTable-saleservice" => [
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

    // -------------------------------
    // Default Columns
    // -------------------------------
    "defaultColumns-saleservice" => [
        'entry'           => ['saleservice_id','saleservice_date','buyer','amount','balance','payment_info','next_date','status'],
        'list'            => ['saleservice_id','saleservice_date','buyer','amount','balance','payment_info','next_date','status'],
        'detail'          => ['saleservice_id','saleservice_date','buyer','amount','balance','payment_info','next_date','status'],
        'report'          => ['saleservice_id','saleservice_date','buyer','amount','balance','payment_info','next_date','status'],
        'sample_export'   => ['sno','buyer','amount','balance','payment_info'],
        'selected_columns'=> ['buyer','amount','balance','payment_info']
    ],

    // -------------------------------
    // List Filters
    // -------------------------------
    "listFilters-saleservice_entry" => [
        "admin" => [
            'sort one'    => "Product/offering_id/offerring_id-json",
            'saleby two'  => "Done By/saleservice_by/employee_id-json",
            'saledate two'=> "Date/saleservice_date/saleservice_date-json",
            'nextdate two'=> "Next Date/range-next_date/filter_date_range-json",
            'sort status' => "Status/status/saleservice_status-json"
        ],
        "portal" => [
            'sort one'    => "Product/offering_id/offerring_id-json",
            'saleby two'  => "Done By/saleservice_by/employee_id-json",
            'saledate two'=> "Date/saleservice_date/saleservice_date-json",
            'nextdate two'=> "Next Date/range-next_date/filter_date_range-json",
            'sort status' => "Status/status/saleservice_status-json"
        ]
    ],

    // -------------------------------
    // Mandatory Fields
    // -------------------------------
    "mandatoryFields-saleservice_entry" => ['buyer','saleservice_date','due_date'],

    // -------------------------------
    // Date Fields
    // -------------------------------
    "dateFields-saleservice_entry" => ['saleservice_date','due_date','next_date'],

    // -------------------------------
    // Additional Fields
    // -------------------------------
    "additionalFields-saleservice_entry" => [],

    // -------------------------------
    // Sales/Service Status
    // -------------------------------
    "saleservice_status-json" => [
        '1'   => 'ACTIVE',
        '11'  => 'EXCHANGED',
        '2'   => 'RETURNED/DELETED'
    ],

    // -------------------------------
    // Sales/Service Document
    // -------------------------------
    "saleservice_document-json" => [
        'saleservice-invoice' => 'Print Invoice'
    ],

    // -------------------------------
    // Product / Service Offerings
    // -------------------------------
    "saleservice_offering-json" => ['' => 'Select'],

    // -------------------------------
    // Sales/Service Bulk Operation
    // -------------------------------
    "saleservice_bulk_operation-list" => [
        "view:detail" => "View Sales/Service Details",
        "send:email"  => "Send Email",
        "send:sms"    => "Send SMS",
        "op:remove"   => "Delete",
        "op:restore"  => "Restore"
    ],

    // -------------------------------
    // Cash Report Types
    // -------------------------------
    "cash_report_type-list" => [
        "cash_collection_minified"                  => "Cash Collection (Minified)",
        "cash_collection_detailed"                  => "Cash Collection (Detailed)",
        "inward_outward_flow_minified"              => "Inward-Outward Cash Flow (Minified)",
        "inward_outward_flow_detailed"              => "Inward-Outward Cash Flow (Detailed)",
        "inward_outward_flow_minified_cumulative"  => "Inward-Outward Cash Flow (Minified & Cumulative)"
    ],

    // -------------------------------
    // Stock Price Type
    // -------------------------------
    "stock_price_type-json" => [
        'total'    => 'Total',
        'per-unit' => 'Per Unit'
    ]

];

<?php
$pg = 'saleservice';
$commonSettingsRoute = '/settings';

return [

'sidebar-menu' => [
    [
        'title' => ucfirst($pg),
        'href'  => "/{$pg}",
        'items' => [
            ['title' => 'Home',      'href' => "/module/{$pg}/home"],
            ['title' => 'Add New',   'href' => "/module/{$pg}/new"],
            ['title' => 'View List', 'href' => "/module/{$pg}/list"],
            ['title' => 'Report',    'href' => "/module/{$pg}/report"],
            ['title' => 'Settings',  'href' => "/module/{$pg}/settings"],
            [
                'title' => 'Plugin',
                'items' => [
                    ['title' => 'View Calendar', 'href' => "/plugin/calendar?module={$pg}"],
                ]
            ],
        ],
    ],
],

    'saleservice.crons' => [
                        'saleservice-duedate' 	=> 'Sale/Service Due Date',
                        'saleservice-nextdate' => 'Sale/Service Next Date'
    ],
    'saleservice.list-filters' => [
                        "admin"	=>	[
                            'sort one' => "Product/offering_id/offerring_id-json",
    //    					'sort customer' => "Customer/buyer_id/buyer_id-json s2",
                            'saleby two' => "Done By/saleservice_by/employee_id-json",
                            'saledate two' => "Date/saleservice_date/saleservice_date-json",
                            'nextdate two' => "Next Date/range-next_date/filter_date_range-json",
                            'sort status' => "Status/status/saleservice_status-json"
                        ],
                        "portal" => [
                            'sort one' => "Product/offering_id/offerring_id-json",
    //    					'sort customer' => "Customer/buyer_id/buyer_id-json s2",
                            'saleby two' => "Done By/saleservice_by/employee_id-json",
                            'saledate two' => "Date/saleservice_date/saleservice_date-json",
                            'nextdate two' => "Next Date/range-next_date/filter_date_range-json",
                            'sort status' => "Status/status/saleservice_status-json"
                        ]
    ],
    'stock.bulk-operations' => [
                        "view:detail"			=>	"Print Stock Details",
                        "op:remove"				=>	"Delete",
                        "op:restore"			=>	"Restore"
    ],
    'saleservice.bulk-operations' => [
                        "view:detail"		=>	"View Sales/Service Details",
                        "send:email"		=>	"Send Email",
                        "send:sms"			=>	"Send SMS",
                        "op:remove"			=>	"Delete",
                        "op:restore"		=>	"Restore"
    ],







    'communicationTemplate-saleservice' => [
                        "saleservice_entry_new_sms"			=>	"New Sales/Service Entry SMS",
                        "saleservice_entry_new_whatsapp"	=>	"New Sales/Service Entry Whatsapp",
                        "saleservice_entry_new_email"		=>	"New Sales/Service Entry Email",
    ],
    'columnNameMapping-saleservice' => [
                        'ptr'					=>	'SNo',
                        'saleservice_id'		=>	'ID',
                        'saleservice_date'		=>	'Date',
                        'due_date'				=>	'Due Date',
                        'next_date'				=>	'Next Date',
                        'buyer_name'			=>	'Name',
                        'offering_name'			=>	'Offering',
                        'invoice_number'		=>	'Invoice',
                        'invoice_type'			=>	'Type',
                        'offering_hsn_code'		=>	'HSN',
                        'offering_quantity'		=>	'Qty',
                        'offering_price'		=>	'Price',
                        'taxable_price'			=>	'Net Price',
                        'discount_amount'		=>	'Discount',
                        'igst_amount'			=>	'IGST Amt',
                        'cgst_amount'			=>	'CGST Amt',
                        'sgst_amount'			=>	'SGST Amt',
                        'total_price'			=>	'Total',
                        'saleservice_type'		=>	'Type',
                        'saleservice_quantity'	=>	'Qty',
                        'payment_info' 			=>	'Payment Info',
                        'options'				=>	'Options'
    ],
    'columnNames-saleservice' => [
                        'type_name'				=>	'offering_type',
                        'type_id'				=>	'offering_id'
    ],
    'moduleCashType-saleservice' => ['saleservice-payment'	=>	'Sale & Service Payment'],

    'mandatoryOptionsBeforeUsing-saleservice' => [
                        'missing_option'	=>	[
                            'Official Name'				=>	'official_name',
                            'Official Address'			=>	'official_address',
                            'Invoice Prefix'			=>	'saleservice_invoice_prefix',
                            'GST Number'				=>	'saleservice_business_gstin',
                        ]
    ],
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
    'defaultColumns-saleservice' => [
                        'entry'				=>	['saleservice_id','saleservice_date','buyer','amount','balance','payment_info','next_date','status'],
                        'list'				=>	['saleservice_id','saleservice_date','buyer','amount','balance','payment_info','next_date','status'],
                        'detail'			=>	['saleservice_id','saleservice_date','buyer','amount','balance','payment_info','next_date','status'],
                        'report'			=>	['saleservice_id','saleservice_date','buyer','amount','balance','payment_info','next_date','status'],
                        'sample_export'		=>	['sno','buyer','amount','balance','payment_info'],
                        'selected_columns'	=>	['buyer','amount','balance','payment_info']
    ],
    'listFilters-saleservice-saleservice-report-new' => [
                        "admin"	=>	[
                            'report_type_filter'	=> "Report Type/report_type/saleservice_cash_report_type-json",
                            'status_filter'			=> "Status/status/saleservice_status-json"
                        ],
                        "portal" => [
                            'report_type_filter'	=> "Report Type/report_type/saleservice_cash_report_type-json",
                            'status_filter'			=> "Status/status/saleservice_status-json"
                        ]
    ],
    'formPrefills-saleservice-entry-new' => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
    ],
    'mandatoryFields-saleservice-entry-update' => ['buyer','saleservice_date','due_date'],

    'dateFields-saleservice-entry-update' => ['saleservice_date','due_date','next_date'],

    'additionalFields-saleservice-entry-update' => [],

    'mandatoryFields-saleservice-exchange-entry-update' => ['saleservice_by'],

    'dateFields-saleservice-exchange-entry-update' => ['date'],

    'additionalFields-saleservice-exchange-entry-update' => [],

    'sales-setting' => [
                        'Module'			=>	'module-settings',
                        'Sale'				=>	'saleservice-settings'
    ],
    'product-availability-status' => [
                        'in-stock'			=>	'IN STOCK',
                        'out-of-stock'		=>	'OUT OF STOCK'
    ],
    'default-invoice-type' => ['gst-invoice'=>'GST','non-gst-invoice'=>'Simple'],

    'saleservice-status' => [
                        '1'									=>	'ACTIVE',
                        '11'								=>	'EXCHANGED',
                        '2'									=>	'RETURNED/DELETED'
    ],
    'saleservice-document' => ['saleservice-invoice'	=> 'Print Invoice'],

    'customer-group-results-by' => [
                        'buyer_type'						=>	'Buyer Type',
                        'status'							=>	'Status'
    ],
    'customer-sort-results-by' => [
                        'buyer_name'						=>	'Customer Name',
                        'buyer_id'							=>	'id'
    ],
    'customer-group-results-display-type' => ['complete_list'						=>	'COMPLETE LIST'],

    'sort-results-type' => [
                        'asc'						=>	'IN ASCENDING ORDER',
                        'desc'						=>	'IN DESCENDING ORDER'
    ],
    'saleservice-cash-report-type' => [
                        'quantity-sold'					=>	'Quantity Sold',
                        'gstr-3b'						=>	'GSTR 3B',
                        'product-sale'					=>	'Product Sale',
                        'cash-report'					=>	'Cash Report'
    ],
    'stock-price-type' => [
                        'total'										=>	'Total',
                        'per-unit'									=>	'Per Unit'
    ],
    'cash-report-type-list' => [
                        "cash_collection_minified"					=>	"Cash Collection (Minified)",
                        "cash_collection_detailed"					=>	"Cash Collection (Detailed)",
                        "inward_outward_flow_minified"				=>	"Inward-Outward Cash Flow (Minified)",
                        "inward_outward_flow_detailed"				=>	"Inward-Outward Cash Flow (Detailed)",
                        "inward_outward_flow_minified_cumulative"	=>	"Inward-Outward Cash Flow (Minified & Cumulative)"
    ]
    
];

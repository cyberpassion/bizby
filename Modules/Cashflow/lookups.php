<?php
$pg = 'cashflow';
$commonSettingsRoute = '/settings';

return [

    'menuItem-cashflow' => [
        'admin' => [
            'parent' => [
                $pg => '#',
            ],
            'child' => [
                $pg => [

                    [
                        'Expense' => [
                            ['Add New Expense'   => "/{$pg}/create"],
                            ['View Expense List' => "/{$pg}/list"],
                            ['View Report'       => "/{$pg}/report"],
                        ]
                    ],

                    [
                        'Income' => [
                            ['Add New Income'   => "/{$pg}/create"],
                            ['View Income List' => "/{$pg}/list"],
                            ['View Report'      => "/{$pg}/report"],
                        ]
                    ],

                    [
                        'Online Payments' => [
                            ['View Online Payments' => "/{$pg}/list"],
                            ['View Report'          => "/{$pg}/report"],
                            ['Settings'             => "/{$pg}/settings"],
                        ]
                    ],

                    ['Settings' => "/{$pg}/settings"],

                    [
                        'Plugin' => [
                            ['View Calendar' => "/{$pg}/calendar"],
                        ]
                    ],
                ],
            ],
        ],
    ],

    'sidebar-menu' => [
        [
            'title' => ucfirst($pg),
            'href'  => "/{$pg}",
            'items' => [

                [
                    'title' => 'Expense',
                    'items' => [
                        ['title' => 'Add New Expense',   'href' => "/module/{$pg}/new"],
                        ['title' => 'View Expense List', 'href' => "/module/{$pg}/list"],
                        ['title' => 'View Report',       'href' => "/module/{$pg}/report"],
                    ]
                ],

                [
                    'title' => 'Income',
                    'items' => [
                        ['title' => 'Add New Income',   'href' => "/module/{$pg}/new"],
                        ['title' => 'View Income List', 'href' => "/module/{$pg}/list"],
                        ['title' => 'View Report',      'href' => "/module/{$pg}/report"],
                    ]
                ],

                [
                    'title' => 'Online Payments',
                    'items' => [
                        ['title' => 'View Online Payments', 'href' => "/module/{$pg}/list"],
                        ['title' => 'View Report',          'href' => "/module/{$pg}/report"],
                        ['title' => 'Settings',             'href' => "/module/{$pg}/settings"],
                    ]
                ],

                ['title' => 'Settings', 'href' => "/module/{$pg}/settings"],

                [
                    'title' => 'Plugin',
                    'items' => [
                        ['title' => 'View Calendar', 'href' => "/module/{$pg}/calendar"],
                    ]
                ],
            ],
        ],
    ],

    "communicationTemplate-cashflow" => [
                        "cashflow_entry_new_sms"		=>	"New Cashflow Entry SMS",
                        "cashflow_entry_new_whatsapp"	=>	"New Cashflow Entry Whatsapp",
                        "cashflow_entry_new_email"		=>	"New Cashflow Entry Email",
                        "cashflow_report_new_sms"		=>	"New Cashflow Report SMS",
                        "cashflow_report_new_whatsapp"	=>	"New Cashflow Report Whatsapp",
                        "cashflow_report_new_email"		=>	"New Cashflow Report Email",
    ],
    "columnNameMapping-cashflow" => [
                        'payee_name'		=>	'Person',
                        'online_payee_name'	=>	'Person Name',
                        'paid'				=>	'Amount',
                        'cash_type'			=>	'Type',
                        'cash_type_remark'	=>	'Cash Info',
                        'additional_info'	=>	'More Info',
                        'payment_mode'		=>	'Mode',
                        'cash_id'			=>	'ID',
                        'payee_id'			=>	'Party',
                        'payment_order_id'	=>	'Order ID',
                        'payment_transaction_id'	=>	'Transaction ID',
                        'payment_confirmation' => 'Rcvd',
                        'verified_by'		=>	'Verified'
    ],
    "mandatoryOptionsBeforeUsing-cashflow" => [
                        'missing_option'	=>	[
                            'Cashflow Heads'			=>	'cashflow_head-json',
                            'Payment Modes'				=>	'payment_mode-json'
                        ]
    ],
    "jsonOption-cashflow" => [
                        'cashflow_head-json'	=>	'Cashflow Heads'
    ],
    "moduleTable-cashflow" => [
                        "terms",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "uploads",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_cash"
    ],
    "defaultColumns-cashflow" => [
                         'entry'					=>	['cash_id', 'date', 'payee_name', 'paid', 'cash_type', 'additional_info','tags', 'status'],
                        'list'					=>	['cash_id', 'date', 'payee_name', 'paid', 'cash_type', 'additional_info','tags', 'status'],
                        'detail'				=>	['cash_id', 'date', 'payee_name', 'paid', 'cash_type', 'additional_info','tags', 'status'],
                        'report'				=>	['cash_id', 'date', 'payee_name', 'paid', 'cash_type', 'additional_info','tags', 'status'],
                        'sample_export'			=>	['sno', 'date', 'payee_name', 'paid', 'cash_type', 'additional_info', 'status'],
                        'selected_columns'		=>	['date', 'payee_name', 'paid', 'cash_type', 'cash_type_remark', 'additional_info'],
                        'online-payment-list'	=>	['cash_id', 'date', 'online_payee_name', 'paid', 'payment_transaction_id', 'payment_confirmation', 'verified_by', 'status'],
    ],
    "cronList-cashflow" => ['cashflow-daycashreport' => 'Day Cash Report Message'],

    "mandatoryFields-cashflow_entry_update" => ['date','paid','remark'],

    "dateFields-cashflow_entry_update" => ['date'],

    "mandatoryFields-cashflow_payment-entry_update" => ['date','paid'],

    "dateFields-cashflow_payment-entry_update" => ['date'],

    "listFilters-cashflow_online-payment-list" => [
                        "admin"	=>	[
                            'cash_context_filter' => "Cash Context/cash_context/cashflow_context_onlinepayment-json",
                            'date_filter' => "Date/date/cashflow_date-json",
                            'status_filter' => "Status/status/status-json"
                        ],
                        "portal" => [
                             'cash_context_filter' => "Cash Context/cash_context/cashflow_context_onlinepayment-json",
                            'date_filter' => "Date/date/cashflow_date-json",
                               'status_filter' => "Status/status/status-json"
                        ]
    ],
    "listFilters-cashflow_detail_update" => [
                        'admin'	=>	array(
                            $pg			=>	[
                                'Print Voucher'	=>	"{$pg}/payment-voucher",
                                'Edit'			=>	"{$pg}/entry/update",
                                'Upload'		=>	"{$pg}/upload",
                                'View Details'	=>	"{$pg}/detail",
                                'View History'	=>	"{$pg}/history",
                            ]
                        ),
                        'portal' => []
    ],
    "listFilters-cashflow_cashflow-report_new" => [
                        "admin"	=>	[
                            'cashflow_report_type_filter'	=> "Report Type/cash_type/cashflow_report_type-json"
                        ],
                        "portal" => [
                            'cashflow_report_type_filter'	=> "Report Type/cash_type/cashflow_report_type-json"
                        ]
    ],
    "permissionAdmin-cashflow" => [
                        'restricted'=>	[
                            '2'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']],
                            '3'	=>	[['pg' => $pg, 'sub_pg'	=>	'settings']]
                        ],
                        'allowed'	=>	[]
    ],
    "permissionRestrictedAdmin-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'settings']
    ],
    "permissionPortal-cashflow" => [
                        'restricted'	=>	[],
                        'allowed'		=>	[
                            ['pg' => $pg, 'sub_pg'	=>	'home'],
                            //['pg' => $pg, 'sub_pg'	=>	'entry'],
                            ['pg' => $pg, 'sub_pg'	=>	'list'],
                            ['pg' => $pg, 'sub_pg'	=>	'report'],
                            ['pg' => $pg, 'sub_pg'	=>	'document'],
                            ['pg' => $pg, 'sub_pg'	=>	'history'],
                            //['pg' => $pg, 'sub_pg'	=>	'settings']
                        ]
    ],
    "permissionAllowedPortal-module" => [
                        ['pg' => $pg, 'sub_pg'	=>	'home'],
                        //['pg' => $pg, 'sub_pg'	=>	'entry'],
                        ['pg' => $pg, 'sub_pg'	=>	'list'],
                        ['pg' => $pg, 'sub_pg'	=>	'report'],
                        ['pg' => $pg, 'sub_pg'	=>	'document'],
                        ['pg' => $pg, 'sub_pg'	=>	'history'],
                        //['pg' => $pg, 'sub_pg'	=>	'settings']
    ],
    "permissionAllowedFiltersPortal-cashflow" => [
                        "entry"	=>	[
                            [
                                "payee_type"	=>	'{$login_type}',
                                "payee_id"		=>	'{$login_id}'
                            ],
                        ],
                        "list"	=>	[
                            [
                                "payee_type"	=>	'{$login_type}',
                                "payee_id"		=>	'{$login_id}'
                            ],
                        ],
                        "report"	=>	[
                            [
                                "payee_type"	=>	'{$login_type}',
                                "payee_id"		=>	'{$login_id}'
                            ]
                        ]
    ],
    "formPrefills-cashflow_entry_new" => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
    ],
    'cashflow_type-json' => [
                        'expense'	=>	'expense',
                        'income'	=>	'income'
    ],
    "search_column-json" => ['cash_id', 'remark', 'fee_remark', 'cash_type_remark', 'additional_info'],

    "cashflow_bulk_operation-list" => [
                        "print_voucher"			=>	"Print Voucher",
                        "view:detail"			=>	"View Detail",
                        "op:remove"				=>	"Delete",
                        "op:restore"			=>	"Restore"
    ],
    "online_payment_update_duration-json" => [
                        "instant"				=>	"Autocapture",
                        "24 hours"				=>	"1 Working Day",
                        "48 hours"				=>	"2 Working Days",
                        "48-72 hours"			=>	"2-3 Working Days"
    ],
    "cashflow_report_type-json" => ["income"=>"Income","expense"=>"Expense","all"=>"Income vs Expense"]

];

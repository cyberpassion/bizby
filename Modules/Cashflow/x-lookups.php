<?php
$pg = 'cashflow';
$commonSettingsRoute = '/settings';

return [

    'sidebar-menu' => [
    [
        'title'      => ucfirst($pg),
        'href'       => "/{$pg}",
        'permission' => "{$pg}.access",
        'items'      => [

            /* =========================
             | Dashboard
             ========================= */
            [
                'title'      => 'Dashboard',
                'href'       => "/module/{$pg}/home",
                'permission' => "{$pg}.dashboard.view",
            ],

            /* =========================
             | Expense Management
             ========================= */
            [
                'title' => 'Expenses',
                'items' => [
                    [
                        'title'      => 'Add Expense',
                        'href'       => "/module/{$pg}/new-expense",
                        'permission' => "{$pg}.expense.create",
                    ],
                    [
                        'title'      => 'View List',
                        'href'       => "/module/{$pg}/expense-list",
                        'permission' => "{$pg}.expense.view",
                    ],
                ],
            ],

            /* =========================
             | Income Management
             ========================= */
            [
                'title' => 'Income',
                'items' => [
                    [
                        'title'      => 'Add Income',
                        'href'       => "/module/{$pg}/new-income",
                        'permission' => "{$pg}.income.create",
                    ],
                    [
                        'title'      => 'View List',
                        'href'       => "/module/{$pg}/income-list",
                        'permission' => "{$pg}.income.view",
                    ],
                ],
            ],

            /* =========================
             | Payments
             ========================= */
            [
                'title' => 'Payments',
                'items' => [
                    [
                        'title'      => 'Online Payments',
                        'href'       => "/module/{$pg}/online-payment-list",
                        'permission' => "{$pg}.payment.online.view",
                    ],
                ],
            ],

            /* =========================
             | Reports
             ========================= */
            [
                'title' => 'Reports',
                'items' => [
                    [
                        'title'      => 'Cashflow Report',
                        'href'       => "/module/{$pg}/report",
                        'permission' => "{$pg}.report.cashflow",
                    ],
                ],
            ],

            /* =========================
             | Settings
             ========================= */
            [
                'title' => 'Settings',
                'items' => [
                    [
                        'title'      => 'Basic Settings',
                        'href'       => "/module/{$pg}/settings",
                        'permission' => "{$pg}.settings.basic",
                    ],
                ],
            ],

            /* =========================
             | Plugins
             ========================= */
            [
                'title' => 'Plugins',
                'items' => [
                    [
                        'title'      => 'Integrations',
                        'href'       => "/module/{$pg}/plugins",
                        'permission' => "{$pg}.plugin.manage",
                    ],
                ],
            ],
        ],
    ],
],


    "cashflow.crons" => ['cashflow-daycashreport' => 'Day Cash Report Message'],
    "cashflow.bulk-operations" => [
                        "print_voucher"			=>	"Print Voucher",
                        "view:detail"			=>	"View Detail",
                        "op:remove"				=>	"Delete",
                        "op:restore"			=>	"Restore"
    ],
    "cashflow.default-columns" => [
                         'entry'					=>	['cash_id', 'date', 'payee_name', 'paid', 'cash_type', 'additional_info','tags', 'status'],
                        'list'					=>	['cash_id', 'date', 'payee_name', 'paid', 'cash_type', 'additional_info','tags', 'status'],
                        'detail'				=>	['cash_id', 'date', 'payee_name', 'paid', 'cash_type', 'additional_info','tags', 'status'],
                        'report'				=>	['cash_id', 'date', 'payee_name', 'paid', 'cash_type', 'additional_info','tags', 'status'],
                        'sample_export'			=>	['sno', 'date', 'payee_name', 'paid', 'cash_type', 'additional_info', 'status'],
                        'selected_columns'		=>	['date', 'payee_name', 'paid', 'cash_type', 'cash_type_remark', 'additional_info'],
                        'online-payment-list'	=>	['cash_id', 'date', 'online_payee_name', 'paid', 'payment_transaction_id', 'payment_confirmation', 'verified_by', 'status'],
    ],
    "cashflow.permission-allowed-filters-portal" => [
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

    "mandatoryFields-cashflow-entry-update" => ['date','paid','remark'],

    "dateFields-cashflow-entry-update" => ['date'],

    "mandatoryFields-cashflow-payment-entry-update" => ['date','paid'],

    "dateFields-cashflow-payment-entry-update" => ['date'],

    "listFilters-cashflow-online-payment-list" => [
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
    "listFilters-cashflow-detail-update" => [
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
    "listFilters-cashflow-cashflow-report-new" => [
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
    "formPrefills-cashflow-entry-new" => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
    ],
    'cashflow-type' => [
                        'expense'	=>	'expense',
                        'income'	=>	'income'
    ],
    "search-column" => ['cash_id', 'remark', 'fee_remark', 'cash_type_remark', 'additional_info'],

    "online-payment-update-duration" => [
                        "instant"				=>	"Autocapture",
                        "24 hours"				=>	"1 Working Day",
                        "48 hours"				=>	"2 Working Days",
                        "48-72 hours"			=>	"2-3 Working Days"
    ],
    "cashflow-report-type" => ["income"=>"Income","expense"=>"Expense","all"=>"Income vs Expense"]

];

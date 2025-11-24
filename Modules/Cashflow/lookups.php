<?php
$pg = 'cashflow';

return [

    // ----------------------------
    // Communication Templates
    // ----------------------------
    'communicationTemplate-cashflow' => [
        "cashflow_entry_new_sms"        => "New Cashflow Entry SMS",
        "cashflow_entry_new_whatsapp"   => "New Cashflow Entry Whatsapp",
        "cashflow_entry_new_email"      => "New Cashflow Entry Email",
        "cashflow_report_new_sms"       => "New Cashflow Report SMS",
        "cashflow_report_new_whatsapp"  => "New Cashflow Report Whatsapp",
        "cashflow_report_new_email"     => "New Cashflow Report Email",
    ],

    // ----------------------------
    // Column Name Mapping
    // ----------------------------
    'columnNameMapping-cashflow' => [
        'payee_name'               => 'Person',
        'online_payee_name'        => 'Person Name',
        'paid'                     => 'Amount',
        'cash_type'                => 'Type',
        'cash_type_remark'         => 'Cash Info',
        'additional_info'          => 'More Info',
        'payment_mode'             => 'Mode',
        'cash_id'                  => 'ID',
        'payee_id'                 => 'Party',
        'payment_order_id'         => 'Order ID',
        'payment_transaction_id'   => 'Transaction ID',
        'payment_confirmation'     => 'Rcvd',
        'verified_by'              => 'Verified'
    ],

    // ----------------------------
    // Menu
    // ----------------------------
    'menuItem-cashflow' => [
        "admin" => [
            'parent' => [
                'Cashflow' => [Route::to_home($pg), \v4\C\UI::sidebarmenu_list($pg)]
            ],

            'child' => [
                'cashflow' => [
                    'Expense'          => Route::to_entry($pg, ['cash_type' => 'expense']),
                    'Income'           => Route::to_entry($pg, ['cash_type' => 'income']),
                    'Online Payments'  => get_link($pg . '/payment-list'),
                    'Settings'         => Route::to_settings($pg)
                ]
            ],

            'child-2' => [
                'cashflow-expense' => [
                    'Add New Expense'   => Route::to_entry($pg, ['cash_type' => 'expense']),
                    'View Expense List' => Route::to_list($pg, ['cash_type' => 'expense']),
                    'View Report'       => Route::to_report($pg, ['cash_type' => 'expense']),
                ],
                'cashflow-income' => [
                    'Add New Income'    => Route::to_entry($pg, ['cash_type' => 'income']),
                    'View Income List'  => Route::to_list($pg, ['cash_type' => 'income']),
                    'View Report'       => Route::to_report($pg, ['cash_type' => 'income']),
                ],
                'cashflow-online-payments' => [
                    'View Online Payments' => get_link($pg . '/online-payment-list'),
                    'View Report'          => Route::to_report($pg . '/online-payment-report'),
                    'Settings'             => Route::to_settings($pg . '/online-payment-settings')
                ]
            ]
        ],

        "portal" => \v3\C\Module::default_features_menu_list(['name' => $pg, 'label' => do_ucf($pg)], 'portal'),
    ],

    // ----------------------------
    // Page Structure
    // ----------------------------
    'pgStructure-cashflow' => [
        'cashflow' => [
            'forms/form' => [
                'entry', 'payment-entry', 'settings',
                'report', 'upload', 'online-payment-report',
                'online-payment-settings'
            ],
            'lists/list' => ['list', 'online-payment-list'],
            'views/view' => ['home','document','profile','detail','payment-voucher','history']
        ]
    ],

    // ----------------------------
    // Mandatory Options
    // ----------------------------
    'mandatoryOptionsBeforeUsing-cashflow' => [
        'missing_option' => [
            'Cashflow Heads' => 'cashflow_head-json',
            'Payment Modes'  => 'payment_mode-json'
        ]
    ],

    // ----------------------------
    // JSON Options
    // ----------------------------
    'jsonOption-cashflow' => [
        'cashflow_head-json' => 'Cashflow Heads'
    ],

    // ----------------------------
    // Module Tables
    // ----------------------------
    'moduleTable-cashflow' => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_cash"
    ],

    // ----------------------------
    // Default Columns
    // ----------------------------
    'defaultColumns-cashflow' => [
        'entry'                 => ['cash_id','date','payee_name','paid','cash_type','additional_info','tags','status'],
        'list'                  => ['cash_id','date','payee_name','paid','cash_type','additional_info','tags','status'],
        'detail'                => ['cash_id','date','payee_name','paid','cash_type','additional_info','tags','status'],
        'report'                => ['cash_id','date','payee_name','paid','cash_type','additional_info','tags','status'],
        'sample_export'         => ['sno','date','payee_name','paid','cash_type','additional_info','status'],
        'selected_columns'      => ['date','payee_name','paid','cash_type','cash_type_remark','additional_info'],
        'online-payment-list'   => ['cash_id','date','online_payee_name','paid','payment_transaction_id','payment_confirmation','verified_by','status'],
    ],

    // ----------------------------
    // Cron List
    // ----------------------------
    'cronList-cashflow' => [
        'cashflow-daycashreport' => 'Day Cash Report Message'
    ],

    // ----------------------------
    // Mandatory Fields
    // ----------------------------
    'mandatoryFields-cashflow_entry' => ['date','paid','remark'],
    'mandatoryFields-cashflow_payment-entry' => ['date','paid'],

    // ----------------------------
    // Date Fields
    // ----------------------------
    'dateFields-cashflow_entry' => ['date'],
    'dateFields-cashflow_payment-entry' => ['date'],

    // ----------------------------
    // Additional Fields
    // ----------------------------
    'additionalFields-cashflow_entry' => [],
    'additionalFields-cashflow_payment-entry' => [],

    // ----------------------------
    // List Filters
    // ----------------------------
    'listFilters-cashflow_entry' => [
        "admin" => [
            'cash_context_filter' => "Cash Context/cash_context/cashflow_context_onlinepayment-json",
            'date_filter' => "Date/date/cashflow_date-json",
            'status_filter' => "Status/status/status-json"
        ],
        "portal" => [
            'cash_context_filter' => "Cash Context/cash_context/cashflow_context_onlinepayment-json",
            'date_filter' => "Date/date/cashflow_date-json",
            'status_filter' => "Status/status/status-json"
        ],
    ],

    // ----------------------------
    // Row Actions
    // ----------------------------
    'listFilters-cashflow_entry_update' => [
        'admin' => [
            'cashflow' => [
                'Print Voucher' => "cashflow/payment-voucher",
                'Edit'          => "cashflow/entry/update",
                'Upload'        => "cashflow/upload",
                'View Details'  => "cashflow/detail",
                'View History'  => "cashflow/history"
            ]
        ],
        'portal' => []
    ],

    // ----------------------------
    // Report Filters
    // ----------------------------
    'listFilters-cashflow_cashflow-report' => [
        "admin" => [
            'cashflow_report_type_filter' => "Report Type/cash_type/cashflow_report_type-json"
        ],
        "portal" => [
            'cashflow_report_type_filter' => "Report Type/cash_type/cashflow_report_type-json"
        ]
    ],

    // ----------------------------
    // Permissions - Admin
    // ----------------------------
    'permissionAdmin-cashflow' => [
        'restricted' => [
            '2' => [['pg' => $pg, 'sub_pg' => 'settings']],
            '3' => [['pg' => $pg, 'sub_pg' => 'settings']],
        ],
        'allowed' => []
    ],

    // ----------------------------
    // Permissions - Portal
    // ----------------------------
    'permissionPortal-cashflow' => [
        'restricted' => [],
        'allowed' => [
            ['pg' => $pg, 'sub_pg' => 'home'],
            ['pg' => $pg, 'sub_pg' => 'list'],
            ['pg' => $pg, 'sub_pg' => 'report'],
            ['pg' => $pg, 'sub_pg' => 'document'],
            ['pg' => $pg, 'sub_pg' => 'history'],
        ]
    ],

    // ----------------------------
    // Portal Allowed Filters
    // ----------------------------
    // 'permissionAllowedFiltersPortal-cashflow' => [
    //     "entry" => [
    //         [
    //             "payee_type" => '{$login_type}',
    //             "payee_id"   => '{$login_id}'
    //         ]
    //     ],
    //     "list" => [
    //         [
    //             "payee_type" => '{$login_type}',
    //             "payee_id"   => '{$login_id}'
    //         ]
    //     ],
    //     "report" => [
    //         [
    //             "payee_type" => '{$login_type}',
    //             "payee_id"   => '{$login_id}'
    //         ]
    //     ]
    // ],

    // ----------------------------
    // Form Prefills
    // ----------------------------
    'formPrefills-cashflow_entry' => [
        "columns" => [
            'product'       => 'default_product',
            'contact_mode'  => 'default_contact_mode',
            'state'         => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

    // ----------------------------
    // Static JSON Options
    // ----------------------------
    'cashflow_type-json' => [
        'expense' => 'expense',
        'income'  => 'income'
    ],

    'search_column-json' => [
        'cash_id', 'remark', 'fee_remark',
        'cash_type_remark', 'additional_info'
    ],

    'cashflow_bulk_operation-list' => [
        "print_voucher"   => "Print Voucher",
        "view:detail"     => "View Detail",
        "op:remove"       => "Delete",
        "op:restore"      => "Restore"
    ],

    'online_payment_update_duration-json' => [
        "instant"        => "Autocapture",
        "24 hours"       => "1 Working Day",
        "48 hours"       => "2 Working Days",
        "48-72 hours"    => "2-3 Working Days"
    ],

    'cashflow_report_type-json' => [
        "income"   => "Income",
        "expense"  => "Expense",
        "all"      => "Income vs Expense"
    ],

];


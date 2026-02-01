<?php
$pg = 'vendor';
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
             | Vendor Management
             ========================= */
            [
                'title' => 'Vendors',
                'items' => [
                    [
                        'title'      => 'Add Vendor',
                        'href'       => "/module/{$pg}/new",
                        'permission' => "{$pg}.vendor.create",
                    ],
                    [
                        'title'      => 'View List',
                        'href'       => "/module/{$pg}/list",
                        'permission' => "{$pg}.vendor.view",
                    ],
                ],
            ],

            /* =========================
             | Contracts / Documents
             ========================= */
            [
                'title' => 'Contracts',
                'items' => [
                    [
                        'title'      => 'Agreements',
                        'href'       => "/module/{$pg}/agreements",
                        'permission' => "{$pg}.contract.manage",
                    ],
                    [
                        'title'      => 'Invoices',
                        'href'       => "/module/{$pg}/invoices",
                        'permission' => "{$pg}.invoice.manage",
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
                        'title'      => 'Vendor Report',
                        'href'       => "/module/{$pg}/report-vendors",
                        'permission' => "{$pg}.report.vendor",
                    ],
                    [
                        'title'      => 'Payment Report',
                        'href'       => "/module/{$pg}/report-payments",
                        'permission' => "{$pg}.report.payment",
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
                    [
                        'title'      => 'Payment Rules',
                        'href'       => "/module/{$pg}/payment-rules",
                        'permission' => "{$pg}.settings.payment",
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

    'vendor.list-filters' => [
		'admin'	=>	[
        	'vendor_status_filter one'		=> "Status/status/vendor_status-json"
        ],
        'portal' => [
        	'vendor_status_filter one'		=> "Status/status/vendor_status-json"
        ]
    ],
    'vendor.bulk-operations' => [
		'document:performance'			=>	'Performance',
		'document:agreement'			=>	'Agreement',
		'document:certificate'			=>	'Certificate',
		'document:vendor-id-card'		=>	'ID Card'
    ],
    'vendor.bulk-operations' => [
		'view:detail'		=>	"View Detail",
		'op:remove'			=>	"Delete",
		'op:restore'		=>	"Restore"
    ],
	'vendor.statuses'	=>	[
		true	=>	'Active',
		false	=>	'Deleted'
	],
  'vendor.default-columns' => [
                        'entry'				=>	['vendor_id', 'vendor_official_name', 'vendor_code', 'vendor_person', 'vendor_person_phone', 'code_attaches', 'expected_income', 'tags', 'status'],
                        'list'				=>	['vendor_id', 'vendor_official_name', 'vendor_code', 'vendor_person', 'vendor_person_phone', 'code_attaches', 'expected_income', 'tags', 'status'],
                        'detail'			=>	['vendor_id', 'vendor_official_name', 'vendor_code', 'vendor_person', 'vendor_person_phone', 'code_attaches', 'expected_income', 'tags', 'status'],
                        'report'			=>	['vendor_id', 'vendor_official_name', 'vendor_person', 'vendor_person_phone', 'code_attaches', 'expected_income', 'tags', 'status'],
                        'sample_export'		=>	['sno', 'vendor_official_name', 'vendor_official_address', 'vendor_official_email', 'vendor_official_phone', 'vendor_terms_and_condition', 'vendor_person', 'vendor_person_designation', 'vendor_person_email', 'vendor_person_phone'],
                        'selected_columns'	=>	['vendor_official_name', 'vendor_person', 'vendor_person_phone']
    ],
    'vendor.statuses' => [
                        "1"				=>	"Active",
                        "11"			=>	"Awaiting Approval",
                        "2"				=>	"Inactive",
    ],
    'vendor.documents' => [
                        'performance'					=>	'Performance',
                        'agreement'						=> 'Agreement',
                        'certificate'					=> 'Certificate',
                        'vendor-id-card'				=> 'ID Card'
    ],
    'vendor.list-columns' => [
                        'vendor_code',
                        'name',
                        'vendor_type',
                        'phone',
                        'state',
                        'status',
    ],

    'vendor.list-filters' => [
                        'vendor_type',
                        'state',
                        'district',
                        'status',
                        'vendor_parent_id',
    ],

    'vendor.report-columns' => [
                       'vendor_code',
                       'name',
                       'vendor_type',
                       'vendor_gstin',
                       'vendor_pan',
                       'phone',
                       'email',
                       'vendor_person',
                       'vendor_person_phone',
                       'state',
                       'district',
                       'incentive_percentage',
    ],

    

    'communicationTemplate-vendor' => [
                        "vendor_entry_new_sms"		=>	"New Vendor Entry SMS",
                        "vendor_entry_new_whatsapp"	=>	"New Vendor Entry Whatsapp",
                        "vendor_entry_new_email"	=>	"New Vendor Entry Email",
    ],
    'columnNameMapping-vendor' => [
                        'ptr'						=>	'SNo',
                        'date'						=>	'Date',
                        'vendor_id' 				=>	'ID',
                        'vendor_code'				=>	'V/Code',
                        'vendor_official_name'		=>	'Name',
                        'vendor_official_phone'		=>	'Phone',
                        'vendor_official_email'		=>	'Email',
                        'vendor_official_address'	=>	'Address',
                        'vendor_person'				=>	'Person',
                        'vendor_person_phone'		=>	'P/Phone',
                        'vendor_person_email'		=>	'P/Email', 
                        'code_attaches'				=>	'C/Attaches',
                        'expected_income'			=>	'Exp Income'  
    ], 
    'moduleTable-vendor' => [
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                         "cyp_upload",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_vendor"
    ], 
    'mandatoryFields-vendor-entry-update' => [
                        'vendor_official_name',
                        'vendor_official_address',
                        'vendor_official_email',
                        'vendor_official_phone',
                        'vendor_terms_and_condition',
                        'vendor_person',
                        'vendor_person_designation',
                        'vendor_person_email',
                        'vendor_person_phone'
    ],
    'dateFields-vendor-entry-update' => [],

    'additionalFields-vendor-entry-update' => [],

    'jsonFields-vendor-entry-update' => ['region'],

    'vendor-setting' => [
                       'Settings'					=>	'settings',
                       'Client Settings'			=>	['vendor','settings'],
                       'Vendor Settings'			=>	['vendor','settings']
    ],

    'listFilters-vendor-activity-list' => [
                        'admin'	=>	[
                            'vendor_status_filter one'		=> "Activity/activity/vendor_activity-json",
                            'vendor_operation_filter one'	=> "Operation/operation/vendor_operation-json"
                        ],
                        'portal' => [
                            'vendor_status_filter one'		=> "Activity/activity/vendor_activity-json",
                            'vendor_operation_filter one'	=> "Operation/operation/vendor_operation-json"
                        ]
    ],
    
    'vendor-level' => ["Silver","Gold","Platinum"],

    'interactiveEntity-vendor' => ['vendor'],


];

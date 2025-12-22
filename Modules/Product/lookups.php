<?php
$pg = 'product';
$commonSettingsRoute = '/settings';

return [
	'menuItem-product' => [
    'admin' => [
        'parent' => [
            $pg => '#',
        ],
        'child' => [
            $pg => [
                ['Add New'   => "/{$pg}/new"],
                ['View List' => "/{$pg}/list"],
                ['Report'    => "/{$pg}/report"],
                [
                    'Stock' => [
                        ['Add New'   => "/{$pg}/stock/create"],
                        ['View List' => "/{$pg}/stock/list"],
                        ['Report'    => "/{$pg}/stock/report"],
                        ['Settings'  => "/{$pg}/stock/settings"],
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
            ['title' => 'Home',      'href' => "/module/{$pg}/home"],
            ['title' => 'Add New',   'href' => "/module/{$pg}/new"],
            ['title' => 'View List', 'href' => "/module/{$pg}/list"],
            ['title' => 'Report',    'href' => "/module/{$pg}/report"],
            [
                'title' => 'Stock',
                'items' => [
                    ['title' => 'Add New',   'href' => "/module/{$pg}/stock/create"],
                    ['title' => 'View List', 'href' => "/module/{$pg}/stock/list"],
                    ['title' => 'Report',    'href' => "/module/{$pg}/stock/report"],
                    ['title' => 'Settings',  'href' => "/module/{$pg}/stock/settings"],
                ]
            ],
            ['title' => 'Settings', 'href' => "/module/{$pg}/settings"],
            [
                'title' => 'Plugin',
                'items' => [
                    ['title' => 'View Calendar', 'href' => "/plugin/calendar?module={$pg}"],
                ]
            ],
        ],
    ],
],
    'communicationTemplate-product' => [
                        "product_entry_new_sms"		    =>	"New Product Entry SMS",
                        "product_entry_new_whatsapp"	=>	"New Product Entry Whatsapp",
                        "product_entry_new_email"		=>	"New Product Entry Email",
    ],
    'columnNameMapping-product' => [
                        'product_id'		=>	'ID',
                        'product_name'		=>	'Name',
                        'product_type'		=>	'Type',
                        'brand_name'		=>	'Brand',
                        'total_quantity'	=>	'Total Qty',
                        'available_quantity' =>	'Available',
                        'sold_quantity'		=>	'Sold'
    ],
    'columnNames-product' => [
                        'unit_price'		 =>	'sale_price',
                        'size'				 =>	'product_size',
                        'unit'				 =>	'product_size_unit'
    ],
    'moduleTable-product' => [
                        "cyp_term",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "cyp_upload",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_stock",
                        "cyp_product"
    ],
    'defaultColumns-product' => [
                        'entry'				=>	['product_id', 'product_name', 'product_type', 'brand_name', 'total_quantity', 'sold_quantity', 'available_quantity', 'availability','tags', 'status'],
                        'list'				=>	['product_id', 'product_name', 'product_type', 'brand_name', 'total_quantity', 'sold_quantity', 'available_quantity', 'availability','tags', 'status'],
                        'detail'			=>	['product_id', 'product_name', 'product_type', 'brand_name', 'total_quantity', 'sold_quantity', 'available_quantity', 'availability','tags', 'status'],
                        'report'			=>	['product_id', 'product_name', 'product_type', 'brand_name', 'total_quantity', 'sold_quantity', 'available_quantity', 'availability','tags', 'status'],
                        'sample_export'		=>	['sno', 'product_name', 'brand_name','sale_price'],
                        'selected_columns'	=>	['product_id', 'product_name', 'product_type', 'brand_name', 'total_quantity', 'sold_quantity', 'available_quantity', 'availability', 'status']
    ],
    'mandatoryFields-product_entry_update' => ['product_name','sale_price'],

    'dateFields-product_entry_update' => [],

    'additionalFields-product_entry_update' => [],

    'listFilters-product_list' => [
                        "admin"	=>	[
                            'sort' => "Type/product_type/product_type-json",
                            'status' => "Avlb. Status/availability/product_availability_status-json",
                            'sort status' => "Status/status/product_status-json"
                        ],
                        "portal" => [
                            'sort' => "Type/product_type/product_type-json",
                            'status' => "Avlb. Status/availability/product_availability_status-json",
                            'sort status' => "Entry Status/status/product_status-json"
                        ]
    ],
    'formPrefills-product_entry_new' => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
    ],
    'product_document-json' => [
                        'product-brochure'		=>	'Product Brochure'
    ],
    'stock_status-json' => [
                        'in-stock'			=>	'IN STOCK',
                        'low-stock'			=>	'LOW STOCK',
                        'out-of-stock'		=>	'OUT OF STOCK'
    ],
    'product_cancel_reason-json' => [
                        1	=>	'For Customer Satisfaction',
                        11	=>	'Faulty/Defective',
                        19	=>	'Poor Quality'
    ],
    'product_group_results_by-json' => [
                        'product_type'						=>	'PRODUCT TYPE',
                        'brand_name'						=>	'BRAND NAME',
                        'total_quantity'					=>	'TOTAL STOCK',
                        'available_stock'					=>	'AVAILABLE STOCK',
                        'sold_stock'						=>	'SOLD STOCK',
                        'status'							=>	'STATUS'
    ],
    'product_sort_results_by-json' => [
                        'product_name'						=>	'PRODUCT NAME',
                        'brand_name'						=>	'BRAND NAME',
                        'total_quantity'					=>	'TOTAL STOCK',
                        'available_stock'					=>	'AVAILABLE STOCK',
                        'sold_stock'						=>	'SOLD STOCK',
    ],
    'product_group_results_display_type-json' => ['complete_list'						=>	'COMPLETE LIST'],
    'stock_price_type-json' => [
                        'total'										=>	'Total',
                        'per-unit'									=>	'Per Unit'
    ],
    'product_unit-json' => [
                        'qty'				=>	'QTY',
                        'kg'				=>	'KG'
    ],
    'product_bulk_operation-list' => [
                        "view:detail"			=>	"View Product Details",
                        "op:remove"				=>	"Delete",
                        "op:restore"			=>	"Restore"
]

];

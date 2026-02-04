<?php
$pg = 'product';
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
             | Product Management
             ========================= */
            [
                'title' => 'Products',
                'items' => [
                    [
                        'title'      => 'Add Product',
                        'href'       => "/module/{$pg}/new",
                        'permission' => "{$pg}.product.create",
                    ],
                    [
                        'title'      => 'View List',
                        'href'       => "/module/{$pg}/list",
                        'permission' => "{$pg}.product.view",
                    ],
                    [
                        'title'      => 'Report',
                        'href'       => "/module/{$pg}/report",
                        'permission' => "{$pg}.report.product",
                    ],
                ],
            ],

            /* =========================
             | Stock Management
             ========================= */
            [
                'title' => 'Stock',
                'items' => [
                    [
                        'title'      => 'Add Stock',
                        'href'       => "/module/{$pg}/stock/create",
                        'permission' => "{$pg}.stock.create",
                    ],
                    [
                        'title'      => 'Stock List',
                        'href'       => "/module/{$pg}/stock/list",
                        'permission' => "{$pg}.stock.view",
                    ],
                    [
                        'title'      => 'Stock Report',
                        'href'       => "/module/{$pg}/stock/report",
                        'permission' => "{$pg}.report.stock",
                    ],
                    [
                        'title'      => 'Stock Settings',
                        'href'       => "/module/{$pg}/stock/settings",
                        'permission' => "{$pg}.settings.stock",
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
                        'title'      => 'View Calendar',
                        'href'       => "/plugin/calendar?module={$pg}",
                        'permission' => "{$pg}.plugin.manage",
                    ],
                ],
            ],

        ],
    ],
],

    'product.list-filters' => [
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
    'product.bulk-operations' => [
                        "view:detail"			=>	"View Product Details",
                        "op:remove"				=>	"Delete",
                        "op:restore"			=>	"Restore"
    ],
    'product.default-columns' => [
                        'entry'				=>	['product_id', 'product_name', 'product_type', 'brand_name', 'total_quantity', 'sold_quantity', 'available_quantity', 'availability','tags', 'status'],
                        'list'				=>	['product_id', 'product_name', 'product_type', 'brand_name', 'total_quantity', 'sold_quantity', 'available_quantity', 'availability','tags', 'status'],
                        'detail'			=>	['product_id', 'product_name', 'product_type', 'brand_name', 'total_quantity', 'sold_quantity', 'available_quantity', 'availability','tags', 'status'],
                        'report'			=>	['product_id', 'product_name', 'product_type', 'brand_name', 'total_quantity', 'sold_quantity', 'available_quantity', 'availability','tags', 'status'],
                        'sample_export'		=>	['sno', 'product_name', 'brand_name','sale_price'],
                        'selected_columns'	=>	['product_id', 'product_name', 'product_type', 'brand_name', 'total_quantity', 'sold_quantity', 'available_quantity', 'availability', 'status']
    ],
    'stock.statuses' => [
                        'in-stock'			=>	'IN STOCK',
                        'low-stock'			=>	'LOW STOCK',
                        'out-of-stock'		=>	'OUT OF STOCK'
    ],
    'product.documents' => [
                        'product-brochure'		=>	'Product Brochure'
    ],
    
    'product.list-columns' => [
                        'id',
                        'product_name',
                        'brand_name',
                        'product_type',
                        'sale_price',
                        'available_stock',
    ],

    'product.list-filters' => [
                        'product_type',
                        'brand_name',
                        'availability',
                        'sale_price',
                        'status',
    ],

    'product.report-columns' => [
                        'id',
                        'product_type',
                        'brand_name',
                        'product_name',
                        'unit',
                        'retail_price',
                        'sale_price',
                        'total_quantity',
                        'sold_quantity',
                        'available_stock',
                        'availability',
                        'created_at',
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
    'mandatoryFields-product-entry-update' => ['product_name','sale_price'],

    'dateFields-product-entry-update' => [],

    'additionalFields-product-entry-update' => [],

    'formPrefills-product-entry-new' => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
    ],
    'product-cancel-reason' => [
                        1	=>	'For Customer Satisfaction',
                        11	=>	'Faulty/Defective',
                        19	=>	'Poor Quality'
    ],
    'product-group-results-by' => [
                        'product_type'						=>	'PRODUCT TYPE',
                        'brand_name'						=>	'BRAND NAME',
                        'total_quantity'					=>	'TOTAL STOCK',
                        'available_stock'					=>	'AVAILABLE STOCK',
                        'sold_stock'						=>	'SOLD STOCK',
                        'status'							=>	'STATUS'
    ],
    'product-sort-results-by' => [
                        'product_name'						=>	'PRODUCT NAME',
                        'brand_name'						=>	'BRAND NAME',
                        'total_quantity'					=>	'TOTAL STOCK',
                        'available_stock'					=>	'AVAILABLE STOCK',
                        'sold_stock'						=>	'SOLD STOCK',
    ],
    'product-group-results-display-type' => ['complete_list'						=>	'COMPLETE LIST'],
    'stock-price-type' => [
                        'total'										=>	'Total',
                        'per-unit'									=>	'Per Unit'
    ],
    'product-unit' => [
                        'qty'				=>	'QTY',
                        'kg'				=>	'KG'
    ],

];

<?php 
$pg = 'product';

return [

    // -------------------------------
    // Communication Templates
    // -------------------------------
    "communicationTemplate-product" => [
        "product_entry_new_sms"      => "New Product Entry SMS",
        "product_entry_new_whatsapp" => "New Product Entry Whatsapp",
        "product_entry_new_email"    => "New Product Entry Email",
    ],

    // -------------------------------
    // Column Name Mapping
    // -------------------------------
    "columnNameMapping-product" => [
        'product_id'        => 'ID',
        'product_name'      => 'Name',
        'product_type'      => 'Type',
        'brand_name'        => 'Brand',
        'total_quantity'    => 'Total Qty',
        'available_quantity'=> 'Available',
        'sold_quantity'     => 'Sold'
    ],

    // -------------------------------
    // Column Names Mapping for internal
    // -------------------------------
    "columnNames-product" => [
        'unit_price' => 'sale_price',
        'size'       => 'product_size',
        'unit'       => 'product_size_unit'
    ],

    // -------------------------------
    // Menu
    // -------------------------------
    "menuItem-product" => [
        "admin" => [
            'parent' => [
                'Product' => ['product/home', 'product/menu_list']
            ],
            'child' => [
                'product' => [
                    'Add New'      => 'product/entry',
                    'View List'    => 'product/list',
                    'View Report'  => 'product/report',
                    'Stock'        => 'stock/entry',
                    'Settings'     => 'product/settings'
                ]
            ],
            'child-2' => [
                'product-stock' => ['stock_features'] // placeholder for stock features
            ]
        ],
        "portal" => []
    ],

    // -------------------------------
    // Page Structure
    // -------------------------------
    "pgStructure-product" => [
        $pg => [
            'forms/form'  => ['entry', 'report', 'upload', 'settings'],
            'lists/list'  => ['list'],
            'views/view'  => ['product-brochure','home','document','profile','detail','history']
        ],
        'stock' => [
            'forms/form' => ['entry', 'report', 'upload', 'settings'],
            'lists/list' => ['list'],
            'views/view' => ['product-brochure','home','document','profile','detail','history']
        ]
    ],

    // -------------------------------
    // Mandatory Options
    // -------------------------------
    "mandatoryOptionsBeforeUsing-product" => [],

    // -------------------------------
    // Module Tables
    // -------------------------------
    "moduleTable-product" => [
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

    // -------------------------------
    // Default Columns
    // -------------------------------
    "defaultColumns-product" => [
        'entry'           => ['product_id','product_name','product_type','brand_name','total_quantity','sold_quantity','available_quantity','availability','tags','status'],
        'list'            => ['product_id','product_name','product_type','brand_name','total_quantity','sold_quantity','available_quantity','availability','tags','status'],
        'detail'          => ['product_id','product_name','product_type','brand_name','total_quantity','sold_quantity','available_quantity','availability','tags','status'],
        'report'          => ['product_id','product_name','product_type','brand_name','total_quantity','sold_quantity','available_quantity','availability','tags','status'],
        'sample_export'   => ['sno','product_name','brand_name','sale_price'],
        'selected_columns'=> ['product_id','product_name','product_type','brand_name','total_quantity','sold_quantity','available_quantity','availability','status']
    ],

    // -------------------------------
    // Mandatory Fields
    // -------------------------------
    "mandatoryFields-product_entry" => ['product_name','sale_price'],

    // -------------------------------
    // Date Fields
    // -------------------------------
    "dateFields-product_entry" => [],

    // -------------------------------
    // Additional Fields
    // -------------------------------
    "additionalFields-product_entry" => [],

    // -------------------------------
    // List Filters
    // -------------------------------
    "listFilters-product_entry" => [
        "admin" => [
            'sort'       => "Type/product_type/product_type-json",
            'status'     => "Avlb. Status/availability/product_availability_status-json",
            'sort status'=> "Status/status/product_status-json"
        ],
        "portal" => [
            'sort'       => "Type/product_type/product_type-json",
            'status'     => "Avlb. Status/availability/product_availability_status-json",
            'sort status'=> "Entry Status/status/product_status-json"
        ]
    ],

    "listFilters-product_entry_update" => [
        'admin' => [
            $pg => [
                'Edit'         => "product/entry/update",
                'Add Stock'    => "stock/entry",
                'Upload'       => "product/upload",
                'Print'        => "product/document",
                'View Details' => "product/detail",
                'View History' => "product/history",
                '+Doc Template'=> ['path'=>'advancedinfo/entry','params'=>['info_type'=>'product','info_subtype'=>'entry']],
                'All Doc Templates'=> ['path'=>'product/document/template','params'=>['info_type'=>'product','info_subtype'=>'entry']],
                'Download Docs' => 'download/product_zip'
            ]
        ]
    ],

    // -------------------------------
    // Permissions
    // -------------------------------
    "permissionAdmin-product" => [
        'restricted'=> [
            '2' => [['pg'=>$pg,'sub_pg'=>'settings']],
            '3' => [['pg'=>$pg,'sub_pg'=>'settings']]
        ],
        'allowed' => []
    ],

    "permissionPortal-product" => [
        'restricted'=> [],
        'allowed' => [
            ['pg'=>$pg,'sub_pg'=>'home'],
            ['pg'=>$pg,'sub_pg'=>'entry'],
            ['pg'=>$pg,'sub_pg'=>'list'],
            ['pg'=>$pg,'sub_pg'=>'detail'],
            ['pg'=>$pg,'sub_pg'=>'report'],
            ['pg'=>$pg,'sub_pg'=>"{$pg}-report"]
        ]
    ],

    // "permissionAllowedFiltersPortal-product" => [
    //     "entry" => [['generated_by'=>'employee-{$login_id}','contact_by'=>'employee-{$login_id}']],
    //     "list"  => [['generated_by'=>'employee-{$login_id}','contact_by'=>'employee-{$login_id}']],
    //     "report"=> [['generated_by'=>'employee-{$login_id}','contact_by'=>'employee-{$login_id}']]
    // ],

    // -------------------------------
    // Form Prefills
    // -------------------------------
    "formPrefills-product_entry" => [
        "columns" => [
            'product'      => 'default_product',
            'contact_mode' => 'default_contact_mode',
            'state'        => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

    // -------------------------------
    // Product Documents
    // -------------------------------
    "product_document-json" => [
        'product-brochure' => 'Product Brochure'
    ],

    // -------------------------------
    // Product Statuses
    // -------------------------------
    "product_availability_status-json" => [
        'in-stock'    => 'IN STOCK',
        'low-stock'   => 'LOW STOCK',
        'out-of-stock'=> 'OUT OF STOCK'
    ],

    "product_cancel_reason-json" => [
        1  => 'For Customer Satisfaction',
        11 => 'Faulty/Defective',
        19 => 'Poor Quality'
    ],

    "product_status-json" => [
        1 => 'Active',
        2 => 'Inactive'
    ],

    // -------------------------------
    // Product Sort & Group Options
    // -------------------------------
    "product_group_results_by-json" => [
        'product_type'    => 'PRODUCT TYPE',
        'brand_name'      => 'BRAND NAME',
        'total_quantity'  => 'TOTAL STOCK',
        'available_stock' => 'AVAILABLE STOCK',
        'sold_stock'      => 'SOLD STOCK',
        'status'          => 'STATUS'
    ],

    "product_sort_results_by-json" => [
        'product_name'    => 'PRODUCT NAME',
        'brand_name'      => 'BRAND NAME',
        'total_quantity'  => 'TOTAL STOCK',
        'available_stock' => 'AVAILABLE STOCK',
        'sold_stock'      => 'SOLD STOCK'
    ],

    "product_group_results_display_type-json" => [
        'complete_list' => 'COMPLETE LIST'
    ],

    "stock_price_type-json" => [
        'total'    => 'Total',
        'per-unit' => 'Per Unit'
    ],

    "product_unit-json" => [
        'qty' => 'QTY',
        'kg'  => 'KG'
    ],

    // -------------------------------
    // Product Bulk Operation
    // -------------------------------
    "product_bulk_operation-list" => [
        "view:detail" => "View Product Details",
        "op:remove"   => "Delete",
        "op:restore"  => "Restore"
    ]
];

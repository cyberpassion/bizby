<?php
$pg = 'product';

return [

    /* =========================
     | Filters
     ========================= */
    'product.list-filters' => [
        "admin" => [
            'sort'        => "Type/product_type/product_type-json",
            'status'      => "Avlb. Status/availability/product_availability_status-json",
            'sort status' => "Status/status/product_status-json"
        ],
        "portal" => [
            'sort'        => "Type/product_type/product_type-json",
            'status'      => "Avlb. Status/availability/product_availability_status-json",
            'sort status' => "Entry Status/status/product_status-json"
        ]
    ],

    /* =========================
     | Bulk Operations
     ========================= */
    'product.bulk-operations' => [
        "view:detail" => "View Product Details",
        "op:remove"  => "Delete",
        "op:restore" => "Restore"
    ],

    /* =========================
     | Default Columns
     ========================= */
    'product.default-columns' => [
        'entry'  => ['product_id','product_name','product_type','brand_name','total_quantity','sold_quantity','available_quantity','availability','tags','status'],
        'list'   => ['product_id','product_name','product_type','brand_name','total_quantity','sold_quantity','available_quantity','availability','tags','status'],
        'detail' => ['product_id','product_name','product_type','brand_name','total_quantity','sold_quantity','available_quantity','availability','tags','status'],
        'report' => ['product_id','product_name','product_type','brand_name','total_quantity','sold_quantity','available_quantity','availability','tags','status'],
    ],

    /* =========================
     | Stock Status
     ========================= */
    'stock.statuses' => [
        'in-stock'      => 'IN STOCK',
        'low-stock'     => 'LOW STOCK',
        'out-of-stock'  => 'OUT OF STOCK'
    ],

    /* =========================
     | List & Report Columns
     ========================= */
    'product.list-columns' => [
        'id','product_name','brand_name','product_type','sale_price','available_stock'
    ],

    'product.report-columns' => [
        'id','product_type','brand_name','product_name','unit',
        'retail_price','sale_price','total_quantity',
        'sold_quantity','available_stock','availability','created_at'
    ],

    /* =========================
     | Documents
     ========================= */
    'product.documents' => [
        'product-brochure' => 'Product Brochure'
    ],

    /* =========================
     | Communication Templates
     ========================= */
    'communicationTemplate-product' => [
        "product_entry_new_sms"      => "New Product Entry SMS",
        "product_entry_new_whatsapp" => "New Product Entry Whatsapp",
        "product_entry_new_email"    => "New Product Entry Email",
    ],

    /* =========================
     | Column Mapping
     ========================= */
    'columnNameMapping-product' => [
        'product_id'          => 'ID',
        'product_name'        => 'Name',
        'product_type'        => 'Type',
        'brand_name'          => 'Brand',
        'total_quantity'      => 'Total Qty',
        'available_quantity'  => 'Available',
        'sold_quantity'       => 'Sold'
    ],

    'columnNames-product' => [
        'unit_price' => 'sale_price',
        'size'       => 'product_size',
        'unit'       => 'product_size_unit'
    ],

    /* =========================
     | Database Tables
     ========================= */
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

    /* =========================
     | Validation & Rules
     ========================= */
    'mandatoryFields-product-entry-update' => ['product_name','sale_price'],
    'dateFields-product-entry-update'      => [],
    'additionalFields-product-entry-update'=> [],

    /* =========================
     | Form Prefill
     ========================= */
    'formPrefills-product-entry-new' => [
        "columns" => [
            'product'      => 'default_product',
            'contact_mode' => 'default_contact_mode',
            'state'        => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

    /* =========================
     | Misc
     ========================= */
    'product-cancel-reason' => [
        1  => 'For Customer Satisfaction',
        11 => 'Faulty/Defective',
        19 => 'Poor Quality'
    ],

    'product-group-results-by' => [
        'product_type'     => 'PRODUCT TYPE',
        'brand_name'       => 'BRAND NAME',
        'total_quantity'   => 'TOTAL STOCK',
        'available_stock'  => 'AVAILABLE STOCK',
        'sold_stock'       => 'SOLD STOCK',
        'status'           => 'STATUS'
    ],

    'product-sort-results-by' => [
        'product_name'     => 'PRODUCT NAME',
        'brand_name'       => 'BRAND NAME',
        'total_quantity'   => 'TOTAL STOCK',
        'available_stock'  => 'AVAILABLE STOCK',
        'sold_stock'       => 'SOLD STOCK'
    ],

    'product-group-results-display-type' => [
        'complete_list' => 'COMPLETE LIST'
    ],

    'stock-price-type' => [
        'total'    => 'Total',
        'per-unit' => 'Per Unit'
    ],

    'product-unit' => [
        'qty' => 'QTY',
        'kg'  => 'KG'
    ],

];

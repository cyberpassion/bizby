<?php
$pg = 'inventory';

return [

	// Bulk Operations
    'bulk-operations' => [
        'document:inventory-slip' => 'Print Inventory Slip',
        'send:sms'                   => 'Send Inventory SMS',
        'send:email'                 => 'Send Inventory Email',
        'op:remove'                  => 'Delete Inventory',
        'op:restore'                 => 'Restore Inventory',
    ],

	// Default Columns
    'columns' => [

    /* =========================================================
     | LIST VIEW
     ========================================================= */
    'list' => [
        'code'                => 'Code',
        'product_id_label'    => 'Product',
        'center_id_label'     => 'Center',
        'minimum_threshold'   => 'Min Threshold',
        'maximum_threshold'   => 'Max Threshold',
        'current_stock'       => 'Current Stock',
        'stock_status'        => 'Stock Status',
        'status_label'        => 'Status',
    ],

    /* =========================================================
     | REPORT VIEW
     ========================================================= */
    'report' => [
        'code'                => 'Code',
        'product_id_label'    => 'Product',
        'center_id_label'     => 'Center',
        'minimum_threshold'   => 'Min Threshold',
        'maximum_threshold'   => 'Max Threshold',
        'current_stock'       => 'Current Stock',
        'stock_status'        => 'Stock Status',
        'status_label'        => 'Status',
    ],

    /* =========================================================
     | DETAIL VIEW
     ========================================================= */
    'detail' => [

        /* CORE */
        'id'                  => 'ID',
        'code'                => 'Code',

        /* RELATION */
        'product_id'          => 'Product ID',
        'product_id_label'    => 'Product',
        'center_id'           => 'Center ID',
        'center_id_label'     => 'Center',

        /* STOCK RULES */
        'minimum_threshold'   => 'Min Threshold',
        'maximum_threshold'   => 'Max Threshold',

        /* STOCK */
        'current_stock'       => 'Current Stock',
        'stock_status'        => 'Stock Status',

        /* STATUS */
        'status'              => 'Status Value',
        'status_label'        => 'Status',

        /* SYSTEM */
        'created_at'          => 'Created At',
        'updated_at'          => 'Updated At',
    ],

    /* =========================================================
     | EXPORT
     ========================================================= */
    'sample_export' => [
        'code',
        'product_id_label',
        'center_id_label',
        'minimum_threshold',
        'maximum_threshold',
        'current_stock',
        'stock_status',
        'status_label'
    ],

    /* =========================================================
     | SELECTABLE
     ========================================================= */
    'selectable' => [
        'code',
        'product_id_label',
        'center_id_label',
        'current_stock',
        'stock_status',
        'status_label'
    ],
],

    // Cron Jobs / Documents
    'crons' => [
        'inventory-visitreminder' => 'Inventory Visit Reminder',
    ],

	// Documents
    'documents' => [
        'inventory-slip' => 'Inventory Slip'
    ],

	// Status
    'statuses' => [
	    '1' => 'Available',
    	'2' => 'Reserved',
	    '3' => 'Out of Stock',
    	'4' => 'Damaged',
    	'5' => 'Expired',
    	'6' => 'Deleted'
	],

	// Uploads
    'uploads' => [
        'image' => 'Image',
    ],

	"transaction-types" => [
	    "in"         => "Stock In",
    	"out"        => "Stock Out",
    	"adjustment" => "Adjustment",
    	"transfer"   => "Transfer"
	],

	"reason-types" => [
	    "purchase" => "Purchase",
    	"sale"     => "Sale",
	    "opening"  => "Opening Stock",
    	"manual"   => "Manual Entry",
    	"damage"   => "Damage / Loss"
	],

];

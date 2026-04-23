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
        'code',
        'product_id_label',
        'center_id_label',
        'minimum_threshold',
        'maximum_threshold',
        'current_stock',
        'stock_status', // computed
        'status_label'
    ],

    /* =========================================================
     | REPORT VIEW
     ========================================================= */
    'report' => [
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
     | DETAIL VIEW
     ========================================================= */
    'detail' => [

        /* CORE */
        'id',
        'code',

        /* RELATION */
        'product_id',
        'product_id_label',
        'center_id',
        'center_id_label',

        /* STOCK RULES */
        'minimum_threshold',
        'maximum_threshold',

        /* STOCK */
        'current_stock',
        'stock_status',

        /* STATUS */
        'status',
        'status_label',

        /* SYSTEM */
        'created_at',
        'updated_at',
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

	"reference-types" => [
	    "purchase" => "Purchase",
    	"sale"     => "Sale",
	    "opening"  => "Opening Stock",
    	"manual"   => "Manual Entry",
    	"damage"   => "Damage / Loss"
	],

];

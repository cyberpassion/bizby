<?php
$pg = 'asset';

return [

	// Bulk Operations
    'bulk-operations' => [
        'document:asset-slip' => 'Print Asset Slip',
        'send:sms'                   => 'Send Asset SMS',
        'send:email'                 => 'Send Asset Email',
        'op:remove'                  => 'Delete Asset',
        'op:restore'                 => 'Restore Asset',
    ],

	// Default Columns
    'columns' => [

    /* =========================================================
     | LIST VIEW (Fast scanning, operational)
     ========================================================= */

    'list' => [
        'id',
		'center_id_label',
        'asset_code',
		'name',
		'serial_number',
		'purchase_date',
		'status_label'
    ],

    /* =========================================================
     | REPORT VIEW (Business intelligence)
     ========================================================= */

    'report' => [
        'id',
		'center_id_label',
        'asset_code',
		'name',
		'serial_number',
		'purchase_date',
		'status_label'
    ],

    /* =========================================================
     | DETAIL VIEW (Maximum context)
     ========================================================= */

    'detail' => [

    /* =========================
     | CORE
     ========================= */
    'id',
	'center_id_label',
    'asset_code',
    'name',
    'type',

    /* =========================
     | IDENTIFICATION
     ========================= */
    'serial_number',

    /* =========================
     | PURCHASE
     ========================= */
    'purchase_date',
    'purchase_cost',
    'vendor',
    'vendor_label',

    /* =========================
     | ASSIGNMENT
     ========================= */
    'center_id',
    'center_id_label',
    'assigned_to',
    'assigned_to_label',

    /* =========================
     | SERVICE / MAINTENANCE
     ========================= */
    'last_service_date',
    'next_service_date',

    /* =========================
     | LIFECYCLE
     ========================= */
    'warranty_expiry',
    'useful_life_months',

    /* =========================
     | STATUS
     ========================= */
    'status_label',

    /* =========================
     | EXTRA
     ========================= */
    'notes',

    /* =========================
     | SYSTEM (optional)
     ========================= */
    'created_at',
    'updated_at',
],

    /* =========================================================
     | SAMPLE EXPORT (Excel / CSV safe)
     ========================================================= */

    'sample_export' => [
        'id',
        'asset_code',
		'name',
		'serial_number',
		'purchase_date',
		'status_label'
    ],

    /* =========================================================
     | USER SELECTABLE COLUMNS
     ========================================================= */

    'selectable' => [
        'id',
        'asset_code',
		'name',
		'serial_number',
		'purchase_date',
		'status_label'
    ],
],

    // Cron Jobs / Documents
    'crons' => [
        'asset-visitreminder' => 'Asset Visit Reminder',
    ],

	// Documents
    'documents' => [
        'detail' => 'Asset Detail',
        'asset-slip' => 'Asset Slip'
    ],

	// Status
    'statuses' => [
	    '1' => 'Active',
    	'2' => 'In Maintenance',
    	'3' => 'Inactive',
    	'4' => 'Disposed',
    	'5' => 'Deleted'
	],

	// Uploads
    'uploads' => [
		'image' => 'Asset Image',
	    'purchase_invoice' => 'Purchase Invoice',
    	'warranty_certificate' => 'Warranty Certificate',
    	'asset_registration_document' => 'Asset Registration Document',
	    'insurance_papers' => 'Insurance Papers',
    	'maintenance_records' => 'Maintenance Records',
    	'service_reports' => 'Service Reports',
    	'calibration_certificate' => 'Calibration Certificate (for equipment)',
    	'qr_barcode_document' => 'QR Code / Barcode Document',
	],

	/* =========================
     | CUSTOM SPECIFIC FOR MODULE
     ========================= */

	// Default Intervals
	'default-intervals' => [
        '5'  => '5 Minutes',
        '10' => '10 Minutes',
        '15' => '15 Minutes',
        '20' => '20 Minutes',
        '30' => '30 Minutes',
    ],

	// Next Days
    'next-days' => [
        '3 d'  => '3 Days',
        '4 d'  => '4 Days',
        '5 d'  => '5 Days',
        '6 d'  => '6 Days',
        '7 d'  => '7 Days',
        '10 d' => '10 Days',
        '12 d' => '12 Days',
        '15 d' => '15 Days',
        '30 d' => '30 Days',
    ],

];

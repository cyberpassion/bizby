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
    'id'               => 'ID',
    'asset_code'       => 'Code',
	'name'             => 'Name',
	'type_label'	   => 'Type',
	'center_name'  	   => 'Center',
    'status_label'     => 'Status',
],

    /* =========================================================
     | REPORT VIEW (Business intelligence)
     ========================================================= */

    'report' => [
    'id'               => 'ID',
    'asset_code'       => 'Code',
	'center_name'  	   => 'Center',
	'type_label'	   => 'Type',
    'name'             => 'Name',
    'serial_number'    => 'Serial Number',
    'purchase_date'    => 'Purchase Date',
	'purchase_cost'    => 'Purchase Cost',
    'status_label'     => 'Status',
],

    /* =========================================================
     | DETAIL VIEW (Maximum context)
     ========================================================= */

    'detail' => [

    /* =========================
     | CORE
     ========================= */
    'id'               => 'ID',
    'center_name'  => 'Center',
    'asset_code'       => 'Code',
    'name'             => 'Name',
    'type'             => 'Type',

    /* =========================
     | IDENTIFICATION
     ========================= */
    'serial_number'    => 'Serial Number',

    /* =========================
     | PURCHASE
     ========================= */
    'purchase_date'    => 'Purchase Date',
    'purchase_cost'    => 'Purchase Cost',
    'vendor'           => 'Vendor',
    'vendor_label'     => 'Vendor Name',

    /* =========================
     | ASSIGNMENT
     ========================= */
    'center_id'        => 'Center ID',
    'center_name'  => 'Center',
    'assigned_to'      => 'Assigned To',
    'assigned_to_label'=> 'Assigned To Name',

    /* =========================
     | SERVICE / MAINTENANCE
     ========================= */
    'last_service_date'=> 'Last Service Date',
    'next_service_date'=> 'Next Service Date',

    /* =========================
     | LIFECYCLE
     ========================= */
    'warranty_expiry'  => 'Warranty Expiry',
    'useful_life_months'=> 'Useful Life (Months)',

    /* =========================
     | STATUS
     ========================= */
    'status_label'     => 'Status',

    /* =========================
     | EXTRA
     ========================= */
    'notes'            => 'Notes',

    /* =========================
     | SYSTEM
     ========================= */
    'created_at'       => 'Created At',
    'updated_at'       => 'Updated At',
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

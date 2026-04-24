<?php
$pg = 'listing';

return [

	// Bulk Operations
    "bulk-operations" => [
        "view:detail" => "View Listing Details",
        "op:remove"   => "Delete Listing",
        "op:restore"  => "Restore Listing",
    ],

	// Default Columns
    "columns" => [
        'list'   => [
			'id'	=>	'ID',
			'name' => 'Business',
    'category_label' => 'Category',
    'city' => 'City',
    'state' => 'State',
    'phone' => 'Phone',
    'is_verified' => 'Verified',
    'is_featured' => 'Featured',
    'valid_till' => 'Valid Till',
    'status_label' => 'Status'],
        'detail' => [
			'id'	=>	'ID',
			'name' => 'Business',
    'category_label' => 'Category',
    'city' => 'City',
    'state' => 'State',
    'phone' => 'Phone',
    'is_verified' => 'Verified',
    'is_featured' => 'Featured',
    'valid_till' => 'Valid Till',
    'status_label' => 'Status'],
        'report' => [
			'id'	=>	'ID',
			'name' => 'Business',
    'category_label' => 'Category',
    'city' => 'City',
    'state' => 'State',
    'phone' => 'Phone',
    'is_verified' => 'Verified',
    'is_featured' => 'Featured',
    'valid_till' => 'Valid Till',
    'status_label' => 'Status'],
        'sample_export'   => [],
        'selected_columns'=> [],
    ],

	// Crons
	"crons" => [
        'listing-followupreminders' => 'Listing Upcoming Followups'
    ],

	// Statuses
    "statuses" => [
	    "1"  => "ACTIVE",
    	"2"  => "INACTIVE",
    	"3"  => "PENDING",
    	"4"  => "REJECTED",
    	"5"  => "DELETED",
	],

];
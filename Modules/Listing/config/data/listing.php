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
        'entry'  => ['date','listing_id','listing_name','category','phone_number','email','locality','place','state','info','tags','status'],
        'list'   => ['date','listing_id','listing_name','category','phone_number','email','locality','place','state','info','tags','status'],
        'detail' => ['date','listing_id','listing_name','category','phone_number','email','locality','place','state','info','tags','status'],
        'report' => ['date','listing_id','listing_name','category','phone_number','email','locality','place','state','info','tags','status'],
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
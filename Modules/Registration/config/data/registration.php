<?php
$pg = 'registration';

return [

	// Bulk Operations
    "bulk-operations" => [
        "registration:detail" => "Move to",
        "view:detail"         => "View Detail",
        "op:remove"           => "Delete",
        "op:restore"          => "Restore"
    ],

	// Default Columns
    "columns" => [
        'entry'   => ['date','name','phone_number','email_id','permanent_address','registration_type','tags','status'],
        'list'    => ['date','name','phone_number','email_id','permanent_address','registration_type','tags','status'],
        'detail'  => ['date','name','phone_number','email_id','permanent_address','registration_type','tags','status'],
        'report'  => ['date','name','phone_number','email_id','permanent_address','registration_type','tags','status'],
        'sample_export' => ['sno','date','name','phone_number','email_id','permanent_address'],
        'selected_columns' => ['date','name','phone_number','email_id','permanent_address','registration_type']
    ],

    // Crons
    "crons" => [
        'registration-notification' => 'Registration Notification'
    ],

    // Documents
    "documents" => [
        'registration-slip' => 'Registration Slip',
        'registration-form' => 'Registration Form'
    ],

	// Status
    'statuses' => [
        '1'  => 'Active',
        '2'  => 'Deleted'
    ],

	// Uploads
    'uploads' => [
        'image' => 'Image',
    ],

];

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
       'list' => [
    'date'                => 'Date',
    'name'                => 'Name',
    'phone_number'        => 'Phone Number',
    'email_id'            => 'Email',
    'permanent_address'   => 'Address',
    'registration_type'   => 'Registration Type',
    'tags'                => 'Tags',
    'status_label'        => 'Status',
],
'detail' => [
    'date'                => 'Date',
    'name'                => 'Name',
    'phone_number'        => 'Phone Number',
    'email_id'            => 'Email',
    'permanent_address'   => 'Address',
    'registration_type'   => 'Registration Type',
    'tags'                => 'Tags',
    'status_label'        => 'Status',
],
'report' => [
    'date'                => 'Date',
    'name'                => 'Name',
    'phone_number'        => 'Phone Number',
    'email_id'            => 'Email',
    'permanent_address'   => 'Address',
    'registration_type'   => 'Registration Type',
    'tags'                => 'Tags',
    'status_label'        => 'Status',
],
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

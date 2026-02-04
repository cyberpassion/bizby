<?php

$pg = 'consultation';

return [

    /*
    |--------------------------------------------------------------------------
    | List UI (simple backend keys)
    |--------------------------------------------------------------------------
    */
    'list' => [
        'columns' => [
            'id',
            'consultation_date',
            'consultation_time',
            'name',
            'phone',
            'consultant_type',
            'consultant_id',
            'consultation_type',
            'status',
            'consultation_fee',
            'next_date',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Statuses / Lookups
    |--------------------------------------------------------------------------
    */
    'statuses' => [
        '1'  => 'Active',
        '2'  => 'Deleted',
        '21' => 'Departed',
        '22' => 'Cancelled',
    ],

    'consultation_modes' => [
        'call'         => 'Call',
        'direct-visit' => 'Direct Visit',
    ],

    'plan_tags' => [
        'regular'   => 'Regular',
        'urgent'    => 'Urgent',
        'emergency' => 'Emergency',
    ],

    /*
    |--------------------------------------------------------------------------
    | Defaults / Options
    |--------------------------------------------------------------------------
    */
    'default_intervals' => [
        '5'  => '5 Minutes',
        '10' => '10 Minutes',
        '15' => '15 Minutes',
        '20' => '20 Minutes',
        '30' => '30 Minutes',
    ],

    'slip_copies' => [
        '1' => '1 Copy',
        '2' => '2 Copies',
        '3' => '3 Copies',
        '4' => '4 Copies',
    ],

    'next_days' => [
        '3 d'  => '3 Days',
        '5 d'  => '5 Days',
        '7 d'  => '7 Days',
        '10 d' => '10 Days',
        '15 d' => '15 Days',
        '30 d' => '30 Days',
    ],

    /*
    |--------------------------------------------------------------------------
    | Bulk Operations
    |--------------------------------------------------------------------------
    */
    'bulk_operations' => [
        'document:consultation-slip' => 'Print Consultation Slip',
        'send:sms'                   => 'Send Consultation SMS',
        'send:email'                 => 'Send Consultation Email',
        'op:remove'                  => 'Delete Consultation',
        'op:restore'                 => 'Restore Consultation',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Columns
    |--------------------------------------------------------------------------
    */
    'default_columns' => [
        'list'   => ['consultation_id','consultation_date','patient_name','phone_number','consultation_with','day_token_id','next_date','consultation_fee','status'],
        'detail' => ['consultation_id','consultation_date','patient_name','phone_number','consultation_with','day_token_id','next_date','consultation_fee','status'],
        'report' => ['consultation_id','consultation_date','patient_name','phone_number','consultation_with','consultation_fee','status'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    */
    'report_columns' => [
        'id',
        'consultation_date',
        'consultation_time',
        'consultation_type',
        'consultant_type',
        'consultant_id',
        'name',
        'gender',
        'age',
        'phone',
        'consultation_fee',
        'next_date',
        'status',
        'created_at',
    ],

    /*
    |--------------------------------------------------------------------------
    | Documents
    |--------------------------------------------------------------------------
    */
    'documents' => [
        'consultation-slip' => 'Consultation Slip',
    ],

];

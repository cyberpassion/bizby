<?php

$pg = 'student';

return [

    /*
    |--------------------------------------------------------------------------
    | List UI (simple keys used by backend queries)
    |--------------------------------------------------------------------------
    */
    'list' => [
        'filters' => [
            'gender',
            'category',
            'status',
            'admission_date',
        ],
        'columns' => [
            'admission_number',
            'name',
            'gender',
            'phone',
            'father_name',
            'category',
            'status',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Lookups / Enums
    |--------------------------------------------------------------------------
    */
    'statuses' => [
        '1'   => 'Active',
        '11'  => 'Draft',
        '19'  => 'Promoted',
        '2'   => 'Deleted',
        '21'  => 'TC Generated',
        '22'  => 'Departed w/o TC',
        '23'  => 'Rusticated',
        '2x'  => 'Deleted (Other Reasons)',
        '127' => 'Cancelled',
    ],

    'document_upload_types' => [
        'principal-signature' => 'Principal Signature',
        'cashier-signature'   => 'Cashier Signature',
        'fee-structure'       => 'Fee Structure Excel',
    ],

    /*
    |--------------------------------------------------------------------------
    | Bulk Operations
    |--------------------------------------------------------------------------
    */
    'bulk_operations' => [
        'document:admission-form'       => 'Print Admission Form',
        'document:id-card'              => 'Print ID Card',
        'document:bonafide-certificate' => 'Print Bonafide Certificate',
        'document:transfer-certificate' => 'Print Transfer Certificate',
        'send:email'                    => 'Send Email',
        'send:sms'                      => 'Send SMS',
        'student:promote'               => 'Promote Student(s)',
        'student:demote'                => 'Demote Student(s)',
        'op:remove'                     => 'Delete',
        'op:restore'                    => 'Restore',
    ],

    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    */
    'report_columns' => [
        'admission_number',
        'admission_date',
        'name',
        'gender',
        'dob',
        'age',
        'category',
        'nationality',
        'phone',
        'email',
        'father_name',
        'mother_name',
    ],

];

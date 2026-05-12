<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\KeyName;
use Modules\Shared\Support\Permission;
use Modules\Vendor\Support\Res;
use Modules\Vendor\Support\Actions;

$pg = 'note';

return [

    /*
    |--------------------------------------------------------------------------
    | Bulk Operations
    |--------------------------------------------------------------------------
    */
    'bulk-operations' => [
        'view:detail' => 'View Detail',
        'op:remove' => 'Delete',
        'op:restore' => 'Restore',
    ],

    /*
    |--------------------------------------------------------------------------
    | Columns
    |--------------------------------------------------------------------------
    */
    'columns' => [

        KeyName::make(Res::VENDORS) => [

            /*
            |--------------------------------------------------------------------------
            | List View
            |--------------------------------------------------------------------------
            */
            Actions::LIST => [
                'id' => 'ID',
                'name' => 'Name',
                'vendor_code' => 'Vendor Code',
                'vendor_type' => 'Vendor Type',
                'vendor_gstin' => 'GSTIN',
                'vendor_pan' => 'PAN',
                'vendor_person' => 'Contact Person',
                'vendor_person_phone' => 'Contact Phone',
                'state' => 'State',
                'place' => 'Place',
                'status_label' => 'Status',
            ],

            /*
            |--------------------------------------------------------------------------
            | Detail View
            |--------------------------------------------------------------------------
            */
            Actions::DETAIL => [

                /* Basic */
                'id' => 'ID',
                'vendor_code' => 'Vendor Code',
                'vendor_type' => 'Vendor Type',
                'vendor_parent_id' => 'Parent Vendor',

                /* Person */
                'name' => 'Name',
                'phone' => 'Phone',
                'email' => 'Email',
                'address' => 'Address',

                /* Business */
                'vendor_gstin' => 'GSTIN',
                'vendor_pan' => 'PAN',
                'vendor_info' => 'Vendor Info',
                'vendor_bank_info' => 'Bank Info',
                'vendor_terms_and_condition' => 'Terms & Conditions',

                /* Contact Person */
                'vendor_person' => 'Contact Person',
                'vendor_person_designation' => 'Designation',
                'vendor_person_phone' => 'Contact Phone',
                'vendor_person_email' => 'Contact Email',

                /* Location */
                'state' => 'State',
                'place' => 'Place',
                'region' => 'Region',

                /* Sales */
                'sales' => 'Sales',
                'thread_parent' => 'Thread Parent',
                'incentive_percentage' => 'Incentive (%)',

                /* System */
                'status_label' => 'Status',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
            ],

            /*
            |--------------------------------------------------------------------------
            | Report View
            |--------------------------------------------------------------------------
            */
            Actions::REPORT => [
                'id' => 'ID',
                'name' => 'Name',
                'vendor_code' => 'Vendor Code',
                'vendor_type' => 'Vendor Type',
                'vendor_gstin' => 'GSTIN',
                'vendor_pan' => 'PAN',
                'state' => 'State',
                'place' => 'Place',
                'vendor_person' => 'Contact Person',
                'vendor_person_phone' => 'Contact Phone',
                'incentive_percentage' => 'Incentive (%)',
                'status_label' => 'Status',
                'created_at' => 'Created At',
            ],

            /*
            |--------------------------------------------------------------------------
            | Sample Export
            |--------------------------------------------------------------------------
            */
            Actions::SAMPLE_EXPORT => [
                'vendor_code',
                'vendor_type',
                'name',
                'phone',
                'email',
                'vendor_gstin',
                'vendor_pan',
                'state',
                'place',
                'vendor_person',
                'vendor_person_phone',
                'incentive_percentage',
                'status',
            ],

            /*
            |--------------------------------------------------------------------------
            | User Selectable Columns
            |--------------------------------------------------------------------------
            */
            Actions::SELECTABLE => [
                'vendor_code',
                'vendor_type',
                'name',
                'vendor_gstin',
                'state',
                'place',
                'status',
            ],

        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Statuses
    |--------------------------------------------------------------------------
    */
    'statuses' => [
        '1' => 'Active',
        '2' => 'Deleted',
        '21' => 'Inactive',
    ],

    /*
    |--------------------------------------------------------------------------
    | Crons
    |--------------------------------------------------------------------------
    */
    'crons' => [
        'note-timeboundnotification' => 'Note Reminders',
    ],

    /*
    |--------------------------------------------------------------------------
    | Documents
    |--------------------------------------------------------------------------
    */
    'documents' => [
        Actions::DETAIL => 'Note Detail',
    ],

    /*
    |--------------------------------------------------------------------------
    | Uploads
    |--------------------------------------------------------------------------
    */
    'uploads' => [
        'document' => 'Document',
    ],

    /*
    |--------------------------------------------------------------------------
    | Filters
    |--------------------------------------------------------------------------
    */
    'filters' => [

        Actions::LIST => [

            [
                'type' => 'date:Y-m-d',
                'name' => 'date:Y-m-d',
                'placeholder' => 'Date',
                'dataKey' => 'note.note_date',
            ],

            [
                'type' => 'select',
                'name' => 'session',
                'placeholder' => 'Session',
                'dataKey' => 'session.session',
            ],

            [
                'type' => 'select',
                'name' => 'added_by_type',
                'placeholder' => 'Added By',
                'dataKey' => 'added_by_type.list',
            ],

            [
                'type' => 'select',
                'name' => 'note_type',
                'placeholder' => 'Note Type',
                'dataKey' => 'student_note_type',
            ],

            [
                'type' => 'select',
                'name' => 'status',
                'placeholder' => 'Status',
                'dataKey' => 'note.statuses',
            ],

        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Communication Templates
    |--------------------------------------------------------------------------
    */
    'communication-templates' => [
        'note_entry_new_sms' => 'New Note Entry SMS',
        'note_entry_new_email' => 'New Note Entry Email',
        'note_comment_new_sms' => 'New Note Comment SMS',
    ],

    /*
    |--------------------------------------------------------------------------
    | Column Labels
    |--------------------------------------------------------------------------
    */
    'column-mapping' => [
        'note_id' => 'ID',
        'added_by' => 'Name',
        'note_type' => 'Type',
        'added_for' => 'For',
        'response_status' => 'R/Status',
    ],

    /*
    |--------------------------------------------------------------------------
    | Module Tables
    |--------------------------------------------------------------------------
    */
    'tables' => [
        'terms',
        'cyp_activity',
        'cyp_notification',
        'cyp_message',
        'cyp_note',
    ],

    /*
    |--------------------------------------------------------------------------
    | Validation Meta
    |--------------------------------------------------------------------------
    */
    'validation' => [
        'mandatory' => ['information'],
        'date' => ['date', 'note_end_date'],
    ],

];
<?php

$pg = 'announcement';

return [

    /*
    |--------------------------------------------------------------------------
    | List UI (simple backend keys)
    |--------------------------------------------------------------------------
    */
    'list' => [
        'columns' => [
            'id',
            'category',
            'recipient',
            'session',
            'end_date',
            'added_by',
        ],
        'filters' => [
            'category',
            'recipient',
            'session',
            'month',
            'status',
            'end_date',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Categories / Lookups
    |--------------------------------------------------------------------------
    */
    'categories' => [
        'default' => 'Default',
    ],

    /*
    |--------------------------------------------------------------------------
    | Bulk Operations
    |--------------------------------------------------------------------------
    */
    'bulk_operations' => [
        'view:detail' => 'View Detail',
        'op:remove'   => 'Delete',
        'op:restore'  => 'Restore',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Columns
    |--------------------------------------------------------------------------
    */
    'default_columns' => [
        'entry'   => ['date','announcement_id','announcement','category','all_recipients','added_by','tags','status'],
        'list'    => ['date','announcement_id','announcement','category','all_recipients','added_by','tags','status'],
        'detail'  => ['date','announcement_id','announcement','category','all_recipients','added_by','tags','status'],
        'report'  => ['date','announcement_id','announcement','category','all_recipients','added_by','tags','status'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Report Columns
    |--------------------------------------------------------------------------
    */
    'report_columns' => [
        'id',
        'category',
        'recipient',
        'announcement',
        'session',
        'month',
        'end_date',
        'added_by_type',
        'added_by',
        'entry_source',
        'status',
        'created_at',
    ],

    /*
    |--------------------------------------------------------------------------
    | Cron Jobs
    |--------------------------------------------------------------------------
    */
    'crons' => [
        'announcement-notification' => 'Announcement Notification',
    ],

    /*
    |--------------------------------------------------------------------------
    | Communication Templates
    |--------------------------------------------------------------------------
    */
    'communication_templates' => [
        'announcement_entry_new_sms'      => 'New Announcement Entry SMS',
        'announcement_entry_new_whatsapp' => 'New Announcement Entry Whatsapp',
        'announcement_entry_new_email'    => 'New Announcement Entry Email',
    ],

    /*
    |--------------------------------------------------------------------------
    | Column Name Mapping
    |--------------------------------------------------------------------------
    */
    'column_mapping' => [
        'announcement_id' => 'ID',
        'added_by'        => 'Added By',
        'added_by_type'   => 'Added By',
        'added_for'       => 'Added For',
        'added_by_for'    => 'Added For',
        'end_date'        => 'End Date',
    ],

    /*
    |--------------------------------------------------------------------------
    | Validation / Rules
    |--------------------------------------------------------------------------
    */
    'mandatory_fields' => [
        'announcement',
        'recipients',
    ],

    'date_fields' => [
        'end_date',
    ],

    'duplicacy_check_fields' => [
        'date',
        'announcement',
    ],

    /*
    |--------------------------------------------------------------------------
    | Documents
    |--------------------------------------------------------------------------
    */
    'document_upload_types' => ['pdf'],

];

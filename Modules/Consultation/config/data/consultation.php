<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\KeyName;
use Modules\Shared\Support\Permission;
use Modules\Consultation\Support\Res;
use Modules\Consultation\Support\Actions;

$pg = 'consultation';

return [

    /*
    |--------------------------------------------------------------------------
    | Bulk Operations
    |--------------------------------------------------------------------------
    */
    'bulk-operations' => [
        'document:consultation-slip' => 'Print Consultation Slip',
        'send:sms' => 'Send Consultation SMS',
        'send:email' => 'Send Consultation Email',
        'op:remove' => 'Delete Consultation',
        'op:restore' => 'Restore Consultation',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Columns
    |--------------------------------------------------------------------------
    */
    'columns' => [

        KeyName::make(Res::CONSULTATIONS) => [

            /*
            |--------------------------------------------------------------------------
            | List View
            |--------------------------------------------------------------------------
            */
            Actions::LIST => [
                'id' => 'ID',
                'consultation_date' => 'Date',
                'name' => 'Name',
                'phone' => 'Phone',
                'channel' => 'Channel',
                'consultant_label' => 'Consultant',
                'status_label' => 'Status',
                'consultation_fee' => 'Fee',
            ],

            /*
            |--------------------------------------------------------------------------
            | Report View
            |--------------------------------------------------------------------------
            */
            Actions::REPORT => [
                'id' => 'ID',
                'consultation_date' => 'Date',
                'name' => 'Name',
                'phone' => 'Phone',
                'channel' => 'Channel',
                'consultant_label' => 'Consultant',
                'status_label' => 'Status',
                'consultation_fee' => 'Fee',
            ],

            /*
            |--------------------------------------------------------------------------
            | Detail View
            |--------------------------------------------------------------------------
            */
            Actions::DETAIL => [
                'consultation_date' => 'Date',
                'name' => 'Name',
                'phone' => 'Phone',
                'consultation_type' => 'Type',
                'channel' => 'Channel',
                'consultant_label' => 'Consultant',
                'referred_by' => 'Referred By',
                'referred_to' => 'Referred To',
                'consultation_fee' => 'Fee',
                'followup_interval_days' => 'Follow-up Interval',
                'next_date' => 'Next Date',
                'status_label' => 'Status',
            ],

            /*
            |--------------------------------------------------------------------------
            | Sample Export
            |--------------------------------------------------------------------------
            */
            Actions::SAMPLE_EXPORT => [
                'consultation_date',
                'consultation_time',
                'name',
                'phone',
                'consultation_type',
                'channel',
                'consultant_label',
                'consultation_fee',
                'referred_by',
                'referred_to',
                'next_date',
                'status',
            ],

            /*
            |--------------------------------------------------------------------------
            | User Selectable Columns
            |--------------------------------------------------------------------------
            */
            Actions::SELECTABLE => [
                'consultation_date',
                'consultation_time',
                'name',
                'phone',
                'consultation_type',
                'channel',
                'consultant_label',
                'consultation_fee',
                'referred_by',
                'referred_to',
                'next_date',
                'status',
            ],

        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Cron Jobs
    |--------------------------------------------------------------------------
    */
    'crons' => [
        'consultation-visitreminder' => 'Consultation Visit Reminder',
    ],

    /*
    |--------------------------------------------------------------------------
    | Documents
    |--------------------------------------------------------------------------
    */
    'documents' => [
        'consultation-slip' => 'Consultation Slip',
    ],

    /*
    |--------------------------------------------------------------------------
    | Statuses
    |--------------------------------------------------------------------------
    */
    'statuses' => [
        '1' => 'Active',
        '2' => 'Deleted',
        '21' => 'Departed',
        '22' => 'Cancelled',
    ],

    /*
    |--------------------------------------------------------------------------
    | Uploads
    |--------------------------------------------------------------------------
    */
    'uploads' => [
        'image' => 'Image',
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Specific For Module
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Default Intervals
    |--------------------------------------------------------------------------
    */
    'default-intervals' => [
        '5' => '5 Minutes',
        '10' => '10 Minutes',
        '15' => '15 Minutes',
        '20' => '20 Minutes',
        '30' => '30 Minutes',
    ],

    /*
    |--------------------------------------------------------------------------
    | Next Days
    |--------------------------------------------------------------------------
    */
    'next-days' => [
        '3 d' => '3 Days',
        '4 d' => '4 Days',
        '5 d' => '5 Days',
        '6 d' => '6 Days',
        '7 d' => '7 Days',
        '10 d' => '10 Days',
        '12 d' => '12 Days',
        '15 d' => '15 Days',
        '30 d' => '30 Days',
    ],

];
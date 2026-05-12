<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\KeyName;
use Modules\Shared\Support\Permission;
use Modules\Maintenance\Support\Res;
use Modules\Maintenance\Support\Actions;

$pg = 'maintenance';

return [

    /*
    |--------------------------------------------------------------------------
    | Bulk Operations
    |--------------------------------------------------------------------------
    */
    'bulk-operations' => [
        'document:maintenance-slip' => 'Print Maintenance Slip',
        'send:sms' => 'Send Maintenance SMS',
        'send:email' => 'Send Maintenance Email',
        'op:remove' => 'Delete Maintenance',
        'op:restore' => 'Restore Maintenance',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Columns
    |--------------------------------------------------------------------------
    */
    'columns' => [

        KeyName::make(Res::MAINTENANCES) => [

            /*
            |--------------------------------------------------------------------------
            | List View
            |--------------------------------------------------------------------------
            */
            Actions::LIST => [
                'id' => 'ID',
                'asset' => 'Asset',
                'issue_type_label' => 'Issue Type',
                'maintenance_date' => 'Maintenance Date',
                'maintenance_time' => 'Maintenance Time',
                'reported_date' => 'Reported Date',
                'cost' => 'Cost',
                'status_label' => 'Status',
            ],

            /*
            |--------------------------------------------------------------------------
            | Report View
            |--------------------------------------------------------------------------
            */
            Actions::REPORT => [
                'id' => 'ID',
                'asset' => 'Asset',
                'issue_type_label' => 'Issue Type',
                'maintenance_date' => 'Maintenance Date',
                'maintenance_time' => 'Maintenance Time',
                'reported_date' => 'Reported Date',
                'cost' => 'Cost',
                'status_label' => 'Status',
            ],

            /*
            |--------------------------------------------------------------------------
            | Detail View
            |--------------------------------------------------------------------------
            */
            Actions::DETAIL => [
                'id' => 'ID',
                'asset' => 'Asset',
                'issue_type_label' => 'Issue Type',
                'maintenance_date' => 'Maintenance Date',
                'maintenance_time' => 'Maintenance Time',
                'reported_date' => 'Reported Date',
                'cost' => 'Cost',
                'status_label' => 'Status',
            ],

            /*
            |--------------------------------------------------------------------------
            | Sample Export
            |--------------------------------------------------------------------------
            */
            Actions::SAMPLE_EXPORT => [
                'maintenance_date',
                'maintenance_time',
                'name',
                'phone',
                'maintenance_type',
                'channel',
                'consultant',
                'maintenance_fee',
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
                'maintenance_date',
                'maintenance_time',
                'name',
                'phone',
                'maintenance_type',
                'channel',
                'consultant',
                'maintenance_fee',
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
        'maintenance-visitreminder' => 'Maintenance Visit Reminder',
    ],

    /*
    |--------------------------------------------------------------------------
    | Documents
    |--------------------------------------------------------------------------
    */
    'documents' => [
        'maintenance-slip' => 'Maintenance Slip',
    ],

    /*
    |--------------------------------------------------------------------------
    | Statuses
    |--------------------------------------------------------------------------
    */
    'statuses' => [
        '1' => 'Scheduled',
        '2' => 'In Progress',
        '3' => 'Completed',
        '4' => 'On Hold',
        '5' => 'Cancelled',
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
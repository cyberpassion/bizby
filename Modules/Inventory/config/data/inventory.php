<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\KeyName;
use Modules\Shared\Support\Permission;
use Modules\Inventory\Support\Res;
use Modules\Inventory\Support\Actions;

$pg = 'inventory';

return [

    /*
    |--------------------------------------------------------------------------
    | Bulk Operations
    |--------------------------------------------------------------------------
    */
    'bulk-operations' => [
        'document:inventory-slip' => 'Print Inventory Slip',
        'send:sms' => 'Send Inventory SMS',
        'send:email' => 'Send Inventory Email',
        'op:remove' => 'Delete Inventory',
        'op:restore' => 'Restore Inventory',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Columns
    |--------------------------------------------------------------------------
    */
    'columns' => [

        KeyName::make(Res::INVENTORIES) => [

            /*
            |--------------------------------------------------------------------------
            | List View
            |--------------------------------------------------------------------------
            */
            Actions::LIST => [
                'code' => 'Code',
                'product_id_label' => 'Product',
                'center_id_label' => 'Center',
                'minimum_threshold' => 'Min Threshold',
                'maximum_threshold' => 'Max Threshold',
                'current_stock' => 'Current Stock',
                'stock_status' => 'Stock Status',
                'status_label' => 'Status',
            ],

            /*
            |--------------------------------------------------------------------------
            | Report View
            |--------------------------------------------------------------------------
            */
            Actions::REPORT => [
                'code' => 'Code',
                'product_id_label' => 'Product',
                'center_id_label' => 'Center',
                'minimum_threshold' => 'Min Threshold',
                'maximum_threshold' => 'Max Threshold',
                'current_stock' => 'Current Stock',
                'stock_status' => 'Stock Status',
                'status_label' => 'Status',
            ],

            /*
            |--------------------------------------------------------------------------
            | Detail View
            |--------------------------------------------------------------------------
            */
            Actions::DETAIL => [

                /*
                |--------------------------------------------------------------------------
                | Core
                |--------------------------------------------------------------------------
                */
                'id' => 'ID',
                'code' => 'Code',

                /*
                |--------------------------------------------------------------------------
                | Relation
                |--------------------------------------------------------------------------
                */
                'product_id' => 'Product ID',
                'product_id_label' => 'Product',
                'center_id' => 'Center ID',
                'center_id_label' => 'Center',

                /*
                |--------------------------------------------------------------------------
                | Stock Rules
                |--------------------------------------------------------------------------
                */
                'minimum_threshold' => 'Min Threshold',
                'maximum_threshold' => 'Max Threshold',

                /*
                |--------------------------------------------------------------------------
                | Stock
                |--------------------------------------------------------------------------
                */
                'current_stock' => 'Current Stock',
                'stock_status' => 'Stock Status',

                /*
                |--------------------------------------------------------------------------
                | Status
                |--------------------------------------------------------------------------
                */
                'status' => 'Status Value',
                'status_label' => 'Status',

                /*
                |--------------------------------------------------------------------------
                | System
                |--------------------------------------------------------------------------
                */
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
            ],

            /*
            |--------------------------------------------------------------------------
            | Sample Export
            |--------------------------------------------------------------------------
            */
            Actions::SAMPLE_EXPORT => [
                'code',
                'product_id_label',
                'center_id_label',
                'minimum_threshold',
                'maximum_threshold',
                'current_stock',
                'stock_status',
                'status_label',
            ],

            /*
            |--------------------------------------------------------------------------
            | User Selectable Columns
            |--------------------------------------------------------------------------
            */
            Actions::SELECTABLE => [
                'code',
                'product_id_label',
                'center_id_label',
                'current_stock',
                'stock_status',
                'status_label',
            ],

        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Cron Jobs
    |--------------------------------------------------------------------------
    */
    'crons' => [
        'inventory-visitreminder' => 'Inventory Visit Reminder',
    ],

    /*
    |--------------------------------------------------------------------------
    | Documents
    |--------------------------------------------------------------------------
    */
    'documents' => [
        'inventory-slip' => 'Inventory Slip',
    ],

    /*
    |--------------------------------------------------------------------------
    | Statuses
    |--------------------------------------------------------------------------
    */
    'statuses' => [
        '1' => 'Available',
        '2' => 'Reserved',
        '3' => 'Out of Stock',
        '4' => 'Damaged',
        '5' => 'Expired',
        '6' => 'Deleted',
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
    | Transaction Types
    |--------------------------------------------------------------------------
    */
    'transaction-types' => [
        'in' => 'Stock In',
        'out' => 'Stock Out',
        'adjustment' => 'Adjustment',
        'transfer' => 'Transfer',
    ],

    /*
    |--------------------------------------------------------------------------
    | Reason Types
    |--------------------------------------------------------------------------
    */
    'reason-types' => [
        'purchase' => 'Purchase',
        'sale' => 'Sale',
        'opening' => 'Opening Stock',
        'manual' => 'Manual Entry',
        'damage' => 'Damage / Loss',
    ],

];
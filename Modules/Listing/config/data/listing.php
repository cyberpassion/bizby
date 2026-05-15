<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\KeyName;
use Modules\Shared\Support\Permission;
use Modules\Listing\Support\Res;
use Modules\Listing\Support\Actions;

$pg = 'listing';

return [

    /*
    |--------------------------------------------------------------------------
    | Bulk Operations
    |--------------------------------------------------------------------------
    */
    "bulk-operations" => [
        "view:detail" => "View Listing Details",
        "op:remove" => "Delete Listing",
        "op:restore" => "Restore Listing",
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Columns
    |--------------------------------------------------------------------------
    */
    "columns" => [

        KeyName::make(Res::LISTINGS) => [

            /*
            |--------------------------------------------------------------------------
            | List View
            |--------------------------------------------------------------------------
            */
            Actions::LIST => [
                'id' 			=> 'ID',
                'name' 			=> 'Business',
                'category' 		=> 'Category',
                'city' 			=> 'City',
                'state' 		=> 'State',
                'phone' 		=> 'Phone',
                'is_verified' 	=> 'Verified',
                'is_featured' 	=> 'Featured',
                'valid_till' 	=> 'Valid Till',
                'status_label' 	=> 'Status',
            ],

            /*
            |--------------------------------------------------------------------------
            | Detail View
            |--------------------------------------------------------------------------
            */
            Actions::DETAIL => [
                'id' 			=> 'ID',
                'name' 			=> 'Business',
                'category' 		=> 'Category',
                'city' 			=> 'City',
                'state' 		=> 'State',
                'phone' 		=> 'Phone',
                'is_verified' 	=> 'Verified',
                'is_featured' 	=> 'Featured',
                'valid_till' 	=> 'Valid Till',
                'status_label' 	=> 'Status',
            ],

            /*
            |--------------------------------------------------------------------------
            | Report View
            |--------------------------------------------------------------------------
            */
            Actions::REPORT => [
                'id' 			=> 'ID',
                'name' 			=> 'Business',
                'category' 		=> 'Category',
                'city' 			=> 'City',
                'state' 		=> 'State',
                'phone' 		=> 'Phone',
                'is_verified' 	=> 'Verified',
                'is_featured' 	=> 'Featured',
                'valid_till' 	=> 'Valid Till',
                'status_label' 	=> 'Status',
            ],

            /*
            |--------------------------------------------------------------------------
            | Sample Export
            |--------------------------------------------------------------------------
            */
            Actions::SAMPLE_EXPORT => [],

            /*
            |--------------------------------------------------------------------------
            | User Selectable Columns
            |--------------------------------------------------------------------------
            */
            Actions::SELECTABLE => [],

        ],

    ],

	/*
    |--------------------------------------------------------------------------
    | Uploads
    |--------------------------------------------------------------------------
    */
    'uploads' => [
        'image' => 'Logo',
        'favicon' => 'Favicon',
		'header_image' => 'Header Image'
    ],

    /*
    |--------------------------------------------------------------------------
    | Crons
    |--------------------------------------------------------------------------
    */
    "crons" => [
        'listing-followupreminders' => 'Listing Upcoming Followups',
    ],

    /*
    |--------------------------------------------------------------------------
    | Statuses
    |--------------------------------------------------------------------------
    */
    "statuses" => [
        "1" => "ACTIVE",
        "2" => "INACTIVE",
        "3" => "PENDING",
        "4" => "REJECTED",
        "5" => "DELETED",
    ],

];
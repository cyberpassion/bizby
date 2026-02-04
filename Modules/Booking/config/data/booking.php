<?php

$pg = 'booking';

return [

    /*
    |------------------------------------------------------------------
    | Lookups / Enums
    |------------------------------------------------------------------
    */

    'unit_types' => [
        'room'  => 'Room',
        'table' => 'Table',
        'bed'   => 'Bed',
        'villa' => 'Villa',
        'desk'  => 'Desk',
    ],

    'booking_types' => [
        'stay'      => 'Stay',
        'slot'      => 'Slot',
        'admission' => 'Admission',
    ],

    'charge_types' => [
        'per_night' => 'Per Night',
        'per_day'   => 'Per Day',
        'per_hour'  => 'Per Hour',
        'per_slot'  => 'Per Slot',
    ],

    'venue_types' => [
        'hotel'      => 'Hotel',
        'restaurant' => 'Restaurant',
    ],

    /*
    |------------------------------------------------------------------
    | Statuses
    |------------------------------------------------------------------
    */

    'statuses' => [
        '1'  => 'Active',
        '11' => 'Expected',
        '2'  => 'Departed',
        '21' => 'Cancelled',
    ],

    'availability_status' => [
        '1'   => 'Available',
        '11'  => 'Partially Available',
        '2'   => 'Not Available',
        'all' => 'All',
    ],

    /*
    |------------------------------------------------------------------
    | Documents
    |------------------------------------------------------------------
    */

    'documents' => [
        'booking-invoice'             => 'Booking Invoice',
        'booking-confirmation-slip'   => 'Booking Confirmation Slip',
    ],

    /*
    |------------------------------------------------------------------
    | Bulk Operations
    |------------------------------------------------------------------
    */

    'bulk_operations' => [
        'document:booking-confirmation-slip' => 'Booking Confirmation Slip',
        'document:booking-invoice'            => 'Booking Invoice',
        'document:gst-invoice-slip'            => 'GST Slip',
        'document:simple-invoice-slip'         => 'Simple Slip',
        'view:detail'                          => 'View Detail',
        'send:email'                          => 'Send Email',
        'send:sms'                            => 'Send SMS',
        'op:remove'                           => 'Delete',
        'op:restore'                          => 'Restore',
    ],

    /*
    |------------------------------------------------------------------
    | Default Columns
    |------------------------------------------------------------------
    */

    'default_columns' => [
        'list'   => ['booking_id','occupant_name','booking_type','slot_type','slot_name','checkin_datetime','expected_checkout_datetime','checkout_datetime'],
        'detail' => ['booking_id','occupant_name','booking_type','slot_type','slot_name','checkin_datetime','expected_checkout_datetime','checkout_datetime'],
        'report' => ['booking_id','occupant_name','booking_type','slot_type','slot_name','checkin_datetime','expected_checkout_datetime','checkout_datetime'],
    ],

    /*
    |------------------------------------------------------------------
    | Business Rules
    |------------------------------------------------------------------
    */

    'single_day_count_rule' => [
        'default'  => 'As per Checkin and Checkout Time',
        '12-hours' => '12 Hours',
        '24-hours' => '24 Hours',
    ],

    'fee_type' => [
        'total'   => 'Total',
        'per-day' => 'Per Day',
    ],

    'booking_mode' => [
        'regular'   => 'Regular Booking',
        'scheduled' => 'Scheduled Booking',
    ],

];

<?php
$pg = 'transport';

return [

/*
|--------------------------------------------------------------------------
| DATA : Filters
|--------------------------------------------------------------------------
*/
'transport.list-filters' => [
    "admin" => [
        'route_filter'        => 'Route/route_name/transport_route-list',
        'vehicle_type_filter' => 'Vehicle Type/vehicle_type/transport_vehicle_type-list',
        'status_filter'       => 'Status/status/status-json',
    ],
    "portal" => [
        'route_filter'        => 'Route/route_name/transport_route-list',
        'vehicle_type_filter' => 'Vehicle Type/vehicle_type/transport_vehicle_type-list',
        'status_filter'       => 'Status/status/status-json',
    ]
],

/*
|--------------------------------------------------------------------------
| Bulk Operations
|--------------------------------------------------------------------------
*/
'transport.bulk-operations' => [
    "view:detail" => "View Detail",
    "op:remove"   => "Delete",
    "op:restore"  => "Restore"
],

/*
|--------------------------------------------------------------------------
| Columns
|--------------------------------------------------------------------------
*/
'transport.default-columns' => [
    'entry'   => ['transport_vehicle_id','route_name','registration_number','driver_name','remark','tags','status'],
    'list'    => ['transport_vehicle_id','route_name','registration_number','driver_name','remark','tags','status'],
    'detail'  => ['transport_vehicle_id','route_name','registration_number','driver_name','remark','tags','status'],
    'report'  => ['transport_vehicle_id','route_name','registration_number','driver_name','remark','tags','status'],
    'sample_export' => ['sno','route_name','registration_number','driver_name','remark'],
    'selected_columns' => ['route_name','registration_number','driver_name','remark'],
],

/*
|--------------------------------------------------------------------------
| Communication Templates
|--------------------------------------------------------------------------
*/
'communicationTemplate-transport' => [
    "transport_entry_new_sms"      => "New Transport Entry SMS",
    "transport_entry_new_whatsapp" => "New Transport Entry Whatsapp",
    "transport_entry_new_email"    => "New Transport Entry Email",
],

/*
|--------------------------------------------------------------------------
| Column Name Mapping
|--------------------------------------------------------------------------
*/
'columnNameMapping-transport' => [
    'ptr'                   => 'SNo',
    'route_name'             => 'Route Name',
    'registration_number'    => 'Reg No',
    'transport_vehicle_id'   => 'ID',
    'driver_name'            => 'Driver Name',
],

/*
|--------------------------------------------------------------------------
| Vehicle Types
|--------------------------------------------------------------------------
*/
'transport.vehicle-types' => [
    'three_wheeler' => 'Three Wheeler',
    'four_wheeler'  => 'Four Wheeler',
    'van'           => 'Van',
    'truck'         => 'Truck',
    'bus'           => 'Bus',
    'other'         => 'Other',
],

/*
|--------------------------------------------------------------------------
| Module Tables
|--------------------------------------------------------------------------
*/
'moduleTable-transport' => [
    "cyp_term",
    "cyp_activity",
    "cyp_advancedinfo",
    "cyp_allotment",
    "cyp_cash",
    "cyp_option",
    "cyp_upload",
    "cyp_notification",
    "cyp_message",
    "cyp_transport_vehicle",
    "cyp_transport_vehicle_reading",
    "cyp_transport_vehicle_stoppage",
    "cyp_transport_vehicle_tracking",
],

/*
|--------------------------------------------------------------------------
| Mandatory / Date / Additional Fields
|--------------------------------------------------------------------------
*/
'mandatoryFields-transport-vehicle-entry-update' => ['selected-ids'],
'dateFields-transport-entry-update'              => ['insurance_renewal_date'],
'additionalFields-transport-entry-update'        => [],

];

<?php

$pg = 'subscription';

return [
    // Communication Templates
    "communicationTemplate-subscription" => [
        "subscription_entry_new_sms"             => "New Subscription Entry SMS",
        "subscription_entry_new_whatsapp"       => "New Subscription Entry Whatsapp",
        "subscription_entry_new_email"          => "New Subscription Entry Email",
        "subscription_renewalreminder_new_sms"  => "New Subscription Renewal Reminder SMS",
        "subscription_renewalreminder_new_whatsapp" => "New Subscription Renewal Reminder Whatsapp",
        "subscription_renewalreminder_new_email" => "New Subscription Renewal Reminder Email",
    ],

    // Column Name Mapping
    "columnNameMapping-subscription" => [
        'ptr'                   => 'SNo',
        'date'                  => 'Date',
        'user_info'             => 'User Info',
        'plan_name'             => 'Plan',
        'subscription_id'       => 'ID',
        'subscription_plan_id'  => 'Plan ID',
        'subscription_plan'     => 'Plan',
        'plan_category'         => 'Category',
        'plan_pricing'          => 'Pricing',
        'plan_duration'         => 'Duration (d)',
        'plan_description'      => 'Description',
        'plan_type'             => 'Plan Type',
        'start_date'            => 'Start Date',
        'end_date'              => 'End Date',
        'remaining_days'        => 'Rem. Days',
        'estimated_amount'      => 'Estimated Amount',
        'subscription_category' => 'Category',
        'subscription_type'     => 'Type'
    ],

    // Default Columns
    "defaultColumns-subscription" => [
        'entry'             => ['subscription_plan','start_date','end_date','remaining_days','estimated_amount','status','options'],
        'list'              => ['subscription_plan','start_date','end_date','remaining_days','estimated_amount','status','options'],
        'detail'            => ['subscription_plan','start_date','end_date','remaining_days','estimated_amount','status','options'],
        'report'            => ['subscription_plan','start_date','end_date','remaining_days','estimated_amount','status','options'],
        'sample_export'     => ['sno','subscription_plan','start_date','end_date','remaining_days','estimated_amount'],
        'selected_columns'  => ['subscription_plan','start_date','end_date','remaining_days','estimated_amount'],
        'udx-available-addons' => ['subscription_plan_id','plan_name','plan_type','plan_pricing','options']
    ],

    // Module Tables
    "moduleTable-subscription" => [
        "cyp_term",
        "cyp_activity",
        "cyp_cash",
        "cyp_option",
        "cyp_announcement",
        "cyp_subscription_plan",
        "cyp_subscription",
        "cyp_coupon",
        "cyp_notification"
    ],

    // Mandatory Fields
    "mandatoryFields-subscription_entry" => [],
    "mandatoryFields-subscription_plan-entry" => ["plan_name","plan_pricing"],

    // Date Fields
    "dateFields-subscription_entry" => ['start_date','end_date'],
    "dateFields-subscription_plan-entry" => [],

    // Additional Fields
    "additionalFields-subscription_entry" => [],
    "additionalFields-subscription_plan-entry" => [],

    // Subscription Plan Duration
    "subscription_plan_duration-json" => [
        '365' => 'Yearly',
        '30'  => 'Monthly'
    ],

    // Subscription Plan Type
    "subscription_plan_type-json" => [
        'standalone' => 'Standalone',
        'addon'      => 'Addon'
    ],

    // Subscription Status
    "subscription_status-json" => [
        1 => 'Active',
        2 => 'Suspended'
    ],

    // Subscription Report Type
    "subscription_report_type-json" => [
        "plan"      => "All Subscription List",
        "purchases" => "Subscription Purchases"
    ],

    // Locked Fields
    "lockedFields-subscription_plan-entry_update" => [],
    "lockedFields-subscription_entry_update" => ['subscription_plan_id','subscription_user','coupon_code'],

    // Bulk Operations
    "subscription_bulk_operation-list" => [
        "op:remove"  => "Delete",
        "op:restore" => "Restore"
    ],

    // Placeholder JSON arrays
    "subscription_plan-json"            => [],
    "subscription_standalone_plan-json" => [],
    "subscription_addon_plan-json"     => [],
    "subscription-json"                => [],
    "subscription_user-json"           => [],
    "subscription_plan_of-json"        => []
];

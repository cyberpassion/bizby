<?php
$pg = 'signup';

return [

    /* =========================
     | Bulk Operations
     ========================= */
    'signup.bulk-operations' => [
        "view:detail" => "View Detail",
        "op:remove"  => "Delete",
        "op:restore" => "Restore"
    ],

    /* =========================
     | Default Columns
     ========================= */
    'signup.default-columns' => [
        'entry'  => ['signup_id','name','phone_number','signup_label','signup_info','payment_status','tags','status'],
        'list'   => ['signup_id','name','phone_number','signup_label','signup_info','payment_status','tags','status'],
        'detail' => ['signup_id','name','phone_number','signup_label','signup_info','payment_status','tags','status'],
        'report' => ['signup_id','name','phone_number','signup_label','signup_info','payment_status','tags','status'],
        'sample_export' => ['sno','name','phone_number','signup_label','signup_info','payment_status'],
        'selected_columns' => ['name','phone_number','signup_label','signup_info','payment_status']
    ],

    /* =========================
     | Communication Templates
     ========================= */
    'communicationTemplate-signup' => [
        "signup_entry_new_sms"      => "New Signup Entry SMS",
        "signup_entry_new_whatsapp" => "New Signup Entry Whatsapp",
        "signup_entry_new_email"    => "New Signup Entry Email",
    ],

    /* =========================
     | Column Name Mapping
     ========================= */
    'columnNameMapping-signup' => [
        'ptr'            => 'SNo',
        'date'           => 'Date',
        'signup_id'      => 'ID',
        'signup_label'   => 'Form',
        'signup_info'    => 'Info',
        'phone_number'   => 'Phone',
        'payment_status' => 'Payment',
        'entry_source'   => 'Source',
        'form_id'        => 'ID',
        'form_name'      => 'Name',
        'form_fee'       => 'Fee',
        'form_detail'    => 'Detail'
    ],

    /* =========================
     | Mandatory Options
     ========================= */
    'mandatoryOptionsBeforeUsing-signup' => [
        'missing_option' => []
    ],

    /* =========================
     | Module Tables
     ========================= */
    'moduleTable-signup' => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_signup",
        "cyp_signup_config"
    ],

    /* =========================
     | Entry Validation
     ========================= */
    'mandatoryFields-signup-entry-update' => [
        'module',
        'signup_official_name',
        'signup_official_address',
        'signup_official_email',
        'signup_official_phone',
        'send_notification_message'
    ],

    'dateFields-signup-entry-update' => [],

    'additionalFields-signup-entry-update' => [],

];

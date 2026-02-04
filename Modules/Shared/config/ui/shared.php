<?php
return [

    /* ======================================================
     | MODULE GROUPS (UI / Permissions / Marketplace)
     ====================================================== */
    'shared.modules' => [

        /* -------- CORE -------- */
        'core' => [
            'signup'       => 'Signup',
            'subscription' => 'Subscription',
            'library'      => 'Library',
        ],

        /* -------- PEOPLE -------- */
        'people' => [
            'student'  => 'Student',
            'employee' => 'Employee',
            'customer' => 'Customer',
            'patient'  => 'Patient',
            'vendor'   => 'Vendor',
            'lead'     => 'Lead',
        ],

        /* -------- ACTIVITY -------- */
        'activity' => [
            'attendance'     => 'Attendance',
            'survey'         => 'Survey',
            'checklist'      => 'Checklist',
            'note'           => 'Notes',
            'eventmanager'   => 'Events',
            'meetingmanager' => 'Meetings',
            'visitactivity'  => 'Visits',
            'taskplanner'    => 'Task Planner',
        ],

        /* -------- COMMUNICATION -------- */
        'communication' => [
            'communication' => 'Communication Hub',
            'sms'           => 'SMS',
            'whatsapp'      => 'WhatsApp',
            'email'         => 'Email',
            'notification'  => 'Notifications',
        ],

        /* -------- BUSINESS -------- */
        'business' => [
            'booking'     => 'Booking',
            'billing'     => 'Billing',
            'cashflow'    => 'Cashflow',
            'listing'     => 'Listing',
            'product'     => 'Product',
            'saleservice' => 'Sales & Service',
            'service'     => 'Service Management',
            'transport'   => 'Transport',
            'inventory'   => 'Inventory',
        ],

        /* -------- EDUCATION -------- */
        'education' => [
            'registration' => 'Registration',
            'examresult'   => 'Exam Result',
            'timetable'    => 'Timetable',
            'attendance'   => 'Attendance',
            'library'      => 'Library',
        ],

        /* -------- HEALTHCARE -------- */
        'healthcare' => [
            'treatment'    => 'Treatment',
            'consultation' => 'Consultation',
            'patient'      => 'Patient',
        ],

        /* -------- SYSTEM / PLUGINS -------- */
        'system' => [
            'scheduler'   => 'Scheduler',
            'report'      => 'Reports',
            'download'    => 'Download',
            'integration' => 'Integrations',
            'plugin'      => 'Plugins',
        ],
    ],

    /* ======================================================
     | USER ROLES (Permissions UI)
     ====================================================== */
    'permission.user_roles' => [
        '1' => 'Owner',
        '2' => 'Admin',
        '3' => 'Staff'
    ],

    /* ======================================================
     | SETTINGS MENU (UI)
     ====================================================== */
    'settings.options' => [
        'subscription' => 'Subscription',
        'modules'      => 'Modules',
        'addons'       => 'Addons',
        'security'     => 'Security',
        'team'         => 'Team',
        'integrations' => 'Integrations',
        'billing'      => 'Billing',
    ],

];

<?php

$pg = 'consultation';
$commonSettingsRoute = '/settings';

return [

    /*
    |--------------------------------------------------------------------------
    | Sidebar Menu
    |--------------------------------------------------------------------------
    */
    'sidebar_menu' => [
        [
            'title'      => ucfirst($pg),
            'href'       => "/{$pg}",
            'permission' => "{$pg}.access",
            'items'      => [

                [
                    'title'      => 'Dashboard',
                    'href'       => "/module/{$pg}/home",
                    'permission' => "{$pg}.dashboard.view",
                ],

                [
                    'title' => 'Consultations',
                    'items' => [
                        [
                            'title'      => 'Add Consultation',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.consultation.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.consultation.view",
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Consultation Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.consultation",
                        ],
                    ],
                ],

                [
                    'title' => 'Settings',
                    'items' => [
                        [
                            'title'      => 'Basic Settings',
                            'href'       => "/module/{$pg}/settings",
                            'permission' => "{$pg}.settings.basic",
                        ],
                    ],
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Row Actions
    |--------------------------------------------------------------------------
    */
    'single_actions' => [
        [
            'title'      => 'Print Slip',
            'href'       => "/module/{$pg}/{id}/document",
            'permission' => "{$pg}.document",
            'action'     => 'document',
        ],
        [
            'title'      => 'View Detail',
            'href'       => "/module/{$pg}/{id}/detail",
            'permission' => "{$pg}.view",
            'action'     => 'view',
        ],
        [
            'title'      => 'Delete',
            'href'       => "/module/{$pg}/{id}",
            'permission' => "{$pg}.delete",
            'action'     => 'delete',
            'method'     => 'DELETE',
            'variant'    => 'danger',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | List Filters (Frontend)
    |--------------------------------------------------------------------------
    */
    'list_filters' => [
        [
            'type'        => 'date',
            'name'        => 'consultation_date',
            'placeholder' => 'Consultation Date',
            'col'         => 3,
        ],
        [
            'type'        => 'select',
            'name'        => 'status',
            'placeholder' => 'Status',
            'col'         => 3,
            'dataKey'     => 'consultation.statuses',
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
    | Permissions (Portal)
    |--------------------------------------------------------------------------
    */
    'permission_portal' => [
        'list'   => [['phone_number' => '{$phone_number}']],
        'detail' => [['phone_number' => '{$phone_number}']],
        'report' => [['phone_number' => '{$phone_number}']],
    ],

];

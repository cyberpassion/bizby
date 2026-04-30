<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\Permission;
use Modules\Note\Support\Res;
use Modules\Note\Support\Actions;

$pg = 'note';

return [

    /* =========================
     | Sidebar Menu
     ========================= */
    'sidebar-menu' => [
    [
        'title'      => ucfirst($pg),
        'href'       => "/{$pg}",
        'permission' => Permission::access($pg),

        'items' => [

            [
                'title'       => 'Home',
                'description' => 'Notes Dashboard & Overview',
                'href'        => UrlPath::makeHome($pg),
                'permission'  => Permission::view(Res::HOME),
            ],

            [
                'title'       => 'Add New',
                'description' => 'Create a New Note or Conversation',
                'href'        => UrlPath::makeCreate($pg),
                'permission'  => Permission::create(Res::NOTES),
            ],

            [
                'title'       => 'View List',
                'description' => 'Browse All Notes & Threads',
                'href'        => UrlPath::makeList($pg),
                'permission'  => Permission::list(Res::NOTES),
            ],

            [
                'title'       => 'Report',
                'description' => 'View Notes Activity Reports',
                'href'        => UrlPath::makeReport($pg),
                'permission'  => Permission::view(Res::REPORTS),
            ],

            [
                'title'       => 'Settings',
                'description' => 'Manage Notes Settings',
                'href'        => UrlPath::makeSettings($pg),
                'permission'  => Permission::update(Res::SETTINGS),
            ],
        ],
    ],
],

    /*
    |--------------------------------------------------------------------------
    | Row Actions
    |--------------------------------------------------------------------------
    */
    'single-actions' => [

    Actions::LIST => [

        /*
        |--------------------------------------------------------------------------
        | PRIMARY ACTION (Open Chat)
        |--------------------------------------------------------------------------
        */
        [
            'title'      => 'Open',
            'href'       => "{id}/conversation", // chat screen
            'permission' => Permission::view(Res::NOTES),
            'action'     => 'view',
            'variant'    => 'primary',
        ],

        /*
        |--------------------------------------------------------------------------
        | Thread Management
        |--------------------------------------------------------------------------
        */
        [
            'title'      => 'Edit Details',
            'href'       => UrlPath::makeUpdate($pg, '{id}'),
            'permission' => Permission::update(Res::NOTES),
            'action'     => 'update',
        ],

        [
            'title'      => 'Assign',
            'href'       => "{$pg}/note/{id}/assign",
            'permission' => Permission::update(Res::NOTES),
            'action'     => 'assign',
            'type'       => 'modal', // optional (for popup)
        ],

        [
            'title'      => 'Participants',
            'href'       => "{$pg}/note/{id}/participants",
            'permission' => Permission::update(Res::NOTES),
            'action'     => 'participants',
            'type'       => 'modal',
        ],

        /*
        |--------------------------------------------------------------------------
        | Status Actions
        |--------------------------------------------------------------------------
        */
        [
            'title'      => 'Mark In Progress',
            'href'       => "{$pg}/note/{id}/status/in_progress",
            'permission' => Permission::update(Res::NOTES),
            'action'     => 'status',
            'method'     => 'PATCH',
        ],

        [
            'title'      => 'Mark Resolved',
            'href'       => "{$pg}/note/{id}/status/resolved",
            'permission' => Permission::update(Res::NOTES),
            'action'     => 'status',
            'method'     => 'PATCH',
        ],

        [
            'title'      => 'Mark Closed',
            'href'       => "{$pg}/note/{id}/status/closed",
            'permission' => Permission::update(Res::NOTES),
            'action'     => 'status',
            'method'     => 'PATCH',
        ],

        /*
        |--------------------------------------------------------------------------
        | Utility
        |--------------------------------------------------------------------------
        */
        [
            'title'      => 'Set Reminder',
            'href'       => "{$pg}/note/{id}/reminder",
            'permission' => Permission::update(Res::NOTES),
            'action'     => 'reminder',
            'type'       => 'modal',
        ],

        /*
        |--------------------------------------------------------------------------
        | Dangerous
        |--------------------------------------------------------------------------
        */
        [
            'title'      => 'Delete',
            'href'       => UrlPath::makeDelete($pg, '{id}'),
            'permission' => Permission::delete(Res::NOTES),
            'action'     => 'delete',
            'method'     => 'DELETE',
            'variant'    => 'danger',
        ],
    ]

],

    /*
    |--------------------------------------------------------------------------
    | List Filters (Frontend)
    |--------------------------------------------------------------------------
    */
    'filters' => [

        Actions::LIST => [
            [
                'type'        => 'select',
                'name'        => 'type',
                'placeholder' => 'Type',
                'col'         => 3,
                'dataKey'     => 'note.thread-types',
            ],
        ],

		Actions::LIST => [
            [
                'type'        => 'select',
                'name'        => 'priority',
                'placeholder' => 'Priority',
                'col'         => 3,
                'dataKey'     => 'note.priorities',
            ],
        ],

		Actions::LIST => [
            [
                'type'        => 'select',
                'name'        => 'status',
                'placeholder' => 'Status',
                'col'         => 3,
                'dataKey'     => 'note.statuses',
            ],
        ]

    ],

];
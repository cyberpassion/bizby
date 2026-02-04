<?php
$pg = 'lead';
$commonSettingsRoute = '/settings';

return [

    /* =========================
     | Sidebar Menu (UI)
     ========================= */
    'sidebar-menu' => [
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
                    'title' => 'Leads',
                    'items' => [
                        [
                            'title'      => 'Add Lead',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.lead.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.lead.view",
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Lead Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.lead",
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

                [
                    'title' => 'Plugins',
                    'items' => [
                        [
                            'title'      => 'View Calendar',
                            'href'       => "/module/{$pg}/plugin/calendar",
                            'permission' => "{$pg}.plugin.manage",
                        ],
                    ],
                ],
            ],
        ],
    ],

    /* =========================
     | UI Table Columns
     ========================= */
    'lead.list-columns' => [
        'lead_code',
        'name',
        'contact_person',
        'mobile',
        'stage_id',
        'next_followup_date',
    ],

    'lead.list-filters-ui' => [
        'stage_id',
        'category_id',
        'source_id',
        'assigned_to_id',
        'district',
        'next_followup_date',
    ],

    'lead.report-columns' => [
        'lead_code',
        'name',
        'contact_person',
        'mobile',
        'email',
        'district',
        'state',
        'category_id',
        'source_id',
        'stage_id',
        'assigned_to_id',
        'next_followup_date',
    ],

];

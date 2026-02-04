<?php

$pg = 'booking';

return [

    /*
    |------------------------------------------------------------------
    | Sidebar Menu
    |------------------------------------------------------------------
    */

    'sidebar_menu' => [
        [
            'title'      => ucfirst($pg),
            'href'       => "/{$pg}",
            'permission' => "{$pg}.access",
            'items'      => [

                [
                    'title'      => 'Dashboard',
                    'href'       => "/module/{$pg}",
                    'permission' => "{$pg}.dashboard.view",
                ],

                [
                    'title' => 'Venues',
                    'items' => [
                        [
                            'title'      => 'Add Venue',
                            'href'       => "/module/{$pg}/new-venue",
                            'permission' => "{$pg}.venue.create",
                        ],
                        [
                            'title'      => 'Venue List',
                            'href'       => "/module/{$pg}/venues-list",
                            'permission' => "{$pg}.venue.view",
                        ],
                    ],
                ],

                [
                    'title' => 'Units',
                    'items' => [
                        [
                            'title'      => 'Add Unit',
                            'href'       => "/module/{$pg}/new-unit",
                            'permission' => "{$pg}.unit.create",
                        ],
                        [
                            'title'      => 'Unit List',
                            'href'       => "/module/{$pg}/units-list",
                            'permission' => "{$pg}.unit.view",
                        ],
                    ],
                ],

                [
                    'title' => 'Bookings',
                    'items' => [
                        [
                            'title'      => 'Add Booking',
                            'href'       => "/module/{$pg}/new-booking",
                            'permission' => "{$pg}.booking.create",
                        ],
                        [
                            'title'      => 'Booking List',
                            'href'       => "/module/{$pg}/booking-list",
                            'permission' => "{$pg}.booking.view",
                        ],
                        [
                            'title'      => 'Calendar View',
                            'href'       => "/module/{$pg}/calendar",
                            'permission' => "{$pg}.booking.calendar",
                        ],
                    ],
                ],

                [
                    'title' => 'Billing & Invoices',
                    'items' => [
                        [
                            'title'      => 'Generate Invoice',
                            'href'       => "/module/{$pg}/new-invoice",
                            'permission' => "{$pg}.invoice.create",
                        ],
                        [
                            'title'      => 'Invoice List',
                            'href'       => "/module/{$pg}/invoices-list",
                            'permission' => "{$pg}.invoice.view",
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Booking Report',
                            'href'       => "/module/{$pg}/report-bookings",
                            'permission' => "{$pg}.report.booking",
                        ],
                        [
                            'title'      => 'Revenue Report',
                            'href'       => "/module/{$pg}/report-revenue",
                            'permission' => "{$pg}.report.revenue",
                        ],
                        [
                            'title'      => 'Occupancy Report',
                            'href'       => "/module/{$pg}/report-occupancy",
                            'permission' => "{$pg}.report.occupancy",
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
    |------------------------------------------------------------------
    | List Filters (UI level)
    |------------------------------------------------------------------
    */

    'list_filters' => [
        [
            'type'        => 'select',
            'name'        => 'booking_type',
            'placeholder' => 'Select Booking Type',
            'col'         => 3,
            'dataKey'     => 'booking.booking_types',
        ],
        [
            'type'        => 'select',
            'name'        => 'status',
            'placeholder' => 'Select Status',
            'col'         => 3,
            'dataKey'     => 'booking.statuses',
        ],
    ],

];

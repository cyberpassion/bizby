<?php

return [

    'plans' => [

        // 🆓 Free trial
        'trial' => [
            'key'       => 'trial',
            'label'     => 'Free Trial',
            'duration'  => 14,            // days
            'unit'      => 'days',
            'discount'  => 0,             // %
            'price_mul' => 1,             // multiplier
            'is_paid'   => false,
        ],

        // 📅 1 Year
        'yearly' => [
            'key'       => 'yearly',
            'label'     => '1 Year',
            'duration'  => 12,            // months
            'unit'      => 'months',
            'discount'  => 0,             // %
            'price_mul' => 1,
            'is_paid'   => true,
        ],

        // 📅 2 Years (10% off)
        '2year' => [
            'key'       => '2year',
            'label'     => '2 Years',
            'duration'  => 24,
            'unit'      => 'months',
            'discount'  => 10,
            'price_mul' => 0.9,
            'is_paid'   => true,
        ],

        // 📅 3 Years (20% off)
        '3year' => [
            'key'       => '3year',
            'label'     => '3 Years',
            'duration'  => 36,
            'unit'      => 'months',
            'discount'  => 20,
            'price_mul' => 0.8,
            'is_paid'   => true,
        ],
    ],
];

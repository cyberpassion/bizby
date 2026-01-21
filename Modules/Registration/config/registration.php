<?php
return [
    'types' => [
        'admission' => [
            'steps' => ['profile', 'documents', 'payment'],
            'fee' => 500
        ],
        'affiliation' => [
            'steps' => ['profile', 'documents', 'review'],
            'fee' => 5000
        ]
    ]
];

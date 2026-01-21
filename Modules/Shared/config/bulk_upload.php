<?php
// config/bulk_upload.php
return [
    'tables' => [
        'students' => [
            'columns' => ['name', 'email', 'phone'],
            'required' => ['name'],
            'defaults' => [
                'status' => 1,
            ],
        ],
    ],
];

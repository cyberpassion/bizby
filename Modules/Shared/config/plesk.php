<?php

return [
    'base_url' => env('PLESK_API_URL'),     // https://server-ip:8443
    'username' => env('PLESK_API_USERNAME'),
    'password' => env('PLESK_API_PASSWORD'),

    'server_id' => env('PLESK_SERVER_ID', 1),
    'host_id'   => env('PLESK_HOST_ID'),
    'host_name' => env('PLESK_HOST_NAME'),
];

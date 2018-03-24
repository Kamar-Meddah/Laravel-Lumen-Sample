<?php

return [

    'driver' => env('MAIL_DRIVER','smtp'),
    'host' => env('MAIL_HOST'),
    'port' => env('MAIL_PORT'),
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS','test@test.com'),
        'name' => env('MAIL_FROM_NAME','blog app'),
    ],
    'encryption' => env('MAIL_ENCRYPTION','tls'),
    'username' => env('MAIL_USERNAME'),
    'password' => env('MAIL_PASSWORD')
];
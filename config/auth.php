<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'emplooyees'),
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'emplooyees', // Make sure this is correct
        ],
    ],

    'providers' => [
        'emplooyees' => [
            'driver' => 'eloquent',
            'model' => App\Models\emplooyees::class, // Your custom model
        ],
    ],

    'passwords' => [
        'emplooyees' => [  // Change this from 'users' to 'emplooyees'
            'provider' => 'emplooyees',  // Use the custom provider
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];

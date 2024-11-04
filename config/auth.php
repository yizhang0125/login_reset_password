
<?php

return [

'defaults' => [
    'guard' => env('AUTH_GUARD', 'web'), // Default guard
    'passwords' => env('AUTH_PASSWORD_BROKER', 'users'), // Default password broker
],

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users', // User provider
    ],

    'admin' => [ // Admin guard
        'driver' => 'session',
        'provider' => 'admins', // Admin provider
    ],
],

'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class, // User model
    ],

    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\Admin::class, // Admin model
    ],
],

'passwords' => [
    'users' => [
        'provider' => 'users',
        'table' => 'password_reset_tokens', // Password reset table for users
        'expire' => 60,
        'throttle' => 60,
    ],

    'admins' => [
        'provider' => 'admins',
        'table' => 'admin_password_reset_tokens', // Password reset table for admins
        'expire' => 60,
        'throttle' => 60,
    ],
],

'password_timeout' => 10800,
];

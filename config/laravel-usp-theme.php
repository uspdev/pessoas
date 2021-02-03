<?php

return [
    'title' => config('app.name'),
    'app_url' => config('app.url'),
    'skin' => env('USP_THEME_SKIN', 'uspdev'),
    'logout_method' => 'POST',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'menu' => [
        [
            'text' => 'Pessoas Autorizadas',
            'url'  => 'users',
            'can'  => 'admin'
        ],
    ]
];

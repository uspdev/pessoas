<?php

return [
    'title' => 'Pessoas',
    'dashboard_url' => getenv('APP_URL'),
    'logout_method' => 'GET',
    'logout_url' => getenv('APP_URL') . '/logout',
    'login_url' => getenv('APP_URL') . '/login',
    'menu' => [
        [
            'text' => 'Busca',
            'url'  =>  getenv('APP_URL') . '/search',
            'can'  => 'admin'
        ],
        [
            'text' => 'Pessoas Autorizadas',
            'url'  => '/users',
            'can'  => 'admin'
        ],
    ]
];

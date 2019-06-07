<?php

return [
    'title'=> 'Pessoas',
    'dashboard_url' => '/' . getenv('APP_URL'),
    'logout_method' => 'POST',
    'logout_url' => '/logout',
    'login_url' => '/login',
    'menu' => [
        [
            'text' => 'Busca por número USP',
            'url'  => '/buscas/codpes',
        ],
        [
            'text' => 'Busca por nome',
            'url'  => '/buscas/nompes',
        ],
    ]
];

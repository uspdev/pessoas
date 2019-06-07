<?php

return [
    'title'=> 'Pessoas',
    'dashboard_url' => getenv('APP_URL'),
    'logout_method' => 'POST',
    'logout_url' => getenv('APP_URL').'logout',
    'login_url' => getenv('APP_URL').'login',
    'menu' => [
        [
            'text' => 'Busca por número USP',
            'url'  => getenv('APP_URL').'buscas/codpes',
        ],
        [
            'text' => 'Busca por nome',
            'url'  => getenv('APP_URL').'buscas/nomepes',
        ],
    ]
];

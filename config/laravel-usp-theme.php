<?php

return [
    'title' => config('app.name'),
    'app_url' => config('app.url'),
    'skin' => env('USP_THEME_SKIN', 'uspdev'),
    'logout_method' => 'POST',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'right_menu' => [
        [
            'text' => '<i class="fas fa-cogs"></i> Pessoas Autorizadas',
            'url' => 'users',
            'can' => 'admin',
        ],
        [
            'text' => '<i class="fas fa-hard-hat"></i>',
            'title' => 'Logs',
            'target' => '_blank',
            'url' => config('app.url') . '/logs',
            'align' => 'right',
            'can' => 'admin',
        ],
    ],
    'menu' => [
        [
            'text' => 'Pós graduação',
            'url' => 'posgrad',
            'can' => 'admin',
        ],

    ],
];

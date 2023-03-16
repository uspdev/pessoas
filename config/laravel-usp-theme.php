<?php

$menu = [
    [
        'text' => 'Pós graduação',
        'url' => 'posgrad',
        'can' => 'posgrad',
    ],
    [
        'key' => 'posgrad',
    ],
    [
        'text' => 'Graduação',
        'submenu' => [
            [
                'text' => 'Relatório por nomes',
                'url' => 'graduacao/relatorio/nomes',
            ],
            [
                'text' => 'Cursos',
                'url' => 'graduacao/relatorio/cursos',
                'can' => 'admin',
            ],
        ],
        'can' => 'graduacao',
    ],
];
$right_menu = [
    [
        'key' => 'senhaunica-socialite',
    ],
    [
        'key' => 'laravel-tools',
    ],
];

return [
    # valor default para a tag title, dentro da section title.
    # valor pode ser substituido pela aplicação.
    'title' => config('app.name'),

    # USP_THEME_SKIN deve ser colocado no .env da aplicação
    'skin' => env('USP_THEME_SKIN', 'uspdev'),

    # chave da sessão. Troque em caso de colisão com outra variável de sessão.
    'session_key' => 'laravel-usp-theme',

    # usado na tag base, permite usar caminhos relativos nos menus e demais elementos html
    # na versão 1 era dashboard_url
    'app_url' => config('app.url'),

    # login e logout
    'logout_method' => 'POST',
    'logout_url' => 'logout',
    'login_url' => 'login',

    # menus
    'menu' => $menu,
    'right_menu' => $right_menu,

    # mensagens flash - https://uspdev.github.io/laravel#31-mensagens-flash
    'mensagensFlash' => true,

    # container ou container-fluid
    'container' => 'container-fluid',

];

<?php

# Vamos forçar desabilitar o WSFOTO se não houver variáveis definidas no .env
if(env('WSFOTO_USER') == '') {
    putenv('WSFOTO_DISABLE=1');
}

return [
    'senhaunica_admins' => env('SENHAUNICA_ADMINS'),
];

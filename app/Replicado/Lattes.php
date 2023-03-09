<?php

namespace App\Replicado;

use Uspdev\Replicado\Lattes as LattesReplicado;

class LAttes extends LattesReplicado
{
    public static function retornarFormacaoAcademicaFormatado($codpes)
    {
        if ($formacao = Lattes::retornarFormacaoAcademica($codpes)) {
            unset($formacao['GRADUACAO']);
            return ucwords(strtolower(implode(', ', array_keys($formacao))));
        }
        return null;
    }
}

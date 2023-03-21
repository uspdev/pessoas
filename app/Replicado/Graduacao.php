<?php

namespace App\Replicado;

use Uspdev\Replicado\DB;
use Uspdev\Replicado\Replicado as Config;
use Uspdev\Replicado\Graduacao as GraduacaoReplicado;

class Graduacao extends GraduacaoReplicado
{

    /**
     * Lista os cursos e habilitações da unidade
     * 
     * Refatorado de obterCursosHabilitacoes
     * 
     * @return Array
     * @author Masaki K Neto, em 9/5/2023
     */
    public static function listarCursosHabilitacoes()
    {
        $query = " SELECT C.*, H.* FROM CURSOGR C, HABILITACAOGR H
            WHERE C.codclg IN (__codundclgs__)
                AND (C.codcur = H.codcur)
                AND ( (C.dtaatvcur IS NOT NULL) AND (C.dtadtvcur IS NULL) ) -- curso ativo
                AND ( (H.dtaatvhab IS NOT NULL) AND (H.dtadtvhab IS NULL) ) -- habilitação ativa
            ORDER BY C.nomcur, H.nomhab ASC";

        $query = str_replace("__codundclgs__", Config::getInstance()->codundclgs, $query);

        return DB::fetchAll($query);
    }
}

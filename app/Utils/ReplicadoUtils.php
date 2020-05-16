<?php

namespace App\Utils;
use Uspdev\Replicado\DB as DBreplicado;
use Uspdev\Replicado\Uteis;

class ReplicadoUtils {

    /**
     * Retorna os campos para o endereço completo: rua/avenida etc., 
     * número/complemento, bairro, cidade e UF a partir do codpes.
     * Método transitório, pois ainda não foi criado issue...
     * @param Integer $codpes
     * @return array
     */
    public static function endereco($codpes){
        $query = "SELECT tl.nomtiplgr, p.epflgr, p.numlgr, p.cpllgr, p.nombro, l.cidloc, l.sglest, p.codendptl 
                    FROM ENDPESSOA p 
                    JOIN LOCALIDADE l
                    ON p.codloc = l.codloc 
                    JOIN TIPOLOGRADOURO tl
                    ON p.codtiplgr = tl.codtiplgr 
                    WHERE codpes = convert(int,:codpes)";
        $param = [
            'codpes' => $codpes,
        ];
        $result = DBreplicado::fetch($query, $param);
        if(!empty($result)) {
            $result = Uteis::utf8_converter($result);
            $result = Uteis::trim_recursivo($result);
            return $result;
        }
        return false;
    }
}
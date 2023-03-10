<?php

namespace App\Replicado;

use Uspdev\Replicado\DB;
use Uspdev\Replicado\Lattes as LattesReplicado;
use Uspdev\Replicado\Uteis;

class Lattes extends LattesReplicado
{
    public static function obterFormacaoAcademicaFormatado($codpes)
    {
        $ret = [];
        if ($formacao = Lattes::retornarFormacaoAcademica($codpes)) {
            foreach ($formacao as $nome => $titulos) {
                $ret[strtolower($nome)] = SELF::retornarTitulosFormatado($titulos);
            }
        }
        return $ret;
    }

    protected static function retornarTitulosFormatado($titulos)
    {
        $ret = '';
        foreach ($titulos as $titulo) {
            if (!empty($titulo['ANO-DE-CONCLUSAO'])) {
                $ret .= $titulo['ANO-DE-CONCLUSAO'];
                if ($titulo['STATUS-DO-CURSO'] != 'CONCLUIDO' && !empty($titulo['STATUS-DO-CURSO'])) {
                    $ret .= ' (' . strtolower($titulo['STATUS-DO-CURSO']) . ')';
                }
                $ret .= ', ';
            } else {
                $ret .= str_replace('_', ' ', strtolower($titulo['STATUS-DO-CURSO'])) . ', ';
            }
        }
        return substr($ret, 0, -2);
    }

    /**
     * Retorna data da última alteração fornecida pelo CNPq.
     * 
     * Indica a data da última atualização nos dados do LATTES para esta pessoa 
     * (detectada pelo 'robô' do CurriculumCPNQ no site do LATTES).
     * 
     * @param Int $codpes
     * @return String formatado em dd/mm/yyyy
     * @author Masaki K Neto, em 10/3/3023
     */
    public static function retornarDataUltimaAlteracao(int $codpes)
    {
        $query = "SELECT dtaultalt
            FROM DIM_PESSOA_XMLUSP
            WHERE codpes = convert(int,:codpes)";

        $param['codpes'] = $codpes;
        $result = DB::fetch($query, $param);

        return $result ? Uteis::data_mes($result['dtaultalt']) : false;
    }
}

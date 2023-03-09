<?php

namespace App\Replicado;

use Uspdev\Replicado\DB;
use Uspdev\Replicado\Pessoa as PessoaReplicado;

class Pessoa extends PessoaReplicado
{

    public static function listarVinculos(Int $codpes, $ativos = false)
    {
        if ($ativos) {
            $ativosQuery = "AND sitatl = 'A' AND tipvin='SERVIDOR'";
        }
        $query = "SELECT S.nomabvset, S.nomset, * FROM VINCULOPESSOAUSP V
            LEFT JOIN SETOR S ON S.codset = V.codset
            WHERE codpes = convert(INT, :codpes)
            $ativosQuery
            ";
        $param['codpes'] = $codpes;
        $result = DB::fetchAll($query, $param);

        return $result;
    }

    public static function listarVinculosFormatado($codpes) {
        if ($vinculos = Pessoa::listarVinculos($codpes, $ativos = true)) {
            $tipoJornada = $vinculos[0]['tipjor'];
            $nomeAbreviadoSetor = $vinculos[0]['nomabvset'];
        } else {
            $tipoJornada = '-';
            $nomeAbreviadoSetor = '-';
        }
        return [$tipoJornada, $nomeAbreviadoSetor];
    }

    public static function procurarServidorPorNome($nome)
    {
        foreach (PessoaReplicado::procurarPorNome($nome, false, true) as $pessoa) {
            if (isset($pessoa['tipvin']) && $pessoa['tipvin'] == 'SERVIDOR') {
                return $pessoa;
            }
        }
        return null;
    }
}

<?php

namespace App\Replicado;

use Uspdev\Replicado\DB;
use Uspdev\Replicado\Pessoa as PessoaReplicado;

class Pessoa extends PessoaReplicado
{
    /**
     * Retorna os vinculos de VINCULOPESSOAUSP
     *
     * Por padrão traz os vinculos encerrados
     */
    public static function listarVinculosEncerrados(int $codpes)
    {
        // $ativosQuery = '';
        // if ($ativos) {
        //     $ativosQuery = "AND sitatl = 'A' AND tipvin='SERVIDOR'";
        // }
        $query = "SELECT S.nomabvset, S.nomset, V.*
            FROM VINCULOPESSOAUSP V
                LEFT JOIN SETOR S ON S.codset = V.codset
            WHERE codpes = convert(INT, :codpes)
                AND sitatl != 'A'
            ORDER BY dtafimvin";
        $param['codpes'] = $codpes;
        $result = DB::fetchAll($query, $param);

        return $result;
    }

    /**
     * Lista os dados de vinculos ativos da pessoa
     *
     * Retorna os dados de LOCALIZAPESSOA.
     * Não limita por unidade pois a tabela possui dados de outras unidades.
     * Pode não incluir designações
     *
     * @param $codpes
     * @param $designados Se false não retorna designados
     * @return Array
     * @author Masaki K Neto, em 14/3/2022
     * @author Masaki K Neto, modificado em 14/3/2023
     */
    public static function listarVinculosAtivos($codpes, $designados = true)
    {
        $queryDesignados = $designados ? '' : 'AND tipdsg is NULL';
        $query = "SELECT *
            FROM LOCALIZAPESSOA
            WHERE codpes = convert(int,:codpes)
                $queryDesignados
            ORDER BY dtainivin";

        $param['codpes'] = $codpes;

        return DB::fetchAll($query, $param);
    }

    /**
     *
     */
    public static function retornarTipoJornada($codpes)
    {
        if ($vinculos = Pessoa::listarVinculos($codpes, $ativos = true)) {
            $tipoJornada = $vinculos[0]['tipjor'];
        } else {
            $tipoJornada = '-';
        }
        return $tipoJornada;
    }

    /**
     * Retorna o setor do 1o vinculo ativo da pessoa
     */
    public static function retornarSetor($codpes)
    {
        if ($vinculos = Pessoa::listarVinculos($codpes, $ativos = true)) {
            $nomeAbreviadoSetor = $vinculos[0]['nomabvset'];
        } else {
            $nomeAbreviadoSetor = '-';
        }
        return $nomeAbreviadoSetor;
    }

    /**
     * Mostra o endereço formatado em pessoa->replicado()
     */
    public static function retornarEnderecoFormatado($codpes)
    {
        if ($endereco = PessoaReplicado::obterEndereco($codpes)) {
            $endereco = "
                {$endereco['nomtiplgr']} {$endereco['epflgr']},
                {$endereco['numlgr']} {$endereco['cpllgr']} -
                {$endereco['nombro']} - {$endereco['cidloc']}  -
                {$endereco['sglest']} - CEP: {$endereco['codendptl']}
            ";
        } else {
            $endereco = 'Não encontrado';
        }
        return $endereco;
    }

    public static function procurarServidorPorNome($nome, $fonetico = true)
    {
        foreach (PessoaReplicado::procurarPorNome($nome, $fonetico, true) as $pessoa) {
            if (isset($pessoa['tipvin']) && $pessoa['tipvin'] == 'SERVIDOR') {
                return $pessoa;
            }
        }
        return null;
    }
}

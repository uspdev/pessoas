<?php

namespace App\Replicado;

use Uspdev\Replicado\DB;
use Uspdev\Replicado\Graduacao as GraduacaoReplicado;
use Uspdev\Replicado\Replicado;
use Uspdev\Replicado\Replicado as Config;

class Graduacao extends GraduacaoReplicado
{

    // descrição de cada tipoObrigatoriedade da tabela GRADECURRICULAR
    public static $tipobg = [
        'O' => 'Obrigatória',
        'E' => 'Eletiva',
        'P' => 'Optativa',
        'L' => 'Optativa livre',
        'F' => 'Facultativa',
        'C' => 'Complementar',
    ];

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
        $query = " SELECT CC.codpesdct codpescoord, CC.dtainicdn, CC.dtafimcdn, P.nompes nompescoord, C.*, H.* FROM CURSOGR C
            INNER JOIN HABILITACAOGR H ON C.codcur = H.codcur
            INNER JOIN CURSOGRCOORDENADOR CC ON CC.codcur = C.codcur AND CC.codhab = H.codhab 
            INNER JOIN PESSOA P ON P.codpes = CC.codpesdct
            WHERE C.codclg IN (__codundclgs__)
                AND CC.dtafimcdn > GETDATE() -- mandato vigente do coordenador
                AND ( (C.dtaatvcur IS NOT NULL) AND (C.dtadtvcur IS NULL) ) -- curso ativo
                AND ( (H.dtaatvhab IS NOT NULL) AND (H.dtadtvhab IS NULL) ) -- habilitação ativa
            ORDER BY C.nomcur, H.nomhab ASC";

        $query = str_replace("__codundclgs__", Config::getInstance()->codundclgs, $query);

        return DB::fetchAll($query);
    }

    /**
     * Modificado de obterCursoAtivo para incluir a sigla da unidade e procurar em qualquer unidade
     *
     */
    public static function obterCursoAtivoUnidades($codpes)
    {
        $query = "SELECT L.codpes, L.nompes, F.sglfusclgund AS sglund, C.codcur, C.nomcur, H.codhab, H.nomhab, V.dtainivin, V.codcurgrd
        FROM LOCALIZAPESSOA L
        INNER JOIN VINCULOPESSOAUSP V ON (L.codpes = V.codpes) AND (L.codundclg = V.codclg)
        INNER JOIN CURSOGR C ON (V.codcurgrd = C.codcur)
        INNER JOIN HABILITACAOGR H ON (H.codhab = V.codhab)
        INNER JOIN FUSAOCOLEGIADOUNIDADE F ON (F.codfusclgund = L.codundclg)
        WHERE (L.codpes = convert(int,:codpes))
            AND (L.tipvin = 'ALUNOGR')
            AND (V.codcurgrd = H.codcur AND V.codhab = H.codhab)
        ";
        return DB::fetch($query, ['codpes' => $codpes]);

        // Aqui seria para reaproveitar utilizando qualquer unidade mas não inclui a sigla da unidade
        // Config::setConfig(['codundclgs' => 'SELECT codund FROM UNIDADE']);
        // $ret = Graduacao::obterCursoAtivo($codpes);
        // Config::setConfig(['reset' => true]);
        // return $ret;
    }

    /**
     * Disciplinas (grade curricular) para um currículo atual no JúpiterWeb
     * a partir do código do curso e da habilitação
     *
     * @param String $codcur
     * @param Int $codhab
     * @return Array(coddis, nomdis, verdis, numsemidl, tipobg)
     */
    public static function listarDisciplinasCurriculo($codcur, $codhab)
    {
        // estava dando erro no TOP na FFLCH. Então tirei o top e incuí o dtafimcrl para pegar o ativo.
        $query = "SELECT G.coddis, D.nomdis, G.verdis, G.numsemidl, G.tipobg
            FROM GRADECURRICULAR G
                INNER JOIN DISCIPLINAGR D ON (G.coddis = D.coddis AND G.verdis = D.verdis)
            WHERE G.codcrl IN (
                SELECT codcrl
                FROM CURRICULOGR
                WHERE codcur = convert(int, :codcur)
                    AND codhab = convert(int, :codhab)
                    AND dtafimcrl is NULL
            )";
        $param = [
            'codcur' => $codcur,
            'codhab' => $codhab,
        ];
        return DB::fetchAll($query, $param);
    }
}

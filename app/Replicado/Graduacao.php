<?php

namespace App\Replicado;

use Uspdev\Replicado\DB;
use Uspdev\Replicado\Graduacao as GraduacaoReplicado;
use Uspdev\Replicado\Replicado;
use Uspdev\Replicado\Replicado as Config;

class Graduacao extends GraduacaoReplicado
{

    /**
     * tipoObrigatoriedade da tabela GRADECURRICULAR
     *
     * Conforme descrito na documentação
     */
    public static $tipobg = [
        'O' => 'Obrigatória',
        'E' => 'Eletiva',
        'P' => 'Optativa',
        'L' => 'Optativa livre',
        'F' => 'Facultativa',
        'C' => 'Complementar',
    ];

    /**
     * tipoHabilitacao da tabela HABILITACAOGR
     *
     * Os tipos foram obtidos consultando o BD da EESC e
     * os que tem ?? não são descirtos na documentação
     */
    public static $tiphab = [
        'B' => 'Grau principal exclusivo',
        'G' => 'Grau principal com sequência opcional',
        'H' => 'H ??',
        'I' => 'I ??',
        'J' => 'J ??',
        'L' => 'L ??',
        'M' => 'M ??',
        'N' => 'N ??',
        'O' => 'O ??',
        'P' => 'P ??',
        'S' => 'S ??',
        'U' => 'Núcleo básico ou geral',
    ];

    /**
     * status-turma de TURMAGR
     */
    public static $statur = [
        'A' => 'Ativa',
        'D' => 'Não ativa',
        'C' => 'Consolidada',
    ];

    /**
     * disciplina-curicular de HABILTURMA
     */
    public static $discrl = [
        'O' => 'Obrigatória',
        'L' => 'Optativa livre',
        'C' => 'Optativa complementar',
        'N' => 'Extra curricular',
    ];

    //Ciclo da disciplina dentro da grade curricular do curso de graduação:
    //B- Básico, P- Profissional, T- Profissionalizante, E- Estágio ou C- TCC.
    //OBS: O ciclo é utilizado apenas para as disciplinas obrigatórias.
    // Sem uso ainda
    public static $cicdisgdecrl = [
        'B' => 'Basico',
        'P' => 'Profissional',
        'T' => 'Profissionalizante',
        'E' => 'Estágio',
        'C' => 'TCC',
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
        $query = " SELECT CC.codpesdct codpescoord, CC.dtainicdn, CC.dtafimcdn, P.nompes nompescoord,
            C.*, H.* FROM CURSOGR C
            INNER JOIN HABILITACAOGR H ON C.codcur = H.codcur
            INNER JOIN CURSOGRCOORDENADOR CC ON CC.codcur = C.codcur AND CC.codhab = H.codhab
            INNER JOIN PESSOA P ON P.codpes = CC.codpesdct
            WHERE C.codclg IN (__codundclgs__)
                AND CC.dtafimcdn > GETDATE() -- mandato vigente do coordenador
                AND ( (C.dtaatvcur IS NOT NULL) AND (C.dtadtvcur IS NULL) ) -- curso ativo
                AND ( (H.dtaatvhab IS NOT NULL) AND (H.dtadtvhab IS NULL) ) -- habilitação ativa
            ORDER BY C.nomcur, H.nomhab ASC";

        // aqui está sem o coordenador que estava dando problema na dupla formacao iau
        $query = " SELECT C.*, H.* FROM CURSOGR C
        INNER JOIN HABILITACAOGR H ON C.codcur = H.codcur
        WHERE C.codclg IN (__codundclgs__)
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
     * 
     * a partir do código do curso e da habilitação
     * adaptado de listarDisciplinasGradeCurricular
     *
     * @param String $codcur
     * @param Int $codhab
     * @return Array(coddis, nomdis, verdis, numsemidl, tipobg)
     */
    public static function listarDisciplinasCurriculo($codcur, $codhab)
    {
        // estava dando erro no TOP na FFLCH. Então tirei o top e incuí
        // o dtafimcrl para pegar o ativo.
        // acrescentado dtainicrl pois tem aqueles que ainda não inicaram
        // em tese deve retornar somente 1 codcrl
        $query = "SELECT G.*, D.*
            FROM GRADECURRICULAR G
                INNER JOIN DISCIPLINAGR D ON (G.coddis = D.coddis AND G.verdis = D.verdis)
            WHERE G.codcrl IN (
                SELECT codcrl
                FROM CURRICULOGR
                WHERE codcur = convert(int, :codcur)
                    AND codhab = convert(int, :codhab)
                    AND dtainicrl IS NOT NULL
                    AND dtafimcrl is NULL
            )";
        $param = [
            'codcur' => $codcur,
            'codhab' => $codhab,
        ];
        return DB::fetchAll($query, $param);
    }

    /**
     * Lista as turmas oferecidas em determinado semestre
     *
     * @param Int $codcur Codigo do curso
     * @param String $codhab Código da habilitação
     * @param String $codtur Código da turma que será concatenado com %
     * @return Array
     * @author Masaki K Neto, em 28/3/2023
     */
    public static function listarTurmas(int $codcur, int $codhab, $semestre)
    {
        $listaCoddis = array_column(self::listarDisciplinasCurriculo($codcur, $codhab), 'coddis');
        $strCoddis = implode("','", $listaCoddis);

        // turmas baseadas em habilturma
        $query = "SELECT T.*, D.*, H.*
            FROM TURMAGR T
            INNER JOIN DISCIPLINAGR D ON D.coddis = T.coddis AND D.verdis = T.verdis
            INNER JOIN HABILTURMA H ON H.coddis = T.coddis AND H.verdis = T.verdis AND H.codtur = T.codtur
            -- INNER JOIN ATIVIDADEDOCENTE A ON A.coddis = T.coddis AND A.verdis = T.verdis AND A.codtur = T.codtur
            WHERE T.codtur LIKE :semestre AND H.codcur = CONVERT(INT, :codcur) AND H.codhab = CONVERT(INT, :codhab)
                AND T.coddis IN ('$strCoddis')
                AND T.statur != 'D' -- exclui as não ativas
        ";
        $param['codcur'] = $codcur;
        $param['codhab'] = $codhab;
        $param['semestre'] = $semestre . '%';
        $res = DB::fetchAll($query, $param);

        // removendo coddis que já foram selecionados
        $listaCoddis = array_diff($listaCoddis, array_column($res, 'coddis'));
        $strCoddis = implode("','", $listaCoddis);

        // lista baseada em listaCoddis menos as que já forma selecionadas de habilturma
        $query = "SELECT T.*, D.*
            FROM TURMAGR T
            INNER JOIN DISCIPLINAGR D ON D.coddis = T.coddis AND D.verdis = T.verdis
            WHERE T.codtur LIKE :semestre
                AND T.coddis IN ('$strCoddis')
                AND T.statur != 'D'
        ";
        $res2 = DB::fetchAll($query, ['semestre' => $semestre . '%']);

        return array_merge($res, $res2);
    }

    /**
     * Lista os ministrantes de uma turma
     *
     * $turma são os dados de TURMAGR, especificamente coddis, verdis e codtur
     *
     * @param Array $turma
     * @return Array
     * @author Masaki K Neto, em 28/3/3023
     */
    public static function listarMinistrante($turma)
    {
        $params['coddis'] = $turma['coddis'];
        $params['verdis'] = $turma['verdis'];
        $params['codtur'] = $turma['codtur'];

        $query = "SELECT P.nompesttd nompes, M.codpes, M.stamis
            FROM MINISTRANTE M
            INNER JOIN PESSOA P ON P.codpes = M.codpes
            WHERE coddis = :coddis
                AND verdis = CONVERT(INT, :verdis)
                AND codtur = :codtur";
        $res = DB::fetchAll($query, $params);
        return empty($res) ? $res : array_unique($res, SORT_REGULAR);
    }

    /**
     * Lista os professores que constam na tabela ATIVIDADEDOCENTE de uma turma
     *
     * $turma são os dados de TURMAGR, especificamente coddis, verdis e codtur
     *
     * @param Array $turma
     * @return Array
     * @author Masaki K Neto, em 28/3/3023
     */
    public static function listarAtivDidaticas($turma)
    {
        $params['coddis'] = $turma['coddis'];
        $params['verdis'] = $turma['verdis'];
        $params['codtur'] = $turma['codtur'];

        $query = "SELECT P.nompesttd nompes, A.codpes, A.nomatv
            FROM ATIVIDADEDOCENTE A
            INNER JOIN PESSOA P ON P.codpes = A.codpes
            WHERE coddis = :coddis
                AND verdis = CONVERT(INT, :verdis)
                AND codtur = :codtur
        ";

        $res = DB::fetchAll($query, $params);
        return empty($res) ? $res : array_unique($res, SORT_REGULAR);
    }
}

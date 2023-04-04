<?php

namespace App\Http\Controllers;

use App\Replicado\Graduacao;
use App\Replicado\Lattes;
use App\Replicado\Pessoa;
use Illuminate\Http\Request;
use Uspdev\Replicado\Uteis;

class GraduacaoController extends Controller
{
    public function relatorioPorNomes(Request $request)
    {
        $this->authorize('graduacao');
        \UspTheme::activeUrl('graduacao/relatorio/nomes');

        $pessoas = [];
        $naoEncontrados = [];

        if ($request->nomes) {
            $nomes = $request->nomes;
            $nomes = str_replace("\r", '', $nomes); // remove carriage return, mantém new line
            $nomes = explode(PHP_EOL, $nomes);
            $nomes = array_filter($nomes); // remove elementos empty()
            $nomes = array_map('trim', $nomes);
            $nomes = array_unique($nomes); // sem repetidos

            foreach ($nomes as $nome) {
                // vamos procurar 1o por nome exato e depois por fonetico
                if ($pessoaReplicado = Pessoa::procurarServidorPorNome($nome, $fonetico = false) ?? Pessoa::procurarServidorPorNome($nome, $fonetico = true)) {
                    $pessoa = [];
                    $pessoa['unidade'] = $pessoaReplicado['sglclgund'];
                    $pessoa['nome'] = $pessoaReplicado['nompesttd'];
                    $pessoa['codpes'] = $pessoaReplicado['codpes'];
                    $pessoa['lattes'] = Lattes::id($pessoa['codpes']);
                    $pessoa['nomeFuncao'] = $pessoaReplicado['nomfnc'];
                    $pessoa['dtaultalt'] = Lattes::retornarDataUltimaAlteracao($pessoa['codpes']);
                    $pessoa['orcid_id'] = Lattes::retornarOrcidId($pessoa['codpes']);
                    $pessoa['tipoJornada'] = Pessoa::retornarTipoJornada($pessoa['codpes']);
                    $pessoa['departamento'] = Pessoa::retornarSetor($pessoa['codpes']);
                    $pessoa = array_merge($pessoa, Lattes::retornarFormacaoAcademicaFormatado($pessoa['codpes']));

                    $pessoas[] = $pessoa;
                } else {
                    $naoEncontrados[] = $nome;
                }
            }
        }

        return view('grad.index', [
            'pessoas' => $pessoas,
            'nomes' => $request->nomes,
            'naoEncontrados' => $naoEncontrados,
        ]);
    }

    public function cursos()
    {
        $this->authorize('graduacao');
        \UspTheme::activeUrl('graduacao/cursos');

        $cursos = Graduacao::listarCursosHabilitacoes();
        $u = New Uteis;

        return view('grad.cursos', compact('cursos', 'u'));
    }

    public function gradeCurricular(Request $request, int $codcur, int $codhab)
    {
        $this->authorize('graduacao');
        \UspTheme::activeUrl('graduacao/cursos');

        foreach (Graduacao::listarCursosHabilitacoes() as $curso) {
            if ($curso['codcur'] == $codcur && $curso['codhab'] == $codhab) {
                break;
            }
        }

        $disciplinas = Graduacao::listarGradeCurricular($codcur, $codhab);
        $disciplinas = collect($disciplinas)->sortBy(['numsemidl', ['tipobg', 'desc']]);

        return view('grad.grade-curricular', compact('disciplinas', 'curso'));
    }

    public function turmas(Request $request, int $codcur, int $codhab)
    {
        $this->authorize('graduacao');
        \UspTheme::activeUrl('graduacao/cursos');

        $semestres = ['20232', '20231', '20222', '20221', '20212', '20211'];
        $semestreFim = date('Y') . (date('m') < 7 ? 1 : 2);
        $semestreFim = $request->semestreFim ? $request->semestreFim : $semestreFim;

        $semestreIni = $semestres[array_search($semestreFim, $semestres)+1];
        $semestreIni = $request->semestreIni ? $request->semestreIni : $semestreIni;

        foreach (Graduacao::listarCursosHabilitacoes() as $curso) {
            if ($curso['codcur'] == $codcur && $curso['codhab'] == $codhab) {
                break;
            }
        }

        $keyIni = array_search($semestreIni, $semestres);
        $keyFim = array_search($semestreFim, $semestres);
        if ($keyFim > $keyIni) {
            $tmp = $keyIni;
            $keyIni = $keyFim;
            $keyFim = $tmp;
        }
        $turmas = [];
        for ($i = $keyFim; $i <= $keyIni; $i++) {
            $turmas = array_merge($turmas, Graduacao::listarTurmas($codcur, $codhab, $semestres[$i]));
        }
        $nomes = [];
        $AtivDidaticas = [];
        foreach ($turmas as &$turma) {
            $turma['ministrantes'] = Graduacao::listarMinistrante($turma);
            $turma['ativDidaticas'] = Graduacao::listarAtivDidaticas($turma);
            if ($turma['ativDidaticas']) {
                $nomes = array_merge($nomes, $turma['ativDidaticas']);
            } else {
                $nomes = array_merge($nomes, $turma['ministrantes']);
            }
        }
        $nomes = array_column($nomes, 'nompes');
        $nomes = array_unique($nomes); // sem repetidos
        $nomesCount = count($nomes);
        $nomes = implode(PHP_EOL, $nomes);

        return view('grad.turmas', [
            // 'codtur' => $codtur,
            'semestreFim' => $semestreFim,
            'semestreIni' => $semestreIni,
            'curso' => $curso,
            'turmas' => $turmas,
            'graduacao' => Graduacao::class,
            'turmaSelect' => $semestres,
            'nomes' => $nomes,
            'nomesCount' => $nomesCount,
        ]);
    }
}

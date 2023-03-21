<?php

namespace App\Http\Controllers;

use App\Replicado\Graduacao;
use App\Replicado\Lattes;
use App\Replicado\Pessoa;
use Illuminate\Http\Request;

class GraduacaoController extends Controller
{
    public function relatorioPorNomes(Request $request)
    {
        $this->authorize('graduacao');

        $pessoas = [];
        $naoEncontrados = [];

        if ($request->nomes) {
            $nomes = $request->nomes;
            $nomes = str_replace("\r", '', $nomes);
            $nomes = explode(PHP_EOL, $nomes);
            $nomes = array_unique($nomes);
            $nomes = array_filter($nomes);

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

        return view('grad.index', ['pessoas' => $pessoas, 'nomes' => $request->nomes, 'naoEncontrados' => $naoEncontrados]);
    }

    public function relatorio()
    {
        $this->authorize('graduacao');

        $cursos = Graduacao::listarCursosHabilitacoes();
        // dd($cursos[0]);

        return view('grad.relatorios', compact('cursos'));
    }
}

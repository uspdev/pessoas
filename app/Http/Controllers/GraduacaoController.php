<?php

namespace App\Http\Controllers;

use App\Replicado\Lattes;
use App\Replicado\Pessoa;
use Illuminate\Http\Request;

class GraduacaoController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('admin');
        $pessoas = [];
        $naoEncontrados = [];

        if ($request->nomes) {
            $nomes = $request->nomes;
            $nomes = str_replace("\r", '', $nomes);
            $nomes = explode(PHP_EOL, $nomes);
            $nomes = array_unique($nomes);
            $nomes = array_filter($nomes);

            foreach ($nomes as $nome) {
                if ($pessoaReplicado = Pessoa::procurarServidorPorNome($nome)) {
                    $pessoa['unidade'] = $pessoaReplicado['sglclgund'];
                    $pessoa['nome'] = $nome;
                    $pessoa['codpes'] = $pessoaReplicado['codpes'];
                    $pessoa['lattes'] = Lattes::id($pessoa['codpes']);
                    $pessoa['nomeFuncao'] = $pessoaReplicado['nomfnc'];
                    list($pessoa['tipoJornada'], $pessoa['departamento']) = Pessoa::listarVinculosFormatado($pessoa['codpes']);
                    $pessoa['formacao'] = Lattes::retornarFormacaoAcademicaFormatado($pessoa['codpes']);

                    $pessoas[] = $pessoa;
                } else {
                    $naoEncontrados[] = $nome; // . ' (' . Uteis::fonetico($nome, $debug = true) . ')';
                }
            }
        }

        return view('grad.index', ['pessoas' => $pessoas, 'nomes' => $request->nomes, 'naoEncontrados' => $naoEncontrados]);
    }
}

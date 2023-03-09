<?php

namespace App\Http\Controllers;

use App\Replicado\Pessoa;
use Illuminate\Http\Request;
use Uspdev\Replicado\Lattes;

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
            sort($nomes);

            foreach ($nomes as $nome) {

                if ($pessoaReplicado = Pessoa::procurarServidorPorNome($nome)) {

                    $pessoa['unidade'] = $pessoaReplicado['sglclgund'];
                    $pessoa['nome'] = $nome;

                    $pessoa['codpes'] = $pessoaReplicado['codpes'];
                    $pessoa['lattes'] = Lattes::id($pessoa['codpes']);

                    $pessoa['nomeFuncao'] = $pessoaReplicado['nomfnc'];
                    $pessoa['regime'] = '';

                    if ($vinculos = Pessoa::listarVinculos($pessoa['codpes'], $ativos = true)) {
                        $pessoa['tipoJornada'] = $vinculos[0]['tipjor'];
                        $pessoa['departamento'] = $vinculos[0]['nomabvset'];
                    } else {
                        $pessoa['tipoJornada'] = '-';
                        $pessoa['departamento'] = '-';
                    }

                    if ($formacao = Lattes::retornarFormacaoAcademica($pessoa['codpes'])) {
                        unset($formacao['GRADUACAO']);
                        $pessoa['formacao'] = ucwords(strtolower(implode(', ',array_keys($formacao))));
                    }


                    if ($pessoa['codpes'] == 62834) {
                        // dd($pessoaReplicado, $vinculos);

                    }

                    $pessoas[] = $pessoa;
                }
                else {
                    $naoEncontrados[] = $nome;
                }
            }

            // dd($request->nomes, $nomes, $pessoas);
        }

        // $pessoas = [];
        return view('grad.index', ['pessoas' => $pessoas, 'nomes' => $request->nomes, 'naoEncontrados' => $naoEncontrados]);
    }
}

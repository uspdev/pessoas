<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaRequest;
use App\Models\Pessoa;
use App\Replicado\Lattes;
use App\Replicado\Pessoa as pessoaReplicado;
use Illuminate\Http\Request;
use Uspdev\Replicado\Estrutura;
use Uspdev\Wsfoto;

class PessoaController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('pessoas.basico');

        $tiposVinculos = PessoaReplicado::tiposVinculos(config('replicado.codundclg'));
        $listarSetores = Estrutura::listarSetores();

        # Caso 1: Nenhuma busca feita ainda, só mostramos o formulário
        if (empty($request->codpes) && empty($request->nompes) && empty($request->tipvinext) && empty($request->codset)) {
            return view('pessoas.index', compact('tiposVinculos', 'listarSetores'));
        }

        # Caso 2: Busca apenas por um campo
        $campos = ['codpes', 'nompes', 'tipvinext', 'codset'];
        $contaQuantosCamposPreenchidos = 0;
        foreach ($campos as $campo) {
            if (!empty($request[$campo])) {
                $contaQuantosCamposPreenchidos++;
            }
        }

        // Só busca se apenas um campo for preenchido
        if ($contaQuantosCamposPreenchidos > 1) {
            $request->session()->flash('alert-danger', 'Busca apenas por nº USP, ou por Nome, ou por Vínculo, ou por Setor e não por ambos');
            return redirect('/');
        }

        # Caso 3: Se a busca tiver codpes, vamos priorizá-lo
        if (!empty($request->codpes)) {
            $request->validate([
                'codpes' => 'required|integer',
            ]);
            /* Verificamos se a pessoa existe no replicado */
            if (empty(PessoaReplicado::dump($request->codpes))) {
                $request->session()->flash('alert-danger', 'Pessoa não encontrada');
                return redirect('/');
            }
            return redirect("/pessoas/{$request->codpes}");
        }

        # Caso 4: Se a busca tiver nompes, vamos montar uma lista de possíveis candidatos
        if (!empty($request->nompes)) {
            $pessoas = PessoaReplicado::procurarPorNome($request->nompes, true, false);
            if (empty($pessoas)) {
                $request->session()->flash('alert-danger', 'Nenhuma pessoa encontrada');
            }
            return view('pessoas.index', [
                'pessoas' => $pessoas,
                'tiposVinculos' => $tiposVinculos,
                'listarSetores' => $listarSetores,
            ]);
        }

        # Caso 5: Se a busca tiver vínculo, lista as pessoas do tipo de vínculo
        if (!empty($request->tipvinext)) {
            // Verificar se o código de unidade pode ser opicional no método Pessoa::ativosVinculos
            if ($request->tipvinext == 'Servidor' or $request->tipvinext == 'Docente' or $request->tipvinext == 'Docente Aposentado') {
                $pessoas = PessoaReplicado::listarMaisInformacoesServidores($request->tipvinext);
            } else {
                $pessoas = PessoaReplicado::ativosVinculo($request->tipvinext, config('replicado.codundclg'));
            }
            if (empty($pessoas)) {
                $request->session()->flash('alert-danger', 'Nenhuma pessoa encontrada');
            }
            return view('pessoas.index', [
                'pessoas' => $pessoas,
                'tiposVinculos' => $tiposVinculos,
                'listarSetores' => $listarSetores,
            ]);
        }

        # Caso 6: Se a busca tiver setor, lista as pessoas do setor
        if (!empty($request->codset)) {
            $aposentados = ($request->docente_aposentado == null) ? 1 : 0;
            $pessoas = PessoaReplicado::listarServidoresSetor($request->codset, $aposentados);
            if (empty($pessoas)) {
                $request->session()->flash('alert-danger', 'Nenhuma pessoa encontrada');
            }
            return view('pessoas.index', [
                'pessoas' => $pessoas,
                'tiposVinculos' => $tiposVinculos,
                'listarSetores' => $listarSetores,
            ]);
        }
    }

    public function show(Request $request, $codpes)
    {
        $this->authorize('pessoas.basico');
        /* Verificamos se a pessoa existe no replicado */
        if (empty(PessoaReplicado::dump($codpes))) {
            $request->session()->flash('alert-danger', 'Pessoa não encontrada');
            return redirect('/');
        }

        /* Se existe no replicado, cadastramos localmente */
        $pessoa = Pessoa::where('codpes', $codpes)->first();
        if (!$pessoa) {
            $pessoa = new Pessoa;
            $pessoa->codpes = $request->codpes;
            // $pessoa->save();
        }

        if (config('pessoas.mostrarFotoLattes') && Lattes::id($pessoa->codpes)) {
            $fotoLattes = base64_encode(Lattes::obterFoto(Lattes::id($pessoa->codpes)));
        } else {
            $fotoLattes = '';
        }
        $foto = Wsfoto::obter($codpes);

        $tiposVinculos = PessoaReplicado::tiposVinculos(config('replicado.codundclg'));
        $listarSetores = Estrutura::listarSetores();

        \UspTheme::activeUrl($pessoa->obterCategoria());
        return view('pessoas.show', compact('pessoa', 'foto', 'fotoLattes', 'tiposVinculos', 'listarSetores'));
    }

    public function edit($codpes)
    {
        $this->authorize('pessoas.complementar');
        $pessoa = Pessoa::where('codpes', $codpes)->first();
        if (!$pessoa) {
            $pessoa = new Pessoa;
            $pessoa->codpes = $codpes;
        }

        \UspTheme::activeUrl($pessoa->obterCategoria());
        return view('pessoas.edit')->with([
            'codpes' => $codpes,
            'pessoa' => $pessoa,
        ]);
    }

    public function update(PessoaRequest $request, $codpes)
    {
        $this->authorize('pessoas.complementar');
        $validated = $request->validated();

        $pessoa = Pessoa::where('codpes', $codpes)->first();
        if (!$pessoa) {
            $pessoa = new Pessoa;
            $pessoa->codpes = $codpes;
        }
        $pessoa->fill($validated);
        $pessoa->save();

        $request->session()->flash('alert-info', 'Dados editados com sucesso!');
        return redirect(route('pessoas.show', $codpes));
    }
}

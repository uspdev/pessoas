<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PessoaRequest;
use App\Models\Pessoa;
use App\Utils;
use App\Utils\ReplicadoUtils;

class PessoaController extends Controller
{
    public function index(Request $request)
    {
        # Caso 1: Nenhuma busca feita ainda, só mostramos o formulário
        if(empty($request->codpes) && empty($request->nompes)){
            return view('pessoas.index');
        }

        $this->authorize('admin');
        # Caso 2: Busca apenas por nome ou número USP e não por ambos
        if(!empty($request->codpes) && !empty($request->nompes)){
            $request->session()->flash('alert-danger', 'Busca apenas por nome ou número USP e não por ambos');
            return redirect('/'); 
        }

        # Caso 3: Se a busca tiver codpes, vamos priorizá-lo
        if(!empty($request->codpes)){
            $request->validate([
                'codpes' => 'required|integer',
            ]);
            /* Verificamos se a pessoa existe no replicado */
            if(empty(\Uspdev\Replicado\Pessoa::dump($request->codpes))){
                $request->session()->flash('alert-danger', 'Pessoa não encontrada');
                return redirect('/');
            }
            return redirect("/pessoas/{$request->codpes}");
        }

        # Caso 4: Se a busca tiver nompes, vamos montar uma lista de possíveis candidatos
        if(!empty($request->nompes)){
            $pessoas = \Uspdev\Replicado\Pessoa::procurarPorNome($request->nompes, true, false);
            if(empty($pessoas)){
                $request->session()->flash('alert-danger', 'Nenhum pessoa encontrada');
            }
            return view('pessoas.index',[
                'pessoas' => $pessoas 
            ]);
        }

    }

    public function show(Request $request, $codpes)
    {
        $this->authorize('admin');

        /* Verificamos se a pessoa existe no replicado */
        if(empty(\Uspdev\Replicado\Pessoa::dump($codpes))){
            $request->session()->flash('alert-danger', 'Pessoa não encontrada');
            return redirect('/');
        }

        /* Se existe no replicado, cadastramos localmente */
        $pessoa = Pessoa::where('codpes',$codpes)->first();
        if(!$pessoa){
            $pessoa = new Pessoa;
            $pessoa->codpes = $request->codpes;
            $pessoa->save();
        }
        
        return view('pessoas.show')->with('pessoa',$pessoa);
    }

    public function edit($codpes)
    {   
        $this->authorize('admin');
        $pessoa = Pessoa::where('codpes',$codpes)->first();
        return view('pessoas.edit')->with([
            'codpes' => $codpes,
            'pessoa' => $pessoa
            ]);
    }

    public function update(PessoaRequest $request, $codpes)
    {
        $this->authorize('admin');
        $pessoa = Pessoa::where('codpes',$codpes)->first();
        $pessoa->update($request->validated());
        $request->session()->flash('alert-info', 'Dados editados com sucesso!');
        return redirect("/pessoas/{$codpes}");
    }

}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PessoaRequest;
use App\Pessoa;
use App\Utils;
use App\Utils\ReplicadoUtils;

class PessoaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request){
        $this->authorize('admin');
        return view('pessoas.search');
    }

    public function store(Request $request){
        $this->authorize('admin');

        /* 1 - identificamos o número USP - busca por nome ou busca por codpes*/
        if(!empty($request->codpes)){
            $codpes = $request->codpes;
        } else if(!empty($request->by_codpes)){
            $codpes = $request->by_codpes;
        } else {
            $request->session()->flash('alert-danger', 'Pessoa não encontrada');
            return redirect('/'); 
        }

        /* 2- Verificamos se a pessoa existe no replicado */
        if(empty(\Uspdev\Replicado\Pessoa::dump($codpes))){
            $request->session()->flash('alert-danger', 'Pessoa não encontrada');
            return redirect('/');
        }

        /* 3 - se existe no replicado, cadastramos localmente */
        $pessoa = Pessoa::where('codpes',$codpes)->first();
        if(!$pessoa){
            $pessoa = new Pessoa;
            $pessoa->codpes = $codpes;
            $pessoa->save();
        }

        return redirect("/pessoas/{$codpes}");
    }

    public function show(Request $request, $codpes)
    {
        $this->authorize('admin');
        $pessoa = Pessoa::where('codpes',$codpes)->first();
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

    public function partenome(Request $request)
    {
        $this->authorize('admin');
        if($request->term) {
            $pessoa = \Uspdev\Replicado\Pessoa::nome($request->term);
        }
        return response($pessoa);
    }

}


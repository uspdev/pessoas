<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Uspdev\Replicado\Pessoa as PessoaR;

use App\Http\Requests\PessoaRequest;

use App\Pessoa;

use App\Utils;
use App\CamposExtras;

use App\Utils\ReplicadoUtils;

class PessoaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function form_codpes(Request $request){
        $this->authorize('admin');
        return view('pessoas.form_codpes');
    }

    public function form_nompes(Request $request){
        $this->authorize('admin');
        return view('pessoas.nompes');
    }

    public function show(Request $request)
    {
        $this->authorize('admin');

        $request->validate([
            'codpes' => 'required|integer',
        ]);

        $pessoa = CamposExtras::where('codpes',$request->codpes)->first();
        if(!$pessoa){
            $pessoa = new CamposExtras;
        }

        $pessoa = PessoaR::dump($request->codpes);
        if(empty($pessoa)){
            $request->session()->flash('alert-danger', 'Pessoa não encontrada');
            return redirect('pessoas/codpes');
        }
        
        $telefones = PessoaR::telefones($request->codpes);
        $emails = PessoaR::emails($request->codpes);
        $vinculos = PessoaR::vinculos($request->codpes);

        $endereco = PessoaR::obterEndereco($request->codpes);
        // Formata endereço
        $endereco = [
            $endereco['nomtiplgr'],
            $endereco['epflgr'] . ",",
            $endereco['numlgr'] . " ",
            $endereco['cpllgr'] . " - ",
            $endereco['nombro'] . " - ",
            $endereco['cidloc'] . " - ",
            $endereco['sglest'] . " - ",
            "CEP: " . $endereco['codendptl'],
        ];

        return view('pessoas.show',compact('pessoa','telefones','emails','vinculos','endereco','campos_extras'));
    }

    public function edit($codpes)
    {   
        $this->authorize('admin');
        $pessoa = $this->load_campos_extras($codpes);
        return view('campos_extras.form')->with([
            'codpes' => $codpes,
            'campos_extras' => $pessoa
            ]);
    }

    public function update(CamposExtrasRequest $request, $codpes)
    {
        $this->authorize('admin');
        $pessoa = $this->load_campos_extras($codpes);
        $pessoa->update($request->all());
        $request->session()->flash('alert-info', 'Dados editados com sucesso!');
        return redirect()->action('PessoaController@codpes', ['codpes'=>$codpes]);
    }

    /* Métodos auxiliares */
    private function load_campos_extras($codpes){
        $pessoa = CamposExtras::where('codpes',$codpes)->first();
        if(!$pessoa){
            $pessoa = new CamposExtras;
            $pessoa->codpes = $codpes;
            $pessoa->save();
        }
        return $pessoa;
    }

    public function partenome(Request $request)
    {
        $this->authorize('admin');
        if($request->term) {
            $pessoa = PessoaR::nome($request->term);
        }
        return response($pessoa);
    }

}


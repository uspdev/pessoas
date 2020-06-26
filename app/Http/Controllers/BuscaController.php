<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Uspdev\Replicado\Pessoa;

use App\Utils;
use App\CamposExtras;

use App\Utils\ReplicadoUtils;

class BuscaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function codpes(Request $request)
    {
        $this->authorize('admin');

        $request->validate([
            'codpes' => 'required|integer',
        ]);

        $campos_extras = CamposExtras::where('codpes',$request->codpes)->first();
        if(!$campos_extras){
            $campos_extras = new CamposExtras;
        }

        $pessoa = Pessoa::dump($request->codpes);
        if(empty($pessoa)){
            $request->session()->flash('alert-danger', 'Pessoa não encontrada');
            return redirect('buscas/codpes');
        }
        $telefones = Pessoa::telefones($request->codpes);
        $emails = Pessoa::emails($request->codpes);
        $vinculos = Pessoa::vinculos($request->codpes);

        $endereco = Pessoa::obterEndereco($request->codpes);
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

        return view('buscas.show',compact('pessoa','telefones','emails','vinculos','endereco','campos_extras'));
    }

    public function partenome(Request $request)
    {
        $this->authorize('admin');
        if($request->term) {
            $pessoa = Pessoa::nome($request->term);
        }

        return response($pessoa);
    }

}


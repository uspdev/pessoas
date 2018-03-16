<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Uspdev\Replicado\Connection;
use Uspdev\Replicado\Pessoa;

class BuscaController extends Controller
{

    private $ip,$port,$db,$user,$pass;
    public function __construct()
    {
        $this->middleware('auth');

        $this->ip = env('REPLICADO_HOST');
        $this->port = env('REPLICADO_PORT');
        $this->db = env('REPLICADO_DB');
        $this->user = env('REPLICADO_USER');
        $this->pass = env('REPLICADO_PASS');
    }
 
    public function codpes(Request $request)
    {
        $request->validate([
            'codpes' => 'required|integer',
        ]);

        $replicado = new Connection($this->ip,$this->port,$this->db,$this->user,$this->pass);
        $replicado->setSybase();
        $p = new Pessoa($replicado->conn);
        $pessoa = $p->dump($request->codpes);
        $telefones = $p->telefones($request->codpes);
        $emails = $p->emails($request->codpes);
        $localizas = $p->localiza($request->codpes);
        return view('buscas.show',compact('pessoa','telefones','emails','localizas'));
    }
}




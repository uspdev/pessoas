<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Uspdev\Replicado\Connection;
use Uspdev\Replicado\Posgraduacao;
use Uspdev\Replicado\Graduacao;

class RelatorioController extends Controller
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
 
    public function pos()
    {
        $replicado = new Connection($this->ip,$this->port,$this->db,$this->user,$this->pass);
        $replicado->setSybase();
        $p = new Posgraduacao($replicado->conn);
        $csv = $p->ativosCsv(env('UNIDADE'));

        return response($csv)
            ->header('Content-Type' , 'application/force-download')
            ->header('Content-Disposition' , 'attachment')
            ->header('Content-transfer-encoding' , 'binary')
        ;
    }

    public function grad()
    {
        $replicado = new Connection($this->ip,$this->port,$this->db,$this->user,$this->pass);
        $replicado->setSybase();
        $g = new Graduacao($replicado->conn);
        $csv = $g->ativosCsv(env('UNIDADE'));

        return response($csv)
            ->header('Content-Type' , 'application/force-download')
            ->header('Content-Disposition' , 'attachment')
            ->header('Content-transfer-encoding' , 'binary')
        ;
    }  
}

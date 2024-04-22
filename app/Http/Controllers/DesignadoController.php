<?php

namespace App\Http\Controllers;

use App\Replicado\Pessoa;

class DesignadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:pessoas.avancado');
    }

    public function index()
    {
        return view('designados.index')->with([
            'designados' => Pessoa::listarDesignados()
        ]);
    }
}

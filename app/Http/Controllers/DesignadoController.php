<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesignadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:pessoas.avancado');
    }

    public function index()
    {
        return view('designados.index');
    }
}

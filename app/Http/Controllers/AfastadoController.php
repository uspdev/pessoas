<?php

namespace App\Http\Controllers;

use Uspdev\Replicado\Pessoa;

class AfastadoController extends Controller
{
	public function __construct() {
		$this->middleware('can:pessoas.avancado');
	}

	public function index() {
		return view('afastados.index')->with([
			'afastados' => Pessoa::listarAfastados()
		]);
	}
}

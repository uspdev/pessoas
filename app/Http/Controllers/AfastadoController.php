<?php

namespace App\Http\Controllers;

use Uspdev\Replicado\Pessoa;

class AfastadoController extends Controller
{
	public function __construct() {
		$this->middleware('can:pessoas.avancado');
	}

	public function index() {
		$afastados = Pessoa::listarAfastados();

		$afastados = array_map(function($afastado){
			$afastado['telefones'] = Pessoa::telefones($afastado['codpes']);
			return $afastado;
		}, $afastados);

		$afastados = array_map(function($afastado){
			$afastado['codema'] = Pessoa::email($afastado['codpes']);
			return $afastado;
		}, $afastados);

		return view('afastados.index')->with([
			'afastados' => $afastados
		]);
	}
}

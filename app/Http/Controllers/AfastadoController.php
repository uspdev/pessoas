<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AfastadoController extends Controller
{
	public function __construct() {
		$this->middleware('can:pessoas.avancado');
	}

	public function index() {
		return "Afastados";
	}
}

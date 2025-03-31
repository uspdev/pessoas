<?php

namespace App\Http\Controllers;

use App\Replicado\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Uspdev\Replicado\Posgraduacao;

class PosgradController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('posgraduacao');

        \UspTheme::activeUrl('posgrad');
        $programas = Posgraduacao::listarProgramas();

        # tratando POST
        if (isset($request->codcur)) {
            $request->validate([
                'codcur' => ['nullable', Rule::in(Arr::pluck($programas, 'codcur'))],
            ]);
            session(['codcur' => $request->codcur]);
        }

        // vamos obter a lista de alunos do programa
        $alunos = session('codcur') ? json_decode(json_encode(Posgraduacao::alunosPrograma(env('REPLICADO_CODUNDCLG'), session('codcur')))) : [];

        array_map(function($obj){
            $obj->telefones = Pessoa::telefones($obj->codpes);
            return $obj;
        }, $alunos);

        return view('posgrad.index', compact('programas', 'alunos'));
    }

    public function show($codcur)
    {

        $orientadores = json_decode(json_encode(Posgraduacao::orientadores('18134')));

        \UspTheme::activeUrl('posgrad');
        return view('posgrad.show', compact('orientadores'));
    }
}

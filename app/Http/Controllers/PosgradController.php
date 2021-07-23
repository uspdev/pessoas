<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Uspdev\Replicado\DB;
use Uspdev\Replicado\Posgraduacao;

class PosgradController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('admin');

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

        return view('posgrad.index', compact('programas', 'alunos'));
    }
}

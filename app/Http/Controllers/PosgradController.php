<?php

namespace App\Http\Controllers;

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

        // $submenu = [];
        // foreach ($programas as $programa) {
        //     $submenu[] = [
        //         'text' => $programa['nomcur'],
        //         'url' => 'posgrad/' . $programa['codcur'],
        //     ];
        // }

        // \UspTheme::addMenu('posgrad', [
        //     'text' => '',
        //     'can' => 'posgrad',
        //     // 'align' => 'right',
        //     'submenu' => $submenu,
        // ]);

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

    public function show($codcur)
    {

        $orientadores = json_decode(json_encode(Posgraduacao::orientadores('18134')));

        return view('posgrad.show', compact('orientadores'));
    }
}

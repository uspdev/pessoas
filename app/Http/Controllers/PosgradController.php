<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Uspdev\Replicado\Posgraduacao;
use Uspdev\Replicado\DB;

class PosgradController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('admin');

        # tratando POST
        if (isset($request->codcur)) {
            if ($request->codcur != 0) {
                $request->validate([
                    'codcur' => ['integer', Rule::in(Arr::pluck($programas, 'codcur'))],
                ]);
            }
            session(['codcur' => $request->codcur]);
        }

        $programas = SELF::listarProgramas();
        $alunos = session('codcur') ? json_decode(json_encode(Posgraduacao::alunosPrograma(18, session('codcur')))) : '';

        return view('posgrad.index', compact('programas', 'alunos'));
    }

    // Deve ir para o replicado\Posgraduacao
    public static function listarProgramas()
    {
        $codundclg = getenv('REPLICADO_CODUNDCLG');

        $query = "SELECT C.codcur, NC.nomcur
        FROM CURSO C
        INNER JOIN NOMECURSO NC ON C.codcur = NC.codcur
        WHERE (C.codclg IN ({$codundclg}))
            AND (C.tipcur = 'POS')
            AND (C.dtainiccp IS NOT NULL)
            AND (NC.dtafimcur IS NULL)
        ORDER BY NC.nomcur ASC";

        return \Uspdev\Replicado\DB::fetchAll($query);
    }
}

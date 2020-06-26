<?php

namespace App\Http\Controllers;

use App\CamposExtras;
use Illuminate\Http\Request;

class CamposExtrasController extends Controller
{

    public function edit($codpes)
    {
        return view('campos.form')->with('codpes',$codpes);
    }

    public function update(Request $request, $codpes)
    {
        $campos_extras = CamposExtras::where('codpes',$codpes)->first();
        if(!$campos_extras){
            $campos_extras = new CamposExtras;
            $campos_extras->codpes = $codpes;
            $campos_extras->save();
        }

        $campos_extras->update($request->all());
        
        $request->session()->flash('alert-info', 'Dados editados com sucesso!');
        return redirect()->action('BuscaController@codpes', ['codpes'=>5385361]);
    }

 
}

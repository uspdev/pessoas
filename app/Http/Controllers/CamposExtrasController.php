<?php

namespace App\Http\Controllers;

use App\CamposExtras;
use Illuminate\Http\Request;

class CamposExtrasController extends Controller
{

    private function load_campos_extras($codpes){
        $campos_extras = CamposExtras::where('codpes',$codpes)->first();
        if(!$campos_extras){
            $campos_extras = new CamposExtras;
            $campos_extras->codpes = $codpes;
            $campos_extras->save();
        }
        return $campos_extras;
    }

    public function edit($codpes)
    {
        $campos_extras = $this->load_campos_extras($codpes);
        return view('campos.form')->with([
            'codpes'=>$codpes,
            'campos_extras' => $campos_extras
            ]);
    }

    public function update(Request $request, $codpes)
    {
        $campos_extras = $this->load_campos_extras($codpes);
        $campos_extras->update($request->all());
        
        $request->session()->flash('alert-info', 'Dados editados com sucesso!');
        return redirect()->action('BuscaController@codpes', ['codpes'=>$codpes]);
    }

 
}

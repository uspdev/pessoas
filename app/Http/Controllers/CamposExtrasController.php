<?php

namespace App\Http\Controllers;

use App\CamposExtras;
use Illuminate\Http\Request;
use App\Http\Requests\CamposExtrasRequest;

use Carbon\Carbon;

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

    public function update(CamposExtrasRequest $request, $codpes)
    {
        $campos_extras = $this->load_campos_extras($codpes);
        
        // Tratamento datas
        $campos_extras->data_nascimento = implode('-',array_reverse(explode('/',$request->data_nascimento)));
        $campos_extras->validade_visto = implode('-',array_reverse(explode('/',$request->validade_visto)));
        //$$campos_extras->data_nascimento = Carbon::CreatefromFormat('d/m/Y', "$request->data_nascimento");
        //$$campos_extras->validade_visto = Carbon::CreatefromFormat('d/m/Y', "$request->validade_visto");

        $campos_extras->update($request->all());
        
        $request->session()->flash('alert-info', 'Dados editados com sucesso!');
        return redirect()->action('BuscaController@codpes', ['codpes'=>$codpes]);
    }

 
}

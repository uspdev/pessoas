<?php

namespace App\Http\Controllers;

use App\CamposExtras;
use Illuminate\Http\Request;

class CamposExtrasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campoExtra = CamposExtras::all();
        return view('campos.index', compact('campoExtra'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $campoExtra = new CamposExtras;
        $campoExtra->codpes = $request->codpes;
        $campoExtra->nome = $request->nome;
        $campoExtra->data_nascimento = $request->data_nascimento;
        $campoExtra->sexo = $request->sexo;
        $campoExtra->pai = $request->pai;
        $campoExtra->mae = $request->mae;
        $campoExtra->endereco = $request->endereco;
        $campoExtra->cep = $request->cep;
        $campoExtra->cidade = $request->cidade;
        $campoExtra->uf = $request->uf;
        $campoExtra->pais = $request->pais;
        $campoExtra->nacionalidade = $request->nacionalidade;
        $campoExtra->telefone = $request->telefone;
        $campoExtra->celular = $request->celular;
        $campoExtra->emails = $request->emails;
        $campoExtra->cpf = $request->cpf;
        $campoExtra->rg = $request->rg;
        $campoExtra->passaporte = $request->passaporte;
        $campoExtra->validade_visto = $request->validade_visto;
        $campoExtra->rne = $request->rne;
        $campoExtra->pis = $request->pis;
        $campoExtra->lotado = $request->lotado;
        $campoExtra->banco = $request->banco;
        $campoExtra->agencia = $request->agencia;
        $campoExtra->conta_corrente = $request->conta_corrente;
        $campoExtra->sigla_universidade = $request->sigla_universidade;
        $campoExtra->docente_usp = $request->docente_usp;
        $campoExtra->empenho = $request->empenho;

        $campoExtra->save();

        $request->session()->flash('alert-info', 'Dados editados com sucesso!');
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campoExtra = CamposExtras::findOrFail($id);
        return view('campos.edit', compact('campoExtra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campoExtra = CamposExtras::findOrFail($id);
        $campoExtra->delete();

        return "Registro deletado!";
    }
}

@extends('laravel-usp-theme::master')

@section('title', '')

@section('content_header')

@section('javascripts_head')
  <script src="{{asset('/js/camposExtras.js')}}"></script>
@endsection('javascript_head')

@section('content')

@include('alerts')

<form action="/camposExtras/{{$codpes}}" method="POST">
@csrf

<hr>

<div class="card">
  <div class="card-header"><b>Dados pessoais</b></div>
    <div class="card-body">

        <div class="row">

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="nome" class="required"><b>Nome: </b></label>
                    <input type="text" class="form-control" id="nome" name="nome" value="{{old('nome',$campos_extras->nome)}}">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="sexo" class="required"><b>Sexo: </b></label>
                    <input type="text" class="form-control" id="sexo" name="sexo" value="{{old('sexo',$campos_extras->sexo)}}">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="nacionalidade" class="required"><b>Nacionalidade: </b></label>
                    <input type="text" class="form-control" id="nacionalidade" name="nacionalidade" value="{{old('nacionalidade',$campos_extras->nacionalidade)}}">
                </div>
            </div>
        </div>


        <div class="row">

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="data_nascimento" class="required"><b>Data de nascimento: </b></label>
                    <input type="text" class="form-control datepicker data" id="data_nascimento" name="data_nascimento" value="{{old('data_nascimento',$campos_extras->data_nascimento)}}">
                </div>
            </div>   

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="mae" class="required"><b>Nome da mãe: </b></label>
                    <input type="text" class="form-control" id="mae" name="mae" value="{{old('mae',$campos_extras->mae)}}">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="pai" class="required"><b>Nome do pai: </b></label>
                    <input type="text" class="form-control" id="pai" name="pai" value="{{old('pai',$campos_extras->pai)}}">
                </div>
            </div>

        </div>


    </div>
</div>

<hr>

<div class="card">
    <div class="card-header"><b>Documentos</b></div>
    <div class="card-body">
        
        <div class="row">

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="cpf" class="required"><b>CPF: </b></label>
                    <input type="text" class="form-control cpf" id="cpf" name="cpf" value="{{old('cpf',$campos_extras->cpf)}}">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="rg" class="required"><b>RG: </b></label>
                    <input type="text" class="form-control rg" id="rg" name="rg" value="{{old('rg',$campos_extras->rg)}}">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="pis" class="required"><b>PIS: </b></label>
                    <input type="text" class="form-control" id="pis" name="pis" value="{{old('pis',$campos_extras->pis)}}">
                </div>
            </div>

        </div>


        <div class="row">

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="passaporte" class="required"><b>Passaporte: </b></label>
                    <input type="text" class="form-control" id="passaporte" name="passaporte" value="{{old('passaporte',$campos_extras->passaporte)}}">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="validade_visto" class="required"><b>Data de validade do visto: </b></label>
                    <input type="text" class="form-control datepicker data" id="validade_visto" name="validade_visto" value="{{old('validade_visto',$campos_extras->validade_visto)}}">
                </div>
            </div>   

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="rne" class="required"><b>RNE: </b></label>
                    <input type="text" class="form-control" id="rne" name="rne" value="{{old('rne',$campos_extras->rne)}}">
                </div>
            </div>

        </div>



    </div>

</div>
<hr>

<div class="card">
    <div class="card-header"><b>Endereços</b></div>
    <div class="card-body">

        <div class="row">

            <div class="col-sm form-group col-sm-8">
                <div class="form-group">
                    <label for="endereco" class="required"><b>Endereço: </b></label>
                    <input type="text" class="form-control" id="endereco" name="endereco" value="{{old('endereco',$campos_extras->endereco)}}">
                </div>
            </div>

            <div class="col-sm form-group col-sm-4">
                <div class="form-group">
                    <label for="cep" class="required"><b>CEP: </b></label>
                    <input type="text" class="form-control cep" id="cep" name="cep" value="{{old('cep',$campos_extras->cep)}}">
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="cidade" class="required"><b>Cidade: </b></label>
                    <input type="text" class="form-control" id="cidade" name="cidade" value="{{old('cidade',$campos_extras->cidade)}}">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="uf" class="required"><b>UF: </b></label>
                    <input type="text" class="form-control" id="uf" name="uf" value="{{old('uf',$campos_extras->uf)}}">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="pais" class="required"><b>País: </b></label>
                    <input type="text" class="form-control" id="pais" name="pais" value="{{old('pais',$campos_extras->pais)}}">
                </div>
            </div>

        </div>
        
    </div>
</div>

<hr>

<div class="card">
    <div class="card-header"><b>Contato</b></div>
    <div class="card-body">

        <div class="row">

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="telefone" class="required"><b>Telefone: </b></label>
                    <input type="text" class="form-control telefone_com_ddd" id="telefone" name="telefone" value="{{old('telefone',$campos_extras->telefone)}}">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="celular" class="required"><b>Celular: </b></label>
                    <input type="text" class="form-control celular_com_ddd" id="celular" name="celular" value="{{old('celular',$campos_extras->celular)}}">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="emails" class="required"><b>E-mails: </b></label>
                    <input type="text" class="form-control" id="emails" name="emails" value="{{old('emails',$campos_extras->emails)}}">
                </div>
            </div>

        </div>

    </div>
</div>

<hr>

<div class="card">
    <div class="card-header"><b> Informações financeiras </b></div>
    <div class="card-body">

        <div class="row">

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="banco" class="required"><b>Banco: </b></label>
                    <input type="text" class="form-control" id="banco" name="banco" value="{{old('banco',$campos_extras->banco)}}">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="agencia" class="required"><b>Agência: </b></label>
                    <input type="text" class="form-control agencia" id="agencia" name="agencia" value="{{old('agencia',$campos_extras->agencia)}}">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="conta_corrente" class="required"><b>Conta Corrente: </b></label>
                    <input type="text" class="form-control" id="conta_corrente" name="conta_corrente" value="{{old('conta_corrente',$campos_extras->conta_corrente)}}">
                </div>
            </div>

        </div>

    </div>
</div>

<hr>

<div class="card">
    <div class="card-header"><b> Outras informações </b></div>
    <div class="card-body">

        <div class="row">

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="sigla_universidade" class="required"><b>Nome e sigla da Universidade na qual tem vínculo profissional: </b></label>
                    <input type="text" class="form-control" id="sigla_universidade" name="sigla_universidade" value="{{old('sigla_universidade',$campos_extras->sigla_universidade)}}">
                </div>
            </div>
        </div>

    </div>
</div>

<hr>

<div class="form-group">
    <button type="submit" class="btn btn-success"> Salvar </button>
</div>

</form>


@stop
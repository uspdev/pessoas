@extends('laravel-usp-theme::master')

@section('title', 'Dashboard')

@section('content_header')

@section('content')
@include('alerts')

<form action="{{ route('camposExtras.store') }}" method="POST">
@csrf

<div class="card">
    <div class="card-header"><b>Vínculos ativos</b></div>
    <div class="card-body">

        <div class="row">

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="codpes" class="required"><b>Número USP: </b></label>
                    <input type="text" class="form-control" id="codpes" name="codpes" value="">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="docente_usp" class="required"><b>Docente USP: </b></label>
                    <input type="text" class="form-control" id="docente_usp" name="docente_usp" value="">
                </div>
            </div>

        </div>

    </div>
</div>

<hr>

<div class="card">
  <div class="card-header"><b>Dados pessoais</b></div>
    <div class="card-body">

        <div class="row">

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="nome" class="required"><b>Nome: </b></label>
                    <input type="text" class="form-control" id="nome" name="nome" value="">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="sexo" class="required"><b>Sexo: </b></label>
                    <input type="text" class="form-control" id="sexo" name="sexo" value="">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="nacionalidade" class="required"><b>Nacionalidade: </b></label>
                    <input type="text" class="form-control" id="nacionalidade" name="nacionalidade" value="">
                </div>
            </div>
        </div>


        <div class="row">

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="data_nascimento" class="required"><b>Data de nascimento: </b></label>
                    <input type="text" class="form-control datepicker" id="data_nascimento" name="data_nascimento" value="">
                </div>
            </div>   

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="mae" class="required"><b>Nome da mãe: </b></label>
                    <input type="text" class="form-control" id="mae" name="mae" value="">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="pai" class="required"><b>Nome do pai: </b></label>
                    <input type="text" class="form-control" id="pai" name="pai" value="">
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
                    <input type="text" class="form-control" id="cpf" name="cpf" value="">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="rg" class="required"><b>RG: </b></label>
                    <input type="text" class="form-control" id="rg" name="rg" value="">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="pis" class="required"><b>PIS: </b></label>
                    <input type="text" class="form-control" id="pis" name="pis" value="">
                </div>
            </div>

        </div>


        <div class="row">

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="passaporte" class="required"><b>Passaporte: </b></label>
                    <input type="text" class="form-control" id="passaporte" name="passaporte" value="">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="validade_visto" class="required"><b>Data de validade do visto: </b></label>
                    <input type="text" class="form-control datepicker" id="validade_visto" name="validade_visto" value="">
                </div>
            </div>   

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="rne" class="required"><b>RNE: </b></label>
                    <input type="text" class="form-control" id="rne" name="rne" value="">
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
                    <input type="text" class="form-control" id="endereco" name="endereco" value="">
                </div>
            </div>

            <div class="col-sm form-group col-sm-4">
                <div class="form-group">
                    <label for="cep" class="required"><b>CEP: </b></label>
                    <input type="text" class="form-control" id="cep" name="cep" value="">
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="cidade" class="required"><b>Cidade: </b></label>
                    <input type="text" class="form-control" id="cidade" name="cidade" value="">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="uf" class="required"><b>UF: </b></label>
                    <input type="text" class="form-control" id="uf" name="uf" value="">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="pais" class="required"><b>País: </b></label>
                    <input type="text" class="form-control" id="pais" name="pais" value="">
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
                    <input type="text" class="form-control" id="telefone" name="telefone" value="">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="celular" class="required"><b>Celular: </b></label>
                    <input type="text" class="form-control" id="celular" name="celular" value="">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="email" class="required"><b>E-mails: </b></label>
                    <input type="text" class="form-control" id="email" name="email" value="">
                </div>
            </div>

        </div>

    </div>
</div>

<hr>

<div class="card">
    <div class="card-header"><b>Informações financeiras</b></div>
    <div class="card-body">

        <div class="row">

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="banco" class="required"><b>Banco: </b></label>
                    <input type="text" class="form-control" id="banco" name="banco" value="">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="agencia" class="required"><b>Agência: </b></label>
                    <input type="text" class="form-control" id="agencia" name="agencia" value="">
                </div>
            </div>

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="conta_corrente" class="required"><b>Conta Corrente: </b></label>
                    <input type="text" class="form-control" id="conta_corrente" name="conta_corrente" value="">
                </div>
            </div>

        </div>

    </div>
</div>

<hr>

<div class="card">
    <div class="card-header"><b>Outras informações (???)</b></div>
    <div class="card-body">

        <div class="row">

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="sigla_universidade" class="required"><b>Nome e sigla da Universidade na qual tem vínculo profissional: </b></label>
                    <input type="text" class="form-control" id="sigla_universidade" name="sigla_universidade" value="">
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="lotado" class="required"><b>Lotado: </b></label>
                    <input type="text" class="form-control" id="lotado" name="lotado" value="">
                </div>
            </div>

        </div>

        <div class="row">
            
            <div class="col-sm form-group">
                <div class="form-group">
                    <label for="empenho" class="required"><b>Empenho: </b></label>
                    <input type="text" class="form-control" id="empenho" name="empenho" value="">
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
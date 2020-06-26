@extends('laravel-usp-theme::master')

@section('title', 'Dashboard')

@section('content_header')
<h1></h1>
@stop

@section('content')
@include('alerts')

<div class="card">
    <div class="card-header"><b>Dados sistemas USP</b></div>
    <div class="card-body">

        <h4>Informações de <i>{{ $pessoa['nompes'] }}</i></h4>
        <br />
        <div class="font-weight-bold">Vínculos Ativos</div>
        <ul class="list-group">
            @foreach ($vinculos as $vinculo)
            <li class='list-group-item'>{{ $vinculo }}</li>
            @endforeach
        </ul>
        <br />
        <div class="font-weight-bold"> Número USP </div>
        <ul class="list-group">
            <li class='list-group-item py-1'>{{ $pessoa['codpes'] }}</li>
        </ul>
        <br />
        <div class="font-weight-bold"> Documentos</div>
        <ul class="list-group">
            <li class='list-group-item py-1'>CPF: {{ $pessoa['numcpf'] }}</li>
        </ul>
        <br />
        <div class="font-weight-bold"> Telefones </div>
        <ul class="list-group">
            @foreach ($telefones as $telefone)
            <li class='list-group-item'>{{ $telefone }}</li>
            @endforeach
        </ul>
        <br />
        <div class="font-weight-bold"> E-mails</div>
        <ul class="list-group">
            @foreach ($emails as $email)
            <li class='list-group-item'>{{ $email }}</li>
            @endforeach
        </ul>
        <br />
        <div class="font-weight-bold"> Endereço</div>
        <ul class="list-group">
            <li class='list-group-item'>
                @foreach ($endereco as $campos)
                    {{ $campos }}
                @endforeach
            </li>
        </ul>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header"><b>Campos Extras</b></div>
    <div class="card-body">
        <a href="/camposExtras/{{ $pessoa['codpes'] }}" class="btn btn-info"> Editar </a> <br>
        Nome: {{$campos_extras->nome}}
    </div>
</div>
@stop
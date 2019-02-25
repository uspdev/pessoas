@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
@include('alerts')

        <h3>Informações de <i>{{ $pessoa['nompes'] }}</i></h3>
        <h4> Número USP </h4>
          <ul class="list-group">
              <li class='list-group-item'>{{ $pessoa['codpes'] }}</li>
          </ul>
        <h4> Documentos </h4>
          <ul class="list-group">
              <li class='list-group-item'>CPF: {{ $pessoa['numcpf'] }}</li>
          </ul>
        <h4> Telefones </h4>
          <ul class="list-group">
          @foreach ($telefones as $telefone)
              <li class='list-group-item'>{{ $telefone }}</li>
          @endforeach
          </ul>
        <h4> E-mails </h4>
          <ul class="list-group">
          @foreach ($emails as $email)
              <li class='list-group-item'>{{ $email }}</li>
          @endforeach
          </ul>
        <h4> Vínculos Ativos </h4>
          <ul class="list-group">
          @foreach ($vinculos as $vinculo)
              <li class='list-group-item'>{{ $vinculo }}</li>
          @endforeach
        </ul>

@stop



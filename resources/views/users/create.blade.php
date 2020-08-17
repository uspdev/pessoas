@extends('laravel-usp-theme::master')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
@include('messages.flash')
@include('messages.errors')

<form method="POST" role="form" class="form-inline" action="/users">
    {{ csrf_field() }}

    <div class="card">
        <div class="card-header">Novos usuários</div>
        <div class="card-body">
            <div class="form-group">
                <div class="input-group-btn">
                    <label for="codpes" class="">Número USP que você gostaria de dar acesso a esse sistema: </label>
                    <input type="text" class="form-control" id="codpes" name="codpes" value="">
                    <button type="submit" class="btn btn-primary "> Adicionar </button>
                </div>
            </div>
        </div>
    </div>

</form>

@stop
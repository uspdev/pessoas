@extends('laravel-usp-theme::master')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
    @include('messages.flash')
    @include('messages.errors')

<form method="POST" role="form" class="form-inline" action="/users">
{{ csrf_field() }}

        <div class="form-group">
            <label>Número USP que você gostaria de dar acesso a esse sistema: </label>

             <input name="numero_usp" class="form-control" value="">
        </div>
            <button type="submit" class="btn btn-primary"> Enviar </button>
</form>

@stop
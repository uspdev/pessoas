@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
    @include('alerts')
    @auth
        <h4>Olá <b>{{ Auth::user()->name }}</b></h4>
    @else
        <div><b>Faça o <a href="login">Login</a> com a senha única.</b></div>
    @endauth
@stop



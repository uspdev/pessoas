@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sisdata</h1>
@stop

@section('content')
    @include('alerts')
    @auth
        <h3><b>{{ Auth::user()->name }}</b></h3>
    @else
        <div><b>Faça o <a href="/login">Login</a> com a senha única.</b></div>
    @endauth
@stop



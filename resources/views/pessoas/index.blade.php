@extends('laravel-usp-theme::master')

@section('content')

@include('alerts')

@auth
<div>Olá <b>{{ Auth()->user()->name }}!</b></div>
@else
<div><b>Faça o <a href="login">Login</a> com a senha única para acessar esse sistema.</b></div>
@endauth

<br />
Esse projeto, consiste em uma interface web para tornar o acesso aos dados mínimos de alunos, funcionários e docentes
mais fácil, para os setores/pessoas que tem essa permissão.

<br /><br />

@can('admin')
@include('pessoas.partials.search')
<br>
@includewhen(isset($pessoas),'pessoas.partials.table')
@endcan('admin')

@endsection

@extends('laravel-usp-theme::master')

@section('content_header')
<h1></h1>
@stop

@section('content')
@include('alerts')

@include('pessoas.partials.show.replicado')
<br>
@include('pessoas.partials.show.campos_extras')
@stop






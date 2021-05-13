@extends('laravel-usp-theme::master')

@section('content')
@include('alerts')
@include('pessoas.partials.search')
@include('pessoas.partials.show.replicado')
<br>
@include('pessoas.partials.show.campos_extras')
@stop






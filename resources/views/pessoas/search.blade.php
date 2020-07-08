@extends('laravel-usp-theme::master')

@section('title', 'Dashboard')

@section('content_header')
<h1></h1>
@stop

@section('content')
@include('alerts')

@include('pessoas.partials.search')

@endsection





@extends('laravel-usp-theme::master')

@section('content_header')

@section('javascripts_head')
  <script src="{{asset('/js/camposExtras.js')}}"></script>
@endsection('javascript_head')

@section('content')

@include('alerts')

<form action="{{ action('PessoaController@update', $codpes) }}" method="POST">
@csrf
@method('patch')
@include('pessoas.partials.form')
<hr>

</form>


@stop

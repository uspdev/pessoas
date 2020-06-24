@extends('laravel-usp-theme::master')

@section('title', 'Dashboard')

@section('content_header')
<h1></h1>
@stop

@section('content')
@include('alerts')


@foreach ($campoExtra as $campo)
    {{ $campo->nome }} - {{ $campo->codpes}} <br>
@endforeach


<form action="{{ route('camposExtras.destroy', $campo->id)}}" method="post">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger" type="submit">Delete</button>
  </form>


@stop
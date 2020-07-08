@extends('laravel-usp-theme::master')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
@include('alerts')

<form method="POST" action="codpes">
@csrf

<div class="form-group">
  <label for="usr">Número USP</label>

  <div class="row">
    <div class="col-lg-2">
        <input type="number" class="form-control" name="codpes" required>
    </div>
  </div>
</div>
<button type="submit" class="btn btn-success">Buscar</button>
</form>
@stop



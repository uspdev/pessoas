@extends('layouts.app')

@section('content')
  <h2 class="text-danger">403</h2>

  Não foi possível acessar esse recurso.<br>
  @if (Auth::user())
  <a href="">Voltar</a>
  @else
    Faça <a href="login">login</a> para acessar esse recurso.
  @endif
@endsection

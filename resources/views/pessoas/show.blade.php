@extends('layouts.app')

@section('content')
  @include('pessoas.partials.search')
  @include('pessoas.partials.show.replicado')
  <br>
  @include('pessoas.partials.show.campos_extras')
@stop

@extends('layouts.app')

@section('content')
  @include('pessoas.partials.search')
  @include('pessoas.partials.show.replicado')
  <br>
  @includeWhen(Gate::check('pessoas.complementar'),'pessoas.partials.show.campos_extras')
@stop

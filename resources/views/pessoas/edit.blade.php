@extends('layouts.app')

@section('content')
  <form action="{{ route('pessoas.update', $pessoa->codpes) }}" method="POST">
    @csrf
    @method('patch')
    <div class="card mb-3">
      <div class="card-header h4 card-header-sticky">
        <b>Campos extras <i class="fas fa-angle-right"></i>
          {{ $pessoa->codpes }} - {{ $pessoa->name ?? $pessoa->replicado('nome') }}</b>
          <a href="{{ route('pessoas.show', $codpes) }}" class="btn btn-sm btn-secondary">Cancelar</a>
          <button type="submit" class="btn btn-sm btn-success">Salvar</button>
      </div>
      <div class="card-body">
        @include('pessoas.partials.form')
      </div>
    </div>
  </form>
@endsection



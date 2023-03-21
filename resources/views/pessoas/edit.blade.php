@extends('layouts.app')

@section('content')
  <div class="card mb-3">
    <div class="card-header h4 card-header-sticky">
      <b>Campos extras <i class="fas fa-angle-right"></i>
        {{ $pessoa->codpes }} - {{ $pessoa->name ?? $pessoa->replicado()['nome'] }}</b>
    </div>
    <div class="card-body">

      <form action="{{ route('pessoas.update', $pessoa->codpes) }}" method="POST">
        @csrf
        @method('patch')
        @include('pessoas.partials.form')
        <div class="form-group mt-3">
          <button type="cancel" class="btn btn-secondary">Cancelar</button>
          <button type="submit" class="btn btn-success">Salvar</button>
        </div>
      </form>
      
    </div>
  </div>
@endsection

@section('javascripts_bottom')
  @parent
  <script>
    jQuery(function($) {
      $(".cpf").mask('000.000.000-00');
      $(".telefone_com_ddd").mask('(00)0000-0000');
      $(".celular_com_ddd").mask('(00)00000-0000');
      $(".cep").mask('00000-000');
      $('.agencia').mask('0000-9');
      $(".data").mask("00/00/0000");
    });
  </script>
@endsection

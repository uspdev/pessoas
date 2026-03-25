@extends('layouts.app')

@section('content')
  <h2>Lista de Servidores Afastados</h2>
  <table
    class="table table-striped table-sm datable-afastados datatable-simples dt-buttons dt-buttons-pdf dt-fixed-header dt-state-save">
    <thead>
      <th>N° USP</th>
      <th>Nome</th>
      <th>Setor</th>
      <th>Motivo do Afastamento</th>
      <th>Data de Início</th>
      <th>Data de Término</th>
      <th>E-mail</th>
      <th>Telefones</th>
    </thead>
    <tbody>
      @foreach ($afastados as $afastado)
        <tr>
          <td>{{ $afastado['codpes'] }}</td>
          <td><a href="{{ route('pessoas.show', $afastado['codpes']) }}">{{ $afastado['nompes'] }}</a></td>
          <td>{{ $afastado['nomabvset'] }}</td>
          <td>{{ $afastado['sitoco'] }}</td>
          <td>{{ date('d/m/Y', strtotime($afastado['dtainisitoco'])) }}</td>
          <td>{{ date('d/m/Y', strtotime($afastado['dtafimsitoco'])) }}</td>
          <td>{{ $afastado['codema'] }}</td>
          <td>{{ implode(' / ', $afastado['telefones']) }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection

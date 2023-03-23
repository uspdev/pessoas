@extends('layouts.app')

@section('content')
  <h4>
    <a href="graduacao/cursos">Cursos</a> <i class="fas fa-angle-right"></i>
    Curso: {{ $curso['nomcur'] }} | Habilitação: {{ $curso['nomhab'] }}
  </h4>
  <div>
    Período: {{ $curso['perhab'] }}
  </div>
  <div>
    Coordenador: <a href="pessoas/{{ $curso['codpescoord'] }}">{{ $curso['nompescoord'] }}</a>
  </div>
  <hr />

  <table class="table datatable-simples table-sm table-hover">
    <thead>
      <tr>
        <th>Código</th>
        <th>Nome</th>
        <th>Versão</th>
        <th>Tipo</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($disciplinas as $d)
        <tr>
          <td>{{ $d['coddis'] }}</td>
          <td>{{ $d['nomdis'] }}</td>
          <td>{{ $d['verdis'] }}</td>
          <td>{{ App\Replicado\Graduacao::$tipobg[$d['tipobg']] }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection

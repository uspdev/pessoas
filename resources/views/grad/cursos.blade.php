@extends('layouts.app')

@section('content')
  <h4>
    Cursos
  </h4>


  <table class="table datatable-simples table-sm table-hover">
    <thead>
      <tr>
        <th>Curso</th>
        <th>Habilitação</th>
        <th>Coordenador</th>
        <th>Período</th>
        <th>Tipo Habilitação</th>
        <th>Total vagas curso</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($cursos as $curso)
        {{-- @dd($curso) --}}
        <tr>
          <td>
            <a href="graduacao/cursos/{{ $curso['codcur'] }}/disciplinas?codhab={{ $curso['codhab'] }}">
              ({{ $curso['codcur'] }})
              {{ $curso['nomcur'] }}
            </a>
          </td>
          <td>({{ $curso['codhab'] }}) {{ $curso['nomhab'] }}</td>
          <td>
            <a href="pessoas/{{ $curso['codpescoord'] }}">{{ $curso['nompescoord'] }}</a>
            ({{ $u->data_mes($curso['dtainicdn']) }} a {{ $u->data_mes($curso['dtafimcdn']) }})
          </td>
          <td>{{ $curso['perhab'] }}</td>
          <td>{{ App\Replicado\Graduacao::$tiphab[$curso['tiphab']] }}</td>
          <td class="text-center">{{ $curso['totvag'] }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection

@extends('layouts.app')

@section('content')
  <h4>
    Cursos
  </h4>

  <table class="table table-sm table-hover datatable-simples">
    <thead>
      <tr>
        <th></th>
        <th>Curso</th>
        <th>Habilitação</th>
        {{-- <th>Coordenador</th> --}}
        <th>Período</th>
        <th>Tipo Habilitação</th>
        <th>Total vagas curso</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($cursos as $curso)
        <tr>
          <td>
            <a class="btn btn-sm btn-outline-primary"
              href="{{ route('graduacao.gradeCurricular', [$curso['codcur'], $curso['codhab']]) }}">Grade</a>
            <a class="btn btn-sm btn-outline-primary spinner"
              href="{{ route('graduacao.turmas', [$curso['codcur'], $curso['codhab']]) }}">Turmas</a>
          </td>
          <td>
            ({{ $curso['codcur'] }})
            {{ $curso['nomcur'] }}
          </td>
          <td>({{ $curso['codhab'] }}) {{ $curso['nomhab'] }}</td>
          {{-- <td>
            <a href="pessoas/{{ $curso['codpescoord'] }}">{{ $curso['nompescoord'] }}</a>
            ({{ $u->data_mes($curso['dtainicdn']) }} a {{ $u->data_mes($curso['dtafimcdn']) }})
          </td> --}}
          <td>{{ $curso['perhab'] }}</td>
          <td>{{ App\Replicado\Graduacao::$tiphab[$curso['tiphab']] }}</td>
          <td class="text-center">{{ $curso['totvag'] }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection

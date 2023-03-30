@extends('layouts.app')

@section('content')
  @include('grad.partials.curso-menu', ['view' => 'Turmas'])
  <div class="mt-3 ml-3 d-inline-flex">

    <form method="POST" action="{{ route('graduacao.relatorio.porNomes.post') }}">
      @csrf
      <input type="hidden" name="nomes" value="{!! $nomes !!}">
      <button class="btn btn-outline-info btn-spinner" type="submit">Relatório por nomes</button>
    </form>

    <div class="border border-primary rounded ml-3" style="padding-top: 7px;">

      <form method="get" class="form-inline" id="form-semestre">
        <div class="mx-2"><b>Semestre</b>: de</div>
        <select class="border-0 input-small font-weight-bold" name="semestreIni" id="select-semestre-ini">
          @foreach ($turmaSelect as $t)
            <option {{ $t == $semestreIni ? 'selected' : '' }}>{{ $t }}</option>
          @endforeach
        </select>

        <div class="mx-2">a</div>
        <select class="border-0 input-small font-weight-bold" name="semestreFim" id="select-semestre-fim">
          @foreach ($turmaSelect as $t)
            <option {{ $t == $semestreFim ? 'selected' : '' }}>{{ $t }}</option>
          @endforeach
        </select>
        <div class="mx-2"></div>

        <input type="hidden" name="codhab" value="{{ $curso['codhab'] }}">
        <button class="btn btn-sm btn-primary d-none btn-spinner py-0 mr-2" type="submit">OK</button>
      </form>
    </div>

  </div>
  
  <div class="mt-3 ml-3">
    Obs.: Exclui as turmas "não ativas"
  </div>
  <hr />

  <table class="table datatable-simples table-sm table-hover">
    <thead>
      <tr>
        <th>Cód Turma</th>
        <th>Cód dis</th>
        <th>Nome</th>
        <th>Professor</th>
        <th>Ativ. Didática</th>
        <th>Versão</th>
        <th>Carga Hor.</th>
        <th>Tipo</th>
        <th>Status</th>
        <th>Obs</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($turmas as $t)
        <tr>
          <td>{{ $t['codtur'] }}</td>
          <td>{{ $t['coddis'] }}</td>
          <td>{{ $t['nomdis'] }}</td>
          <td>
            @foreach ($t['ministrantes'] as $m)
              <a href="{{ route('pessoas.show', $m['codpes']) }}">{!! $m['stamis'] == 'N' ? '' : '<span class="badge badge-info" title="Quinzenal">15d</span>' !!}
                {{ $m['nompes'] }}</a><br />
            @endforeach
          </td>
          <td>
            @foreach ($t['ativDidaticas'] as $a)
              <a href="{{ route('pessoas.show', $a['codpes']) }}">({{ $a['nomatv'] }}) {{ $a['nompes'] }}</a><br />
            @endforeach
          </td>
          <td>{{ $t['verdis'] }}</td>
          <td>{{ $t['cgahorteo'] }}/{{ $t['cgahorpra'] }}</td>
          <td>{{ $t['tiptur'] }}</td>
          <td>{{ $graduacao::$statur[$t['statur']] }}</td>
          <td>{{ $t['obstur'] }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection

@section('javascripts_bottom')
  @parent
  <script>
    $('#form-semestre select').change(function() {
      $('#form-semestre').find(':submit').removeClass('d-none')
      console.log('mudou')
    })
  </script>
@endsection

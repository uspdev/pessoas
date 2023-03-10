@extends('layouts.app')

@section('content')

  <form method="POST" action="graduacao">
    @csrf
    <div class="form-group">
      <label for="exampleFormControlTextarea1" class="h4">Nomes (1 por linha)</label>
      <button type="submit" class="btn btn-sm btn-primary">Enviar</button>
      <textarea name="nomes" class="form-control" id="exampleFormControlTextarea1" rows="4">{{ $nomes }}</textarea>
    </div>
  </form>

  @if ($naoEncontrados)
    <hr>
    <div class="h4">Não encontrados</div>
    @foreach ($naoEncontrados as $nome)
      {{ $nome }}<br>
    @endforeach
  @endif

  @if ($pessoas)
    <hr>
    <div class="h4 mt-3">Resultados</div>
    <table class="table table-bordered table-hover table-sm datatable-pessoas">
      <thead>
        <tr>
          <th>Unidade</th>
          <th>Depto</th>
          <th>No. USP</th>
          <th>Nome</th>
          <th>Nome Função</th>
          <th>Tipo Jornada</th>
          <th>Lattes</th>
          <th>Orcid</th>
          <th>Data atual. Lattes</th>
          <th>Graduação</th>
          <th>Mestrado</th>
          <th>Doutorado</th>
          <th>Livre docencia</th>
          <th>Pós-doutorado</th>
          <th>Especialista</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pessoas as $pessoa)
          <tr>
            <td>{{ $pessoa['unidade'] }}</td>
            <td>{{ $pessoa['departamento'] }}</td>
            <td>{{ $pessoa['codpes'] }}</td>
            <td>{{ $pessoa['nome'] }}</td>
            <td>{{ $pessoa['nomeFuncao'] }}</td>
            <td>{{ $pessoa['tipoJornada'] }}</td>
            <td>
              <a href="https://lattes.cnpq.br/{{ $pessoa['lattes'] }}" target="lattes">
                {{ $pessoa['lattes'] }}
              </a>
            </td>
            <td>
              <a href="{{ $pessoa['orcid_id'] }}" target="orcid">
                {{ str_replace('https://orcid.org/', '', $pessoa['orcid_id']) }}
              </a>
            </td>
            <td>{{ $pessoa['dtaultalt'] ?? '-' }}</td>
            <td>{{ $pessoa['graduacao'] ?? '-' }}</td>
            <td>{{ $pessoa['mestrado'] ?? '-' }}</td>
            <td>{{ $pessoa['doutorado'] ?? '-' }}</td>
            <td>{{ $pessoa['livre-docencia'] ?? '-' }}</td>
            <td>{{ $pessoa['pos-doutorado'] ?? '-' }}</td>
            <td>{{ $pessoa['especializacao'] ?? '-' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif

@endsection

@section('styles')
  @parent
  <style>
    .dataTables_filter {
      float: left !important;
      padding-right: 10px;
    }
  </style>
@endsection

@section('javascripts_bottom')
  @parent
  <script>
    jQuery(function() {
      var table = $('.datatable-pessoas').DataTable({
        dom: 'fBi',
        order: [],
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
        },
        paging: false,
        lengthChange: false,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: true,
        lengthMenu: [
          [10, 25, 50, 100, -1],
          ['10 linhas', '25 linhas', '50 linhas', '100 linhas', 'Mostar todos']
        ],
        pageLength: -1,
        buttons: [
          'excelHtml5', 'csvHtml5'
        ]
      })

      table.order([
        [0, 'asc'],
        [1, 'asc'],
        [3, 'asc']
      ]).draw()
    })
  </script>
@endsection

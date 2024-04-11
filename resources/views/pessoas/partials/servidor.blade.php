<div id="colunas" class="mb-3">
  Esconder / Mostrar colunas:
  <a class="toggle-vis" data-column="2" role="button">Gênero</a> |
  <a class="toggle-vis" data-column="3" role="button">Idade</a> |
  <a class="toggle-vis" data-column="4" role="button">Sigla setor</a> |
  <a class="toggle-vis" data-column="5" role="button">Setor</a> |
  <a class="toggle-vis" data-column="6" role="button">Idade USP</a> |
  <a class="toggle-vis" data-column="7" role="button">Tipo função</a> |
  <a class="toggle-vis" data-column="8" role="button">Função</a> |
  <a class="toggle-vis" data-column="9" role="button">Idade função</a> |
  <a class="toggle-vis" data-column="10" role="button">Tel. USP</a> |
  <a class="toggle-vis" data-column="11" role="button">Tel.</a> |
  <a class="toggle-vis" data-column="12" role="button">E-mail principal</a> |
  <a class="toggle-vis" data-column="13" role="button">E-mail(s) alternativo(s)</a> |
  <a class="toggle-vis" data-column="14" role="button">Lattes</a> |
  <a class="toggle-vis" data-column="15" role="button">Titulações</a> |
  <a class="toggle-vis" data-column="16" role="button">Classe</a> |
  <a class="toggle-vis" data-column="17" role="button">Nível</a> |
  <a class="toggle-vis" data-column="18" role="button">Jornada</a> |
  <a class="toggle-vis" data-column="19" role="button">Mérito</a> |
  <a class="toggle-vis" data-column="20" role="button">Designação</a>
</div>

<table id="servidor"
  class="table table-bordered table-striped table-hover datatable-simples dt-buttons dt-fixed-header responsive">
  <thead>
    <tr>
      <th>Nº USP</th>
      <th>Nome</th>
      <th>Gênero</th>
      <th>Idade</th>
      <th>Sigla setor</th>
      <th>Setor</th>
      <th>Idade USP</th>
      <th>Tipo função</th>
      <th>Função</th>
      <th>Idade função</th>
      <th>Tel. USP</th>
      <th>Tel.</th>
      <th>E-mail principal</th>
      <th>E-mail(s) alternativo(s)</th>
      <th>Lattes</th>
      <th>Titulações<br /> Ano | Titulação | Escolaridade</th>
      <th>Classe</th>
      <th>Nível</th>
      <th>Jornada</th>
      <th>Mérito</th>
      <th>Designação</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($pessoas as $index => $pessoa)
      <tr>
        <td>{{ $pessoa['codpes'] }}</td>
        <td><a href="pessoas/{{ $pessoa['codpes'] }}">{{ $pessoa['nompesttd'] }}</a></td>
        <td>{{ $pessoa['sexpes'] }}</td>
        <td>{{ \Carbon\Carbon::parse($pessoa['dtanas'])->diff(\Carbon\Carbon::now())->format('%y') }}</td>
        <td>{{ $pessoa['nomabvset'] }}</td>
        <td>{{ $pessoa['nomset'] }}</td>
        <td>{{ \Carbon\Carbon::parse($pessoa['dtainivin'])->diff(\Carbon\Carbon::now())->format('%y') }}</td>
        <td>{{ $pessoa['tipfnc'] }}</td>
        <td>{{ $pessoa['nomfnc'] }}</td>
        <td>{{ \Carbon\Carbon::parse($pessoa['dtainisitfun'])->diff(\Carbon\Carbon::now())->format('%y') }}</td>
        <td>{{ $pessoa['numtelfmt'] }}</td>
        <td>
          @foreach (\Uspdev\Replicado\Pessoa::telefones($pessoa['codpes']) as $tel)
            @if ($tel != \Uspdev\Replicado\Pessoa::telefones($pessoa['codpes']))
              {{ str_replace(' ', '', $tel) }}<br />
            @endif
          @endforeach
        </td>
        <td>{{ \Uspdev\Replicado\Pessoa::email($pessoa['codpes']) }}</td>
        <td>
          @foreach (\Uspdev\Replicado\Pessoa::emails($pessoa['codpes']) as $email)
            @if ($email != \Uspdev\Replicado\Pessoa::email($pessoa['codpes']))
              {{ $email }}
            @endif
          @endforeach
        </td>      
        <td>
          @if ($pessoa['idfpescpq'] != '')
            <a href="http://lattes.cnpq.br/{{ $pessoa['idfpescpq'] }}" target="_blank">Lattes</a>
          @endif
        </td>
        <td>
          <ul>
          @foreach (\Uspdev\Replicado\Pessoa::listarTitulacoes($pessoa['codpes']) as $titulacao)
            <li>{{ substr($titulacao['dtatitpes'], 0, 4) ?? ' ' }} | {{ $titulacao['titpes'] ?? ' ' }} | {{ $titulacao['nomesc'] ?? ' ' }}</li>         
          @endforeach
          </ul>
        </td>          
        <td>{{ $pessoa['nomabvcla'] }}</td>
        <td>{{ $pessoa['nivgrupvm'] }}</td>
        <td>{{ $pessoa['tipjor'] }}</td>
        <td>{{ $pessoa['tipmer'] }}</td>
        <td>
          @foreach (\Uspdev\Replicado\Pessoa::vinculos($pessoa['codpes']) as $vinculo)
            @if (substr($vinculo, 0, 21) == 'Servidor Designado - ')
              {{ substr($vinculo, 21, strlen($vinculo)) }}
            @endif
          @endforeach
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@section('javascripts_bottom')
  @parent
  <script>
    $(document).ready(function() {

      // Esconder e mostrar colunas
      $('a.toggle-vis').on('click', function(e) {
        e.preventDefault()
        // Get the column API object
        var column = $('.datatable-simples').DataTable().column($(this).attr('data-column'))

        // Toggle the visibility
        column.visible(!column.visible())
      })
    })
  </script>
@endsection

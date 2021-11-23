  <style>
    a { cursor: pointer; }
    #colunas { padding-bottom: 15px; }
  </style>

  <div id="colunas">
    Esconder / Mostrar colunas:
    <a class="toggle-vis" data-column="2">Gênero</a> |
    <a class="toggle-vis" data-column="3">Idade</a> |
    <a class="toggle-vis" data-column="4">Sigla setor</a> |
    <a class="toggle-vis" data-column="5">Setor</a> |
    <a class="toggle-vis" data-column="6">Idade USP</a> |
    <a class="toggle-vis" data-column="7">Tipo função</a> |
    <a class="toggle-vis" data-column="8">Função</a> |
    <a class="toggle-vis" data-column="9">Idade função</a> |
    <a class="toggle-vis" data-column="10">Tel. USP</a> |
    <a class="toggle-vis" data-column="11">E-mail principal</a> |
    <a class="toggle-vis" data-column="12">E-mail(s) alternativo(s)</a> |
    <a class="toggle-vis" data-column="13">Lattes</a> |
    <a class="toggle-vis" data-column="14">Escolaridade</a> |
    <a class="toggle-vis" data-column="15">Formação</a> |
    <a class="toggle-vis" data-column="16">Classe</a> |
    <a class="toggle-vis" data-column="17">Nível</a> |
    <a class="toggle-vis" data-column="18">Jornada</a> |
    <a class="toggle-vis" data-column="19">Mérito</a> |
    <a class="toggle-vis" data-column="20">Designação</a>
  </div>
  <table id="servidor" class="datatable-pessoas table table-bordered table-striped table-hover responsive">
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
        <th>E-mail principal</th>
        <th>E-mail(s) alternativo(s)</th>
        <th>Lattes</th>
        <th>Escolaridade</th>
        <th>Formação</th>
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
          <td>{{ $pessoa['nomesc'] }}</td>
          <td>{{ $pessoa['dscgrufor'] }}</td>
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

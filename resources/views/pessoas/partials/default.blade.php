  <table class="datatable-pessoas table table-bordered table-striped table-hover responsive">
    <thead>
      <tr>
        <th>Número USP</th>
        <th>Nome</th>
        <th>Vínculos ativos</th>
        <th>E-mail</th>
      </tr>
    </thead>
    <tbody>
        @foreach($pessoas as $index => $pessoa)
        <tr>
          <td>{{$pessoa['codpes']}}</td>
          <td><a href="pessoas/{{$pessoa['codpes']}}">{{ $pessoa['nompesttd'] }}</a></td>
          <td>{{trim(implode(', ', \Uspdev\Replicado\Pessoa::vinculos($pessoa['codpes'])))}}</td>
          <td>{{\Uspdev\Replicado\Pessoa::email($pessoa['codpes'])}}</td>
        </tr>
        @endforeach
    </tbody>
  </table>
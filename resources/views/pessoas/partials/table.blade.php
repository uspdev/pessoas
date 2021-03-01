<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">Nº</th>
      <th scope="col">Número USP</th>
      <th scope="col">Nome</th>
      <th scope="col">Vínculos</th>
      <th scope="col">Setores</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @foreach($pessoas as $index => $pessoa)
      <tr>
        <td scope="row">{{$index + 1}}</td>
        <td scope="row">{{$pessoa['codpes']}}</td>
        <td><a href="pessoas/{{$pessoa['codpes']}}">{{$pessoa['nompes']}}</a></td>
        <td>@if ($pessoa['codundclg']) {{implode(',', \Uspdev\Replicado\Pessoa::vinculosSiglas($pessoa['codpes'], $pessoa['codundclg']))}} @endif</td>
        <td>@if ($pessoa['codundclg']) {{implode(',', \Uspdev\Replicado\Pessoa::setoresSiglas($pessoa['codpes'], $pessoa['codundclg']))}} @endif</td>
      </tr>
      @endforeach

  </tbody>
</table>
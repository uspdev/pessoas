<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">Número USP</th>
      <th scope="col">Nome</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @foreach($pessoas as $pessoa)
      <tr>
        <th scope="row">{{$pessoa['codpes']}}</th>
        <td><a href="pessoas/{{$pessoa['codpes']}}">{{$pessoa['nompes']}}</a></td>
      </tr>
      @endforeach

  </tbody>
</table>
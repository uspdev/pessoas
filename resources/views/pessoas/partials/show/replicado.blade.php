<div class="card">
  <div class="card-header h4"><b>Dados sistemas USP > <i>{{ $pessoa->replicado()['nompes'] }}</i></b></div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        {{-- Coluna da esquerda - informações institucionais --}}
        <div class="font-weight-bold">Vínculos Ativos</div>
        <ul class="list-group">
          @foreach ($pessoa->replicado()['vinculos'] as $vinculo)
            <li class='list-group-item'>{{ $vinculo }}</li>
          @endforeach
        </ul>
        <br />
        <div class="font-weight-bold"> Número USP </div>
        <ul class="list-group">
          <li class='list-group-item py-1'>{{ $pessoa->codpes }}</li>
        </ul>
        <br />
        <div class="font-weight-bold"> E-mails</div>
        <ul class="list-group">
          @foreach ($pessoa->replicado()['emails'] as $email)
            <li class='list-group-item'>{{ $email }}</li>
          @endforeach
        </ul>
        <br />
        <div class="font-weight-bold">Ramal USP</div>
        <ul class="list-group">
            <li class='list-group-item'>{{ $pessoa->replicado()['ramal'] }}</li>
        </ul>
        <br />
      </div>
      <div class="col-md-6">
        {{-- Coluna da direita - informações pessoais --}}
        <div class="float-right ml-2">
          <div class="font-weight-bold">Foto USP</div>
          <img src="data:image/png;base64, {{ $foto }}" alt="foto">
        </div>
        <div class="font-weight-bold"> Gênero</div>
        <ul class="list-group">
          <li class='list-group-item py-1'>
            @if ($pessoa->replicado()['sexpes'] === 'M')
              Masculino
            @elseif ($pessoa->replicado()['sexpes'] === "F")
              Feminino
            @else
              Não informado
            @endif
          </li>
        </ul>
        <br />
        <div class="font-weight-bold"> Documentos</div>
        <ul class="list-group">
          <li class='list-group-item py-1'>CPF: {{ $pessoa->replicado()['numcpf'] }}</li>
        </ul>
        <br />
        <div class="font-weight-bold"> Telefones </div>
        <ul class="list-group">
          @foreach ($pessoa->replicado()['telefones'] as $telefone)
            <li class='list-group-item'>{{ $telefone }}</li>
          @endforeach
        </ul>
        <br />

        <div class="font-weight-bold"> Endereço</div>
        <ul class="list-group">
          <li class='list-group-item'>{{ $pessoa->replicado()['endereco'] }} </li>
        </ul>
      </div>
    </div>

  </div>
</div>

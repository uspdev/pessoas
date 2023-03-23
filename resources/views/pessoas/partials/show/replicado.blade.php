<div class="card">
  <div class="card-header h4 card-header-sticky">
    Dados USP <i class="fas fa-angle-right"></i>
    <b>{{ $pessoa->codpes }} - <i>{{ $pessoa->replicado()['nome'] }}</i></b>
  </div>
  <div class="card-body">
    <div class="row">
      {{-- Coluna da esquerda - informações institucionais --}}
      <div class="col-md-6">

        <div class="mb-3">
          <div class="font-weight-bold">Vínculos Ativos</div>
          <ul class="list-group">
            @forelse ($pessoa->replicado()['vinculosAtivos'] as $vinculo)
              <li class="list-group-item list-group-item-action py-1">
                {!! $pessoa->vinculoFormatado($vinculo) !!}
              </li>
            @empty
              <li class="list-group-item  py-1">
                -
              </li>
            @endforelse
          </ul>
        </div>

        <div class="my-3">
          <div class="font-weight-bold"> E-mails</div>
          <ul class="list-group">
            @foreach ($pessoa->replicado()['emails'] as $email)
              <li class="list-group-item list-group-item-action py-1">
                {{ $email }}
                @if (\Uspdev\Replicado\Pessoa::email($pessoa->codpes) == $email)
                  <span class="badge badge-info" title="E-mail principal USP"><i class="fas fa-envelope"></i> USP</span>
                @endif
              </li>
            @endforeach
          </ul>
        </div>

        <div class="my-3">
          <div class="font-weight-bold">Ramal USP</div>
          <ul class="list-group">
            <li class="list-group-item py-1">{{ $pessoa->replicado()['ramal'] }}</li>
          </ul>
        </div>

        <div class="my-3">
          <div class="font-weight-bold">Lattes
            <span class="badge badge-info">atualizado em
              {{ $pessoa->replicado()['lattesAtualizacao'] }}</span>
          </div>
          <ul class="list-group">
            <li class="list-group-item py-1">{!! $pessoa->replicado()['lattes'] !!}</li>
            <li class="list-group-item py-1">{!! $pessoa->replicado()['orcid'] !!}</li>
          </ul>
        </div>

        <div class="my-3">
          <div class="font-weight-bold">Vínculos encerrados</div>
          <ul class="list-group">
            @forelse($pessoa->replicado()['vinculosEncerrados'] as $vinculo)
              <li class="list-group-item list-group-item-action py-1">
                {!! $pessoa->vinculoFormatado($vinculo) !!}
              </li>
            @empty
              <li class="list-group-item py-1">-</li>
            @endforelse
          </ul>
        </div>

      </div>

      {{-- Coluna da direita - informações pessoais --}}
      <div class="col-md-6">
        <div class="float-right ml-2">
          <div class="font-weight-bold">Foto USP</div>
          <img src="data:image/png;base64, {{ $foto }}" alt="foto">
        </div>

        <div class="mb-3">
          <div class="font-weight-bold">Genero</div>
          <ul class="list-group">
            <li class="list-group-item py-1">{{ $pessoa->replicado()['genero'] }}</li>
          </ul>
        </div>

        <div class="my-3">
          <div class="font-weight-bold">Nascimento</div>
          <ul class="list-group">
            <li class="list-group-item py-1">{{ $pessoa->replicado()['nasc'] }}</li>
          </ul>
        </div>

        <div class="my-3">
          <div class="font-weight-bold">Documentos</div>
          <ul class="list-group">
            @foreach ($pessoa->replicado()['documentos'] as $documento)
              <li class="list-group-item list-group-item-action py-1">{{ $documento }}</li>
            @endforeach
          </ul>
        </div>
        <div class="my-3">
          <div class="font-weight-bold">Telefones</div>
          <ul class="list-group">
            @foreach ($pessoa->replicado()['telefones'] as $telefone)
              <li class="list-group-item list-group-item-action py-1">{{ $telefone }}</li>
            @endforeach
          </ul>
        </div>
        <div class="my-3">
          <div class="font-weight-bold">Endereço</div>
          <ul class="list-group">
            <li class="list-group-item py-1">{{ $pessoa->replicado()['endereco'] }} </li>
          </ul>
        </div>

      </div>
    </div>

  </div>
</div>

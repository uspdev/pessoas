<style>
  * {
    scroll-behavior: smooth;
  }
</style>

<div class="card" id="card_replicado">
  <div class="card-header h4 card-header-sticky">
    {{ $pessoa->codpes }} - <i>{{ $pessoa->replicado('nome') }}</i>
    | <b>Dados USP</b>
    @can('pessoas.complementar')
      | <a href="{{ url()->current() }}#card_campos_extras">Campos Extras <i class="fas fa-caret-down"></i></a>
    @endcan
  </div>
  <div class="card-body">
    <div class="row">
      {{-- Coluna da esquerda - informações institucionais --}}
      <div class="col-md-6">

        <div class="mb-3">
          <div class="font-weight-bold">Vínculos ativos</div>
          <ul class="list-group">
            @forelse ($pessoa->replicado('vinculosAtivos') as $vinculo)
              <li class="list-group-item list-group-item-action py-1">
                {!! $vinculo !!}
              </li>
            @empty
              <li class="list-group-item py-1">-</li>
            @endforelse
          </ul>
        </div>

        <div class="my-3">
          <div class="font-weight-bold"> E-mails</div>
          <ul class="list-group">
            @foreach ($pessoa->replicado('emails') as $email)
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
            <li class="list-group-item py-1">{{ $pessoa->replicado('ramal') }}</li>
          </ul>
        </div>

        <div class="my-3">
          <div class="font-weight-bold">
            Lattes
            <span class="badge badge-info">atualizado em {{ $pessoa->replicado('lattesAtualizacao') }}</span>
          </div>
          <ul class="list-group">
            <li class="list-group-item py-1">{!! $pessoa->replicado('lattes') !!}</li>
            <li class="list-group-item py-1">{!! $pessoa->replicado('orcid') !!}</li>
          </ul>
        </div>

        <div class="my-3">
          <div class="font-weight-bold">Titulações</div>
          <ul class="list-group">
            @foreach (\Uspdev\Replicado\Pessoa::listarTitulacoes($pessoa->codpes) as $titulacao)
              <li class="list-group-item list-group-item-action py-1">
                {{ substr($titulacao['dtatitpes'], 0, 4) ?? ' ' }} - {{ $titulacao['titpes'] ?? ' ' }} -
                {{ $titulacao['nomesc'] ?? ' ' }}
              </li>
            @endforeach
          </ul>
        </div>
      </div>

      {{-- Coluna da direita - informações pessoais --}}
      <div class="col-md-6">
        <div class="float-right">
          <div>
            <div class="font-weight-bold">Foto USP</div>
            <img src="data:image/png;base64, {{ $foto }}" width="160px" alt="foto">
          </div>
          @if ($fotoLattes)
            <div class="mt-3">
              <div class="font-weight-bold">Foto Lattes</div>
              <img src="data:image/png;base64, {{ $fotoLattes }}" width="160px" alt="foto">
            </div>
          @endif
        </div>

        @can('pessoas.avancado')

          <div class="row">
            <div class="col-md">
              <div class="font-weight-bold">Gênero</div>
              <ul class="list-group">
                <li class="list-group-item py-1">{{ $pessoa->replicado('genero') }}</li>
              </ul>
            </div>

            <div class="col-md">
              <div class="font-weight-bold">Nascimento</div>
              <ul class="list-group">
                <li class="list-group-item py-1">{{ $pessoa->replicado('nasc') }}</li>
              </ul>
            </div>
          </div>

          <div class="row">
            <div class="col my-2">
              <div class="font-weight-bold">Documentos</div>
              <ul class="list-group">
                @foreach ($pessoa->replicado('documentos') as $documento)
                  <li class="list-group-item list-group-item-action py-1">{{ $documento }}</li>
                @endforeach
              </ul>
            </div>
          </div>

          <div class="row">
            <div class="col my-2">
              <div class="font-weight-bold">Telefones</div>
              <ul class="list-group">
                @foreach ($pessoa->replicado('telefones') as $telefone)
                  <li class="list-group-item list-group-item-action py-1">{{ $telefone }}</li>
                @endforeach
              </ul>
            </div>
          </div>

          <div class="row">
            <div class="col my-2">
              <div class="font-weight-bold">Endereço</div>
              <ul class="list-group">
                <li class="list-group-item py-1">{{ $pessoa->replicado('endereco') }} </li>
              </ul>
            </div>
          </div>

          <div class="row">
            <div class="col my-2">
              <div class="font-weight-bold">Vínculos encerrados</div>
              <ul class="list-group">
                @forelse($pessoa->replicado('vinculosEncerrados') as $vinculo)
                  <li class="list-group-item list-group-item-action py-1">
                    {!! $pessoa->vinculoFormatado($vinculo) !!}
                  </li>
                @empty
                  <li class="list-group-item py-1">-</li>
                @endforelse
              </ul>
            </div>
          </div>

        @endcan

      </div>
    </div>

  </div>
</div>

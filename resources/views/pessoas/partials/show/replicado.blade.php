<div class="card">
    <div class="card-header h4"><b>Dados sistemas USP > <i>{{ $pessoa->replicado()['nome'] }}</i></b></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{-- Coluna da esquerda - informações institucionais --}}
                <div class="font-weight-bold">Vínculos Ativos</div>
                <ul class="list-group">
                    @foreach ($pessoa->replicado()['vinculos'] as $vinculo)
                    <li class='list-group-item'>
                        {!! $pessoa->vinculoFormatado($vinculo) !!}
                    </li>
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
                        <li class='list-group-item'>
                            {{ $email }}
                            @if (\Uspdev\Replicado\Pessoa::email($pessoa->codpes) == $email)
                                <span class="badge badge-info" title="E-mail principal USP"><i class="fas fa-envelope"></i> USP</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
                <br />
                <div class="font-weight-bold">Ramal USP</div>
                <ul class="list-group">
                    <li class='list-group-item'>{{ $pessoa->replicado()['ramal'] }}</li>
                </ul>
                <br />
            </div>

            {{-- Coluna da direita - informações pessoais --}}
            <div class="col-md-6">
                <div class="float-right ml-2">
                    <div class="font-weight-bold">Foto USP</div>
                    <img src="data:image/png;base64, {{ $foto }}" alt="foto">
                </div>
                <div class="my-3">
                    <div class="font-weight-bold">Genero</div>
                    <ul class="list-group">
                        <li class='list-group-item py-1'>{{ $pessoa->replicado()['genero'] }}</li>
                    </ul>
                </div>
                <div class="my-3">
                    <div class="font-weight-bold">Nascimento</div>
                    <ul class="list-group">
                        <li class='list-group-item py-1'>{{ $pessoa->replicado()['nasc'] }}</li>
                    </ul>
                </div>
                <div class="my-3">
                    <div class="font-weight-bold">Documentos</div>
                    <ul class="list-group">
                        <li class='list-group-item py-1'>{{ $pessoa->replicado()['documentos'] }}</li>
                    </ul>
                </div>
                <div class="my-3">
                    <div class="font-weight-bold">Telefones</div>
                    <ul class="list-group">
                        @foreach ($pessoa->replicado()['telefones'] as $telefone)
                        <li class='list-group-item'>{{ $telefone }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="my-3">
                    <div class="font-weight-bold">Endereço</div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{ $pessoa->replicado()['endereco'] }} </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

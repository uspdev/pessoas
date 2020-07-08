<div class="card">
    <div class="card-header"><b>Dados sistemas USP</b></div>
    <div class="card-body">

        <h4>Informações de <i>{{ $pessoa->replicado()['nompes'] }}</i></h4>
        <br />
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
        <div class="font-weight-bold"> Documentos</div>
        <ul class="list-group">
            <li class='list-group-item py-1'>CPF: {{ $pessoa->replicado()['numcpf']}}</li>
        </ul>
        <br />
        <div class="font-weight-bold"> Telefones </div>
        <ul class="list-group">
            @foreach ($pessoa->replicado()['telefones'] as $telefone)
            <li class='list-group-item'>{{ $telefone }}</li>
            @endforeach
        </ul>
        <br />
        <div class="font-weight-bold"> E-mails</div>
        <ul class="list-group">
            @foreach ($pessoa->replicado()['emails'] as $email)
            <li class='list-group-item'>{{ $email }}</li>
            @endforeach
        </ul>
        <br />
        <div class="font-weight-bold"> Endereço</div>
        <ul class="list-group">
            <li class='list-group-item'>{{$pessoa->replicado()['endereco']}} </li>
        </ul>
    </div>
</div>
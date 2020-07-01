
<div class="card">
    <div class="card-header"><b>Campos Extras</b></div>
    <div class="card-body">
    
        <a href="/camposExtras/{{ $pessoa['codpes'] }}" class="btn btn-info"> Editar </a> <br>

        <div class="font-weight-bold"> Número USP </div>
            <ul class="list-group">
                <li class='list-group-item py-1'>{{ $campos_extras->codpes }}</li>
            </ul>
        <br />
        <div class="font-weight-bold"> Nome: </div>
            <ul class="list-group">
                <li class='list-group-item'>{{ $campos_extras->nome }}</li>
            </ul>
        <br />

        <div class="card">
            <div class="card-header"><b>Dados pessoais</b></div>
            <div class="card-body">

                <div class="font-weight-bold"> Sexo: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$campos_extras->sexo}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> Nacionalidade: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$campos_extras->nacionalidade}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> Data de nascimento: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$campos_extras->data_nascimento}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> Nome da mãe: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$campos_extras->mae}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> Nome do pai: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$campos_extras->pai}}</li>
                    </ul>
                    
            </div>
        </div>
    
            <br />

        <div class="card">
            <div class="card-header"><b> Documentos </b></div>
            <div class="card-body">
                <div class="font-weight-bold"> CPF: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$campos_extras->cpf}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> RG: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$campos_extras->rg}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> PIS: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$campos_extras->pis}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> Passaporte: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$campos_extras->passaporte}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> Data de validade do visto: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$campos_extras->validade_visto}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> RNE: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$campos_extras->rne}}</li>
                    </ul>
            </div>
        </div>

        <br />
        <div class="font-weight-bold"> Endereço: </div>
            <ul class="list-group">
                <li class='list-group-item'>{{$campos_extras->endereco}}</li>
            </ul>
        <br />
        <div class="font-weight-bold"> CEP: </div>
            <ul class="list-group">
                <li class='list-group-item'>{{$campos_extras->cep}}</li>
            </ul>
        <br />
        <div class="font-weight-bold"> Cidade: </div>
            <ul class="list-group">
                <li class='list-group-item'>{{$campos_extras->endereco}}</li>
            </ul>
        <br />
        <div class="font-weight-bold"> UF: </div>
            <ul class="list-group">
                <li class='list-group-item'>{{$campos_extras->uf}}</li>
            </ul>
        <br />
        <div class="font-weight-bold"> País: </div>
            <ul class="list-group">
                <li class='list-group-item'>{{$campos_extras->pais}}</li>
            </ul>
        <br />

        <div class="card">
            <div class="card-header"><b>Contato</b></div>
            <div class="card-body">

                <div class="font-weight-bold"> Telefone: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$campos_extras->telefone}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> Celular: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$campos_extras->celular}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> E-mails: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$campos_extras->emails}}</li>
                    </ul>
                <br />
            </div>
        </div>

        <br>

        <div class="card">
            <div class="card-header"><b>Informações financeiras</b></div>
            <div class="card-body">

                <div class="font-weight-bold"> Banco: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$campos_extras->banco}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> Agência: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$campos_extras->agencia}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> Conta Corrente: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$campos_extras->conta_corrente}}</li>
                    </ul>

            </div>
        </div>
        
        <br>

        <div class="card">
            <div class="card-header"><b>Outras informações</b></div>
            <div class="card-body">

                <div class="font-weight-bold"> Nome e sigla da Universidade na qual tem vínculo profissional: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$campos_extras->sigla_universidade}}</li>
                    </ul>


            </div>
        </div>
        <br>
        

    </div>
</div>
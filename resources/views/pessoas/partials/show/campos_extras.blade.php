
<div class="card">
    <div class="card-header"><b>Campos Extras</b></div>
    
    <div class="card-body">
    Os campos abaixo não são dos sistemas USP. Eles são destinados para uso local na unidade, 
    em diversas situações nas quais essas informações não podem ser inseridas para pessoa em questão
    na base da USP ou quando essa informação está errada e precisa ser usada localmente até que
    seja então corrigida.
        <br> <a href="/pessoas/{{ $pessoa->codpes }}/edit" class="btn btn-info"> Editar campos locais </a> <br>
      
        <br />

        <div class="card">
            <div class="card-header"><b>Dados pessoais</b></div>
            <div class="card-body">

                <div class="font-weight-bold"> Nome: </div>
                <ul class="list-group">
                    <li class='list-group-item'>{{ $pessoa->nome }}</li>
                </ul>
                <br />
                <div class="font-weight-bold"> Sexo: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->sexo}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> Nacionalidade: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->nacionalidade}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> Data de nascimento: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->data_nascimento}}</li>

                    </ul>
                <br />
                <div class="font-weight-bold"> Nome da mãe: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->mae}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> Nome do pai: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->pai}}</li>
                    </ul>
                    
            </div>
        </div>
    
            <br />

        <div class="card">
            <div class="card-header"><b> Documentos </b></div>
            <div class="card-body">
                <div class="font-weight-bold"> CPF: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->cpf}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> RG: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->rg}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> PIS: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->pis}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> Passaporte: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->passaporte}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> Data de validade do visto: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->validade_visto}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> RNE: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->rne}}</li>
                    </ul>
            </div>
        </div>

        <br />

        <div class="card">
            <div class="card-header"><b> Endereço </b></div>
            <div class="card-body">

                <div class="font-weight-bold"> Endereço: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->endereco}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> CEP: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->cep}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> Cidade: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->cidade}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> UF: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->uf}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> País: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->pais}}</li>
                    </ul>
                </div>
            </div>

        <br />

        <div class="card">
            <div class="card-header"><b>Contato</b></div>
            <div class="card-body">

                <div class="font-weight-bold"> Telefone: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->telefone}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> Celular: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->celular}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> E-mails: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->emails}}</li>
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
                        <li class='list-group-item'>{{$pessoa->banco}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> Agência: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->agencia}}</li>
                    </ul>
                <br />
                <div class="font-weight-bold"> Conta Corrente: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->conta_corrente}}</li>
                    </ul>

            </div>
        </div>
        
        <br>

        <div class="card">
            <div class="card-header"><b>Outras informações</b></div>
            <div class="card-body">

                <div class="font-weight-bold"> Nome e sigla da Universidade na qual tem vínculo profissional: </div>
                    <ul class="list-group">
                        <li class='list-group-item'>{{$pessoa->sigla_universidade}}</li>
                    </ul>


            </div>
        </div>
        <br>
        

    </div>
</div>
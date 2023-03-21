<div class="card">
  <div class="card-header h4 card-header-sticky">
    <b>Campos Extras</b>
    <a href="{{ route('pessoas.edit', $pessoa->codpes) }}" class="btn btn-sm btn-info">
      <i class="fas fa-edit"></i> Editar
    </a>
  </div>
  <div class="card-body">
    <div>
      Os campos abaixo não são dos sistemas USP. Eles são destinados para uso local na unidade,
      em diversas situações nas quais essas informações não podem ser inseridas para pessoa em questão
      na base da USP ou quando essa informação está errada e precisa ser usada localmente até que
      seja então corrigida.
    </div>

    <div class="card mt-3">
      <div class="card-header h5 py-2"><b>Dados pessoais</b></div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <div class="font-weight-bold"> Nome: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->nome }}</li>
            </ul>
          </div>
          <div class="col-md-4">
            <div class="font-weight-bold"> Sexo: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->sexo }}</li>
            </ul>
          </div>
          <div class="col-md-4">
            <div class="font-weight-bold"> Nacionalidade: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->nacionalidade }}</li>
            </ul>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-4">
            <div class="font-weight-bold"> Data de nascimento: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->data_nascimento }}</li>
            </ul>
          </div>
          <div class="col-md-4">
            <div class="font-weight-bold"> Nome da mãe: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->mae }}</li>
            </ul>
          </div>
          <div class="col-md-4">
            <div class="font-weight-bold"> Nome do pai: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->pai }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="card mt-3">
      <div class="card-header h5 py-2"><b> Documentos </b></div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <div class="font-weight-bold"> CPF: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->cpf }}</li>
            </ul>
          </div>
          <div class="col-md-4">
            <div class="font-weight-bold"> RG: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->rg }}</li>
            </ul>
          </div>
          <div class="col-md-4">
            <div class="font-weight-bold"> PIS: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->pis }}</li>
            </ul>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <div class="font-weight-bold"> Passaporte: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->passaporte }}</li>
            </ul>
          </div>
          <div class="col-md-4">
            <div class="font-weight-bold"> Data de validade do visto: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->validade_visto }}</li>
            </ul>
          </div>
          <div class="col-md-4">
            <div class="font-weight-bold"> RNE: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->rne }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="card mt-3">
      <div class="card-header h5 py-2"><b> Endereço </b></div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-8">
            <div class="font-weight-bold"> Endereço: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->endereco }}</li>
            </ul>
          </div>
          <div class="col-md-4">
            <div class="font-weight-bold"> CEP: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->cep }}</li>
            </ul>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-4">
            <div class="font-weight-bold"> Cidade: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->cidade }}</li>
            </ul>
          </div>
          <div class="col-md-4">
            <div class="font-weight-bold"> UF: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->uf }}</li>
            </ul>
          </div>
          <div class="col-md-4">
            <div class="font-weight-bold"> País: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->pais }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="card mt-3">
      <div class="card-header h5 py-2"><b>Contato</b></div>
      <div class="card-body">
        <div class="row mt-3">
          <div class="col-md-4">
            <div class="font-weight-bold"> Telefone: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->telefone }}</li>
            </ul>
          </div>
          <div class="col-md-4">
            <div class="font-weight-bold"> Celular: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->celular }}</li>
            </ul>
          </div>
          <div class="col-md-4">
            <div class="font-weight-bold"> E-mails: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->emails }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="card mt-3">
      <div class="card-header h5 py-2"><b>Informações financeiras</b></div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <div class="font-weight-bold"> Banco: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->banco }}</li>
            </ul>
          </div>
          <div class="col-md-4">
            <div class="font-weight-bold"> Agência: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->agencia }}</li>
            </ul>
          </div>
          <div class="col-md-4">
            <div class="font-weight-bold"> Conta Corrente: </div>
            <ul class="list-group">
              <li class="list-group-item py-1">{{ $pessoa->conta_corrente }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="card mt-3">
      <div class="card-header h5 py-2"><b>Outras informações</b></div>
      <div class="card-body">
        <div class="font-weight-bold"> Nome e sigla da Universidade na qual tem vínculo profissional: </div>
        <ul class="list-group">
          <li class="list-group-item py-1">{{ $pessoa->sigla_universidade }}</li>
        </ul>
      </div>
    </div>

  </div>
</div>

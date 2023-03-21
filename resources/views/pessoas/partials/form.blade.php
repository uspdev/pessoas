<div class="card">
  <div class="card-header h5 py-2"><b>Dados pessoais</b></div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm form-group">
        <div class="form-group">
          <label for="nome" class="required"><b>Nome: </b></label>
          <input type="text" class="form-control" id="nome" name="nome"
            value="{{ old('nome', $pessoa->nome) }}">
        </div>
      </div>

      <div class="col-sm form-group">
        <div class="form-group">
          <label for="sexo" class="required"><b>Sexo: </b></label>
          <input type="text" class="form-control" id="sexo" name="sexo"
            value="{{ old('sexo', $pessoa->sexo) }}">
        </div>
      </div>

      <div class="col-sm form-group">
        <div class="form-group">
          <label for="nacionalidade" class="required"><b>Nacionalidade: </b></label>
          <input type="text" class="form-control" id="nacionalidade" name="nacionalidade"
            value="{{ old('nacionalidade', $pessoa->nacionalidade) }}">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm form-group">
        <div class="form-group">
          <label for="data_nascimento" class="required"><b>Data de nascimento: </b></label>
          <input type="text" class="form-control datepicker data" id="data_nascimento" name="data_nascimento"
            value="{{ old('data_nascimento', $pessoa->data_nascimento) }}">
        </div>
      </div>

      <div class="col-sm form-group">
        <div class="form-group">
          <label for="mae" class="required"><b>Nome da mãe: </b></label>
          <input type="text" class="form-control" id="mae" name="mae"
            value="{{ old('mae', $pessoa->mae) }}">
        </div>
      </div>

      <div class="col-sm form-group">
        <div class="form-group">
          <label for="pai" class="required"><b>Nome do pai: </b></label>
          <input type="text" class="form-control" id="pai" name="pai"
            value="{{ old('pai', $pessoa->pai) }}">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card mt-3">
  <div class="card-header h5 py-2"><b>Documentos</b></div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm form-group">
        <div class="form-group">
          <label for="cpf" class="required"><b>CPF: </b></label>
          <input type="text" class="form-control cpf" id="cpf" name="cpf"
            value="{{ old('cpf', $pessoa->cpf) }}">
        </div>
      </div>

      <div class="col-sm form-group">
        <div class="form-group">
          <label for="rg" class="required"><b>RG: </b></label>
          <input type="text" class="form-control rg" id="rg" name="rg"
            value="{{ old('rg', $pessoa->rg) }}">
        </div>
      </div>

      <div class="col-sm form-group">
        <div class="form-group">
          <label for="pis" class="required"><b>PIS: </b></label>
          <input type="text" class="form-control" id="pis" name="pis"
            value="{{ old('pis', $pessoa->pis) }}">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm form-group">
        <div class="form-group">
          <label for="passaporte" class="required"><b>Passaporte: </b></label>
          <input type="text" class="form-control" id="passaporte" name="passaporte"
            value="{{ old('passaporte', $pessoa->passaporte) }}">
        </div>
      </div>

      <div class="col-sm form-group">
        <div class="form-group">
          <label for="validade_visto" class="required"><b>Data de validade do visto: </b></label>
          <input type="text" class="form-control datepicker data" id="validade_visto" name="validade_visto"
            value="{{ old('validade_visto', $pessoa->validade_visto) }}">
        </div>
      </div>

      <div class="col-sm form-group">
        <div class="form-group">
          <label for="rne" class="required"><b>RNE: </b></label>
          <input type="text" class="form-control" id="rne" name="rne"
            value="{{ old('rne', $pessoa->rne) }}">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card mt-3">
  <div class="card-header h5 py-2"><b>Endereços</b></div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm form-group col-sm-8">
        <div class="form-group">
          <label for="endereco" class="required"><b>Endereço: </b></label>
          <input type="text" class="form-control" id="endereco" name="endereco"
            value="{{ old('endereco', $pessoa->endereco) }}">
        </div>
      </div>

      <div class="col-sm form-group col-sm-4">
        <div class="form-group">
          <label for="cep" class="required"><b>CEP: </b></label>
          <input type="text" class="form-control cep" id="cep" name="cep"
            value="{{ old('cep', $pessoa->cep) }}">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm form-group">
        <div class="form-group">
          <label for="cidade" class="required"><b>Cidade: </b></label>
          <input type="text" class="form-control" id="cidade" name="cidade"
            value="{{ old('cidade', $pessoa->cidade) }}">
        </div>
      </div>

      <div class="col-sm form-group">
        <div class="form-group">
          <label for="uf" class="required"><b>UF: </b></label>
          <input type="text" class="form-control" id="uf" name="uf"
            value="{{ old('uf', $pessoa->uf) }}">
        </div>
      </div>

      <div class="col-sm form-group">
        <div class="form-group">
          <label for="pais" class="required"><b>País: </b></label>
          <input type="text" class="form-control" id="pais" name="pais"
            value="{{ old('pais', $pessoa->pais) }}">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card mt-3">
  <div class="card-header h5 py-2"><b>Contato</b></div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm form-group">
        <div class="form-group">
          <label for="telefone" class="required"><b>Telefone: </b></label>
          <input type="text" class="form-control telefone_com_ddd" id="telefone" name="telefone"
            value="{{ old('telefone', $pessoa->telefone) }}">
        </div>
      </div>

      <div class="col-sm form-group">
        <div class="form-group">
          <label for="celular" class="required"><b>Celular: </b></label>
          <input type="text" class="form-control celular_com_ddd" id="celular" name="celular"
            value="{{ old('celular', $pessoa->celular) }}">
        </div>
      </div>

      <div class="col-sm form-group">
        <div class="form-group">
          <label for="emails" class="required"><b>E-mails: </b></label>
          <input type="text" class="form-control" id="emails" name="emails"
            value="{{ old('emails', $pessoa->emails) }}">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card mt-3">
  <div class="card-header h5 py-2"><b> Informações financeiras</b></div>
  <div class="card-body">
    <div class="row">

      <div class="col-sm form-group">
        <div class="form-group">
          <label for="banco" class="required"><b>Banco: </b></label>
          <input type="text" class="form-control" id="banco" name="banco"
            value="{{ old('banco', $pessoa->banco) }}">
        </div>
      </div>

      <div class="col-sm form-group">
        <div class="form-group">
          <label for="agencia" class="required"><b>Agência: </b></label>
          <input type="text" class="form-control agencia" id="agencia" name="agencia"
            value="{{ old('agencia', $pessoa->agencia) }}">
        </div>
      </div>

      <div class="col-sm form-group">
        <div class="form-group">
          <label for="conta_corrente" class="required"><b>Conta Corrente: </b></label>
          <input type="text" class="form-control" id="conta_corrente" name="conta_corrente"
            value="{{ old('conta_corrente', $pessoa->conta_corrente) }}">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card mt-3">
  <div class="card-header h5 py-2"><b>Outras informações</b></div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm form-group mb-0">
        <div class="form-group">
          <label for="sigla_universidade" class="required"><b>Nome e sigla da Universidade na qual tem vínculo
              profissional:</b></label>
          <input type="text" class="form-control" id="sigla_universidade" name="sigla_universidade"
            value="{{ old('sigla_universidade', $pessoa->sigla_universidade) }}">
        </div>
      </div>
    </div>
  </div>
</div>

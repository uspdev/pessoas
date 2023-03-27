@section('styles')
  @parent
  <link rel="stylesheet" href="{{ asset('/css/search.css') }}">
@endsection

@section('javascripts_bottom')
  @parent
  <script src="{{ asset('/js/select2.js') }}"></script>
@endsection

<div class="row">
  <form action="{{ config('app.url') }}">
    <div class="form-row">
      <div class="col input-group mb-3">
        <input type="text" class="form-control" aria-label="Nº USP" aria-describedby="inputGroup-sizing-sm"
          id="codpes" name="codpes" value="{{ old('codpes') }}" placeholder="Nº USP">
      </div>
      <div class="col input-group mb-3">
        <input type="text" class="form-control" aria-label="Nome" aria-describedby="inputGroup-sizing-sm"
          id="codpes" name="nompes" value="{{ old('nompes', request()->nompes) }}" autocomplete="off"
          placeholder="ou Nome">
      </div>
      
      @can('pessoas.avancado')
        <div class="col input-group mb-3">
          <select class="form-control" name="tipvinext">
            <option selected="selected" value="">ou Vínculo</option>
            {{-- Verificar se o código de unidade pode ser opicional no método Pessoa::tiposVinculos --}}
            @foreach (Uspdev\Replicado\Pessoa::tiposVinculos(env('REPLICADO_CODUNDCLG')) as $vinculo)
              @php
                $vinculoSelecionado = $vinculo['tipvinext'] == \Request::query('tipvinext') ? 'selected' : '';
              @endphp
              <option {{ $vinculoSelecionado }} value="{{ $vinculo['tipvinext'] }}">{{ $vinculo['tipvinext'] }}
                {{-- Mostra a quantidade de pessoas --}}
                ({{ number_format(\Uspdev\Replicado\Pessoa::ativosVinculo($vinculo['tipvinext'], env('REPLICADO_CODUNDCLG'), 1)[0]['total'], 0, '', '.') }})
              </option>
            @endforeach
          </select>
        </div>
        <div class="col input-group mb-3">
          <select class="select2-setor" name="codset[]" multiple="multiple">
            @foreach (Uspdev\Replicado\Estrutura::listarSetores() as $setor)
              @php
                $setorSelecionado = (!empty(\Request::query('codset')) and in_array($setor['codset'], \Request::query('codset'))) ? 'selected' : '';
              @endphp
              <option {{ $setorSelecionado }} value="{{ $setor['codset'] }}">{{ $setor['nomabvset'] }} -
                {{ $setor['nomset'] }}</option>
            @endforeach
          </select>
        </div>
        <div class="col input-group mb-3">
          <div class="form-check">
            @php
              $docente_aposentado = \Request::query('docente_aposentado') != '' ? 'checked' : '';
            @endphp
            <input class="form-check-input" type="checkbox" {{ $docente_aposentado }} value="0"
              id="docente_aposentado" name="docente_aposentado">
            <label class="form-check-label" for="docente_aposentado">
              Excluir Docentes Aposentados<br />(<em>somente com Setor</em>)
            </label>
          </div>
        </div>
      @endcan

    </div>
    <div class="form-row">
      <div class="col input-group mb-3">
        <span class="input-group-btn">
          <button type="submit" class="btn btn-success"> Buscar </button>
          <button onclick="location.href = '{{ config('app.url') }}';" type="button" class="btn btn-secondary"> Limpar
          </button>
        </span>
      </div>
    </div>
  </form>
</div>

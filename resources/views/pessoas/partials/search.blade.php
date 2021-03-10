@section('javascripts_bottom')
    @parent
    <script src="{{asset('/js/select2.js')}}"></script>
@endsection

<div class="row">
    <form>
        <div class="col-sm input-group">
            <input type="text" placeholder="Número USP" class="form-control" name="codpes" value="{{ old('codpes', request()->codpes) }}">
            <input type="text" placeholder="ou Nome" class="form-control" name="nompes" id="nompes" value="{{ old('nompes', request()->nompes) }}" autocomplete="off">

            <select class="form-control" name="tipvinext">
                <option selected="selected" value="">ou Vínculo</option>
                {{-- Verificar se o código de unidade pode ser opicional no método Pessoa::tiposVinculos --}}
                @foreach (Uspdev\Replicado\Pessoa::tiposVinculos(env('REPLICADO_CODUNDCLG')) as $vinculo)
                    <option value="{{$vinculo['tipvinext']}}">{{$vinculo['tipvinext']}} 
                        {{-- Mostra a quantidade de pessoas --}}
                        ({{number_format(\Uspdev\Replicado\Pessoa::ativosVinculo($vinculo['tipvinext'], env('REPLICADO_CODUNDCLG'), 1)[0]['total'], 0, '', '.')}})</option>
                @endforeach
            </select> 

            <select class="select2-setor" name="codset[]" multiple="multiple">
                @foreach (Uspdev\Replicado\Estrutura::listarSetores() as $setor)
                    <option value="{{$setor['codset']}}">{{$setor['nomabvset']}} - {{$setor['nomset']}}</option>
                @endforeach
            </select> 

            <span class="input-group-btn">
                <button type="submit" class="btn btn-success"> Buscar </button>
                <button onclick="location.href = '{{config('app.url')}}';" type="button" class="btn btn-secondary"> Limpar </button>
            </span>
        </div>
    </form>
</div>


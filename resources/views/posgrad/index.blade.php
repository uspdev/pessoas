@extends('layouts.app')

@section('content')
<div class="form-inline">
    <span class="mr-3">Listar alunos por programa</span>
    <form method="post" action="posgrad">
        @csrf
        <div class="form-group">
            <select class="form-control" name="codcur" id="codcur">
                <option value="0">-- Escolha um programa --</option>
                @foreach($programas as $programa)
                <option value="{{ $programa['codcur'] }}" {{ ($programa['codcur'] == session('codcur')) ? 'selected' : '' }}>{{ $programa['nomcur'] }}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>
<br>
@includewhen($alunos, 'posgrad.partials.lista-alunos')
@endsection

@section('javascripts_bottom')
@parent
<script>
    $(function() {
        $('#codcur').change(function() {
            this.form.submit();
        });
    });

</script>
@endsection

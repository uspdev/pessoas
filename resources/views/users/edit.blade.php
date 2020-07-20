@extends('laravel-usp-theme::master')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
    @include('messages.flash')
    @include('messages.errors')

<form method="POST" role="form" class="form-inline" action="/users">
{{ csrf_field() }}
        
    <div class="card">
        <div class="card-header"><b>Edição do usuário - {{ $users->name }}</b></div>
        <div class="card-body">
            <div class="form-group">

                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="role" name="role">Tipo de permissão: </label>
                            <label class="checkbox-inline col-sm-3">
                                <input type="checkbox" class="form-check-input" id="restrito" name="role" value="">Restrito
                            </label>
                        
 
                            <label class="checkbox-inline col-sm-3">
                                <input type="checkbox" class="form-check-input" id="completo" name="role" value="">Completo
                            </label>

                            
                            <div class="col-sm-2 form-group">
                                <button type="submit" class="btn btn-success">Salvar</button>
                            </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
</form>

@stop

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
        <div class="card-header"><b>Edição de usuário - {{ $users->name }}</b></div>
        <div class="card-body">
            <div class="form-group">

                <label for="numero_usp">Tipo de permissão: </label>
                <div class="row">
                    <div class="form-group col-sm-6">
 
                            <label class="checkbox-inline"">
                                <input type="checkbox" class="form-check-input" value="">Nível 1
                            </label>
                        
 
                            <label class="checkbox-inline"">
                                <input type="checkbox" class="form-check-input" value="">Nível 2
                            </label>
                        
 
                            <label class="checkbox-inline"">
                                <input type="checkbox" class="form-check-input" value="">Nível 3
                            </label>
                        
                    </div>
                    <div class="row">
                    
                        <div class="col-sm-6 form-group">
                          <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                      </div>
                </div>

            </div>
        </div>
    </div>
    
</form>

@stop

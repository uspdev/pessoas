@extends('laravel-usp-theme::master')

@section('content_header')
@stop

@section('content')

<form method="post" class="form-inline" action="{{ url('/users') }}/{{$users->id}}"> 
{{ csrf_field() }}
{{ method_field('PUT') }}

    <div class="card">
        <div class="card-header"><b>Edição do usuário(a) - {{ $users->name }}</b></div>
        <div class="card-body">
            <div class="form-group">

                <div class="row">
                    <div class="form-group col-sm-12">

                        <label for="role" name="role">Tipo de permissão: </label><br>

                        <label class="radio-inline col-sm-3">
                            <input type="radio" class="form-radio-input" id="role" name="role" value="admin" @if($users->role == "admin")checked @endif> Completo
                        </label>

                        <label class="radio-inline col-sm-3">
                            <input type="radio" class="form-radio-input" id="role" name="role" value="authorized" @if($users->role == "authorized")checked @endif> Restrito
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

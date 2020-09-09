@extends('laravel-usp-theme::master')

@section('content_header')
@stop

@section('content')

<div>
    <a href="{{ route('users.create') }}" class="btn btn-success">
        Autorizar nova pessoa
    </a>
</div>
<br>

<h3>Pessoas autorizadas nesse sistema:</h3>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Número USP</th>
                <th>Nome</th>
                <th>Permissões</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users->sortBy('name') as $user)
            <tr>
                <td>{{ $user->codpes }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                        <a class="btn btn-primary" href="{{ url("users/$user->id/edit") }}">Editar</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Tem certeza que deseja deletar o usuário {{ $user->name }}?');">Deletar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@stop
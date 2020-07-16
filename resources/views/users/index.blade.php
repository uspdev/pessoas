@extends('laravel-usp-theme::master')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
    @include('messages.flash')
    @include('messages.errors')

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
            </tr>
        </thead>
        <tbody>
            @foreach($users->sortBy('name') as $user)
            <tr>
                <td>{{ $user->codpes }}</td>
                <td>{{ $user->name }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@stop
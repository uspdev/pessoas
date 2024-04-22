@extends('layouts.app')

@section('content')
    <h2>Lista de Servidores Designados</h2>
    <table class="table table-striped table-sm datatable ">
        <thead>
            <tr>
                <th>N° USP</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($designados as $designado)
                <tr>
                    <td>{{ $designado['codpes'] }}</td>
                    <td><a href="{{route('pessoas.show', $designado['codpes'])}}">{{ $designado['nompesttd'] }}</a></td>
                    <td>{{ $designado['codema'] }}</td>
                    <td>{{ $designado['numtelfmt'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
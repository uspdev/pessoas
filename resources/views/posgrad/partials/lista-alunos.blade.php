<style>
    .dataTables_filter {
        float: left !important;
    }

</style>

<table class="table table-sm table-stripped datatable-simples dt-buttons dt-buttons-pdf dt-fixed-header dt-state-save">
    <thead>
        <tr>
            <th>nro USP</th>
            <th>Nome</th>
            <th>Nível</th>
            <th>Email</th>
            <th>Telefones</th>
            <th>Iníco do vínculo</th>
            <th>Área</th>
        </tr>
    </thead>
    <tbody>
        @foreach($alunos as $aluno)
        <tr>
            <td>{{ $aluno->codpes }}</td>
            <td><a href="pessoas/{{ $aluno->codpes }}">{{ $aluno->nompes }}</a></td>
            <td>{{ $aluno->nivpgm }}</td>
            <td>{{ $aluno->codema }}</td>
            <td>{{implode(' / ', $aluno->telefones)}}</td>
            {{-- https://stackoverflow.com/questions/12003222/datatable-date-sorting-dd-mm-yyyy-issue --}}
            <td data-sort="{{ \Carbon\Carbon::parse($aluno->dtainivin )->format('Ymd') }}">{{ \Carbon\Carbon::parse($aluno->dtainivin )->format('d/m/Y') }}</td>
            <td>{{ $aluno->codare }}</td>
        </tr>
        @endforeach
    </tbody>
</table>


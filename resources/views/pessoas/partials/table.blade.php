<hr>

@if (Request::get('tipvinext') == 'Servidor' or Request::get('tipvinext') == 'Docente' or Request::get('tipvinext') == 'Docente Aposentado')
  @include('pessoas.partials.servidor')
@else
  @include('pessoas.partials.default')
@endif

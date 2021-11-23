@section('styles')
    @parent
    <link rel="stylesheet" href="{{asset('/css/datatable.css')}}">
@endsection

@section('javascripts_bottom')
    @parent
    <script src="{{asset('/js/datatable.js')}}"></script>
@endsection

<hr>

@if (Request::get('tipvinext') == 'Servidor' or Request::get('tipvinext') == 'Docente' or Request::get('tipvinext') == 'Docente Aposentado')
  @include('pessoas.partials.servidor')
@else
  @include('pessoas.partials.default')
@endif

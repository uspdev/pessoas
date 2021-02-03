@section('javascripts_bottom')
    <script src="{{asset('/js/search.js')}}"></script>
@endsection

<div class="row">
<form>
    <div class=" col-sm input-group">
    <input type="text" placeholder="Número USP" class="form-control" name="codpes" value="{{ old('codpes', request()->codpes) }}">
    <input type="text" placeholder="ou Nome" class="form-control" name="nompes" id="nompes" value="{{ old('nompes', request()->nompes) }}" autocomplete="off">

    <span class="input-group-btn">
        <button type="submit" class="btn btn-success"> Buscar </button>
    </span>

    </div>
</form>
</div>


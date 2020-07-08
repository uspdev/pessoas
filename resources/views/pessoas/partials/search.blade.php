

@section('javascripts_bottom')
    <script src="{{asset('/js/search.js')}}"></script>
@endsection

<div class="row">

    <div class="col-lg-5">
        <form id="busca" method="POST" action="/pessoas">
            @csrf

            <b>Busque por:</b><br>

            <div class="form-group">
                <label for="usr">Número USP</label>

                <div class="row">
                    <div class="col-sm">
                        <input type="number" class="form-control" name="by_codpes" value={{ old('by_codpes') }} required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Buscar</button><br>

            <br><b> Ou busque por</b><br>

            <div class="form-group">
                <label for="usr">Nome:</label>
                <input type="text" class="form-control" name="nompes" id="nompes" autocomplete="off">
                <ul name="search" id="search"></ul>
            </div>
            <input type="hidden" value="" name="codpes" id="codpes">

        </form>
    </div>
</div>


//$(document).ready(function() {
jQuery(function ($) {

    $(window).keydown(function(event) {
        if ((event.keyCode == 13)) {
            event.preventDefault();
            return false;
        }
    });

    $('#nompes').keyup(function() {
        var term = $.trim($(this).val());
        var ul_search = $('#search');
        ul_search.empty().removeClass("dropdown-menu").css("display:none;");
        setTimeout(function() {
            if (term.length >= 6 && $.trim($('#nompes').val()) == term) {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "search/partenome",
                    data: {
                        term: term,
                        _token: _token
                    },
                    datatype: "json",
                    beforeSend: function() {
                        ul_search.empty().append("<li><a href='#'>Buscando... Aguarde!</a></li>")
                            .addClass("dropdown-menu").attr("style","display:block; position:relative");
                    },
                    success: function(data) {
                        ul_search.empty();
                        if (data.length > 0) {
                            $.each(data, function(key, value) {
                                console.log(value);
                                ul_search.append('<li value=' + value
                                    .codpes + '><a href="#">(' + value
                                    .codpes + ') ' + value.nompes +
                                    '</a></li>');
                            });
                        } else {
                            ul_search.append("<li><a href='#'>Nenhum registro encontrado!</a></li>");
                        }

                    },
                    complete: function() {
                        ul_search.addClass("dropdown-menu").attr("style","display:block; position:relative").fadeIn();
                    }
                });
            }
        }, 1000);
    });

    $(document).on('click', '#search > li', function() {
        if ($(this).val() > 0) {
            $('#nompes').val($(this).text());
            $('#codpes').val($(this).val());
            $('#search').fadeOut();
            $('#busca').submit();
        }
    });

});

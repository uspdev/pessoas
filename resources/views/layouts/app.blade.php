@extends('laravel-usp-theme::master')

{{-- Componentes do laravel-usp-theme --}}

{{-- Target:card-header; class:card-header-sticky --}}
{{-- @include('laravel-usp-theme::blocos.sticky') --}}

{{-- Target: button, a; class: btn-spinner, spinner --}}
{{-- @include('laravel-usp-theme::blocos.spinner') --}}

{{-- Target: table; class: datatable-simples --}}
{{-- @include('laravel-usp-theme::blocos.datatable-simples') --}}

{{-- Fim de componentes do laravel-usp-theme --}}


@section('title')
  @parent
@endsection

@section('styles')
  @parent
  <style>
    /* Fixando card header no top quando scrool */
    .card-header-sticky {
      position: -webkit-sticky;
      position: sticky !important;
      top: 0;
      z-index: 100;
      background-color: #F0F0F0;
    }
  </style>
@endsection


{{-- 
Spinner para ser adicionado em botão de submit de form ou link

Uso:
- Incluir no layouts.app ou em outro lugar: @include('laravel-usp-theme::components.spinner')
- Adiconar a classe 'btn-spinner' ou 'spinner'

@author Masakik, em 31/3/2023
--}}
@section('javascripts_bottom')
  @parent
  <script>
    jQuery(function() {

      spinnerRun = function(btn) {
        if (!btn.data('text-spinner')) { // salvando o conteúdo do botão
          btn.data('text-spinner', btn.html())
        }
        btn.addClass('disabled') // desativando depois de clicar
        btn.html( // add spinner to button
          `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ` +
          'Carregando'.substring(0, btn.data('text-spinner').length - 3) + '..' //limita o tamanho do texto
        );
        btn.closest('form').submit() // se for botão de submit de form vamos disparar
      }

      spinnerRestore = function(btn = null) {
        if (btn == null) { // se nao for passado botao, vamos aplicar a todos os spinners com dados salvos
          $('.btn-spinner, .spinner').each(function() {
            let btn = $(this)
            if (btn.data('text-spinner')) { // se houver conteúdo salvo, vamos restaurar e reativar
              btn.html(btn.data('text-spinner'))
              btn.removeClass('disabled')
            }
          })
        } else { // se foi passado um botao, vamos aplicar somente nele
          if (btn.data('text-spinner')) {
            btn.html(btn.data('text-spinner'))
            btn.removeClass('disabled')
          }
        }
      }

      // ao clicar no botão/link: salva conteúdo, adiciona spinner, desativa, submete form
      $('.btn-spinner, .spinner').on('click', function() {
        spinnerRun($(this))
      })

      // restaurando ao mostrar a página, inclusive quando clicak em back no navegador
      $(window).bind('pageshow', function(event) {
        spinnerRestore();
      });

    })
  </script>
@endsection

{{--
Datatables, botoes excel e csv, sem paginação, topo em 1 linha, alinhado esquerda

Uso:
- Incluir no layouts.app ou em outro lugar: @include('laravel-usp-theme::components.datatables-simples')
- Adiconar a classe 'datatables-simples'

@author Masakik, em 23/3/2023
--}}
@section('javascripts_bottom')
  @parent
  <script>
    jQuery(function() {
      var datatableSimples = $('.datatable-simples, datatables-simples').DataTable({
        dom: '<"row"<"col-md-12 form-inline"<"mr-2"f>B<"ml-3"i>>>t',
        order: [],
        paging: false,
        lengthChange: false,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: true,
        lengthMenu: [
          [10, 25, 50, 100, -1],
          ['10 linhas', '25 linhas', '50 linhas', '100 linhas', 'Mostar todos']
        ],
        pageLength: -1,
        language: {
          search: '',
          searchPlaceholder: 'Filtrar ..'
        },
        buttons: {
          buttons: [{
              extend: 'excelHtml5',
              className: 'btn btn-sm btn-outline-primary'
            },
            {
              extend: 'csvHtml5',
              className: 'btn btn-sm btn-outline-primary'
            }
          ],
          dom: {
            button: {
              className: 'btn'
            }
          }
        }
      })
    })
  </script>
@endsection

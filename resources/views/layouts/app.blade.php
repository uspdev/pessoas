@extends('laravel-usp-theme::master')

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

@section('javascripts_bottom')
  @parent
  <script>
    jQuery(function() {
      // spinner para ser adicionado em botão de submit de form
      $('.btn-spinner').on('click', function() {
        $(this).prop("disabled", true);
        // add spinner to button
        $(this).html(
          `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Carregando...`
        );
        $(this).closest('form').submit()
      })

    })
  </script>
@endsection

{{-- datatables  --}}
@section('javascripts_bottom')
  @parent
  <script>
    jQuery(function() {
      /**
       * Datatables, botoes excel e csv, sem paginação,
       * topo em 1 linha, alinhado esquerda
       * @author Masaki K Neto, em 23/3/2023
       */
      var dtSimples = $('.datatable-simples').DataTable({
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

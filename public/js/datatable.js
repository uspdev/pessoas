$(document).ready(function() {    
    // DataTables
    $('.datatable-pessoas').DataTable({
        dom: 'fBi'
        , order: ['1', 'asc']
        , language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
        }
        , paging: false
        , lengthChange: false
        , searching: true
        , ordering: true
        , info: true
        , autoWidth: true
        , lengthMenu: [
            [10, 25, 50, 100, -1]
            , ['10 linhas', '25 linhas', '50 linhas', '100 linhas', 'Mostar todos']
        ]
        , pageLength: -1
        , buttons: [
            'excelHtml5'
            , 'csvHtml5'
        ]
    });
}); 
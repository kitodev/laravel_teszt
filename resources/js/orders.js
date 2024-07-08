const { indexOf } = require("lodash");

$(document).ready(function(){
    var datatableTranslation = {
        "sProcessing": "Feldolgozás...",
        "sLengthMenu": "Sorok száma",
        "sZeroRecords": "Nincs adat",
        "sEmptyTable": "Üres táblázat",
        "sInfo": "",
        "sInfoEmpty": "",
        "sInfoFiltered": ")",
        "sInfoPostFix": "",
        "sSearch": "Keresés",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Betöltés",
        "oPaginate": {
            "sFirst": "Első",
            "sLast": "Utolsó",
            "sNext": "Következő",
            "sPrevious": "Előző"
        },
        "oAria": {
            "sSortAscending": ": Növekvő sorrend",
            "sSortDescending": ": Csökkenő sorrend"
        }
    };

    var searchFields = [
        'Kor',
        'Nem',
        'Szállítási mód'
    ];

    $('#orders-table tfoot th').each(function(i){
        var title = $(this).text().trim();
        if(searchFields.indexOf(title) > -1){
            $(this).html(
                '<input type="text" placeholder="' + title + '" data-index="' + i + '" />'
            );
        }
    });

    var table = $('#orders-table.dataTable').DataTable({
        language: datatableTranslation,
        fixedColumns: true
    });

    $(table.table().container()).on('keyup', 'tfoot input', function () {
        table
            .column($(this).data('index'))
            .search(this.value)
            .draw();
    });
});
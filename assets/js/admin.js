import 'jquery';
require('popper.js');

import './../vendor/js/bootstrap-material-design'
import './../vendor/js/plugins/perfect-scrollbar.jquery.min'
import './../vendor/js/plugins/jquery.datatables'
import './../vendor/js/material-dashboard'

$(function () {
    let datables = $('#datatables');
    datables.DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        language: {
            lengthMenu: "Voir _MENU_ entrées",
            info: "Page _PAGE_ / _PAGES_",
            paginate: {
                first: 'Début',
                previous: 'Précedent',
                next: 'Suivant',
                last: 'Fin'
            },
            emptyTable: "Aucune entrée",
            zeroRecords: "Aucun résultat",
            search: "_INPUT_",
            searchPlaceholder: "Rechercher",
        }
    });

    var table = datables.DataTable();

// Edit record
    table.on('click', '.edit', function () {
        let $tr = $(this).closest('tr');

        var data = table.row($tr).data();
        alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
    });

// Delete a record
    table.on('click', '.remove', function (e) {
        let $tr = $(this).closest('tr');
        table.row($tr).remove().draw();
        e.preventDefault();
    });

//Like record
    table.on('click', '.like', function () {
        alert('You clicked on Like button');
    });

    $('.card .material-datatables label').addClass('form-group');
});

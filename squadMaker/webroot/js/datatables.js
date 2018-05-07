$(document).ready(function() {
    let playersTable = $('table#players').DataTable({
        'order': [[ 5, 'asc' ]],
        'language': {
            'emptyTable': 'You have no players registered'
        }
    });

    let squadTable = $('table.squad').DataTable({
        'paging': false,
        'footerCallback': function (row, data, start, end, display) {
            let api = this.api();
            let rowCount = api.rows().count();

            // A function to return the integer value of a string
            let intVal = function (value) {
                return typeof value === 'string' ?
                    value * 1 :
                    typeof value === 'number' ?
                        value : 0;
            };

            // Calculate the totals of each skill column
            let shootingTotal = api.column(1).data().reduce(function (first, second) {
                return intVal(first) + intVal(second);
            }, 0);
            let skatingTotal = api.column(2).data().reduce(function (first, second) {
                return intVal(first) + intVal(second);
            }, 0);
            let checkingTotal = api.column(3).data().reduce(function (first, second) {
                return intVal(first) + intVal(second);
            }, 0);

            // Display the average of the above calculated totals in the footer of each column
            $(api.column(1).footer()).html(Math.trunc(shootingTotal / rowCount));
            $(api.column(2).footer()).html(Math.trunc(skatingTotal / rowCount));
            $(api.column(3).footer()).html(Math.trunc(checkingTotal / rowCount));
        }
    });
});

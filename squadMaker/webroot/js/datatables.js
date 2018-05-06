$(document).ready(function() {
    let table = $('table#players').DataTable({
        'order': [[ 5, 'asc' ]],
        'language': {
            'emptyTable': 'You have no players registered'
        }
    });
});

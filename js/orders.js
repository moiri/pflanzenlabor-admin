$(document).ready(function() {
    function format( d ) {
        return '<div class="text-prewrap">' + d.comment + '</div>';
    }
    var table = $('#orders').DataTable({
        "order": [[ 3, "desc" ]],
        "columnDefs": [
            {
                "targets": [ 1 ],
                "visible": false,
                "searchable": false,
                "data": "comment"
            }
        ]
    });

    // Add event listener for opening and closing details
    $('#orders tbody').on('click', 'td > i.fa-gift', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
});

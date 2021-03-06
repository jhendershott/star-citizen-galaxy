import '@coreui/coreui';
import '@fortawesome/fontawesome-free';
import 'datatables.net-bs4';
import 'select2';
import $ from "jquery";

$.fn.select2.defaults.set( "width", "100%" );

$(document).ready(function () {
    $('#js-ship-chassis-datatable').DataTable({
        paging: false,
        columnDefs: [
            {
                targets: 'nosort',
                orderable: false
            },
        ],
    });

    const select2Options = {
        theme: 'bootstrap',
    };
    $('.js-select2').select2(select2Options);
});

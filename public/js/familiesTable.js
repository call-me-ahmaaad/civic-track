$(document).ready(function () {
    $('#familiesTable').DataTable({
        columnDefs: [{
            className: 'dt-center',
            targets: '_all'
        }],
        pageLength: 10,
        lengthChange: false
    });
});
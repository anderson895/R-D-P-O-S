$(document).ready(function () {
    var dataTable = $('#example').DataTable();

    $('#newestToOldestBtn').on('click', function () {
        dataTable.order([5, 'desc']).draw();
    });

    $('#oldestToNewestBtn').on('click', function () {
        dataTable.order([5, 'asc']).draw();
    });
});
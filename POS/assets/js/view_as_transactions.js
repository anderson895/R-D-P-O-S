$(document).ready(function() {
    $('#viewSelectPOS').change(function() {
        var selectedValue = $(this).val();
        console.log(selectedValue)
        if (selectedValue == '1') {
            $('#posT, #itemsPerPage, #search, #pagination, #info').show();
            $('#posR, #itemsPerPageReturn, #searchReturn, #paginationReturn, #infoReturn').hide();
        } else if (selectedValue == '0') {
            $('#posR, #itemsPerPageReturn, #searchReturn, #paginationReturn, #infoReturn').show();
            $('#posT, #itemsPerPage, #search, #pagination, #info').hide();
        }
    });
});

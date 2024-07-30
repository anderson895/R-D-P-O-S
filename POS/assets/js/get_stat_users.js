$(document).ready(function() {
    $.ajax({
        url: '../../POS/functions/get_stat_users.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#customer').text(response.customer);
            $('#cashier').text(response.cashier);
            $('#rider').text(response.deliveryStaff);
            $('#supplier').text(response.supplier);
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
});
$(document).ready(function() {
    $.ajax({
        url: '../../POS/functions/get_total_sales.php', // Update with the correct path to your PHP script
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // Debugging: Log the response to check its structure
            // console.log(response);
            
            // Ensure that the values are numbers
            var onlineSum = parseFloat(response.todayOnlineSum);
            var posSum = parseFloat(response.todayPosSum);

            // Function to format numbers as currency with a space between the peso sign and the value
            function formatCurrency(value) {
                if (!isNaN(value)) {
                    return '₱ ' + value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                } else {
                    return '₱ 0.00';
                }
            }

            // Check if parsing was successful and the values are numbers
            $('#todayOnlineSales').text(formatCurrency(onlineSum));
            $('#todayPosSales').text(formatCurrency(posSum));
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            $('#todayOnlineSales').text('Error');
            $('#todayPosSales').text('Error');
        }
    });
});

 // Load initial data
 $(document).ready(function() {
    loadOrderData();
});

// Load order data using AJAX
function loadOrderData() {
    $.ajax({
        url: 'fetchOrders.php', // Adjust the URL as needed
        method: 'GET',
        success: function(data) {
            $('.order-table-body').html(data);
        }
    });
}

// Set interval to refresh data every 5 seconds
setInterval(loadOrderData, 5000);
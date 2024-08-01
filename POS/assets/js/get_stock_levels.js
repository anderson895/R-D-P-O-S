$(document).ready(function() {
    $.ajax({
        url: '../../POS/functions/get_stocks_level.php', // Your PHP endpoint
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#product-container').empty(); // Clear the container
            
            $.each(response, function(index, product) {
                var statusClass = ''; // Default status
                var statusText = '';
                
                // Convert string values to integers for comparison
                var prodCritical = parseInt(product.prod_critical, 10);
                var totalAmount = parseInt(product.total_amount, 10);
                
                // Check the critical level and total amount
                // Check the total amount first
                if (totalAmount === 0) {
                    statusClass = 'status-disable';
                    statusText = 'No Stock';
                } else if (totalAmount <= prodCritical) {
                    statusClass = 'status-warning';
                    statusText = 'Critical';
                } else {
                    statusClass = 'status-active';
                    statusText = 'In Stocks';
                }
                
                var productHtml = `
                    <div class="row mb-3">
                        <div class="col-9">
                            <div class="d-flex flex-row">
                                <div class="me-2" style="width: 30%; height: 70px; border-radius: 15px">
                                    <img class="border" style="border-radius: 15px;width: 100%; height: 100%; object-fit: cover" src="../../upload_prodImg/${product.prod_image}" alt="prod">
                                </div>
                                <div style="width: 70%;">
                                    <p class="fw-bold">${product.prod_name}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <p class="fw-bold text-end m-0">${totalAmount} pcs</p>
                            <div style="width: auto;" class="${statusClass} text-center">
                                <p class="m-0">${statusText}</p>
                            </div>
                        </div>
                    </div>
                `;
                
                $('#product-container').append(productHtml);
            });
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
});

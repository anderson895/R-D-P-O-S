$(document).ready(function() {
    $.ajax({
        url: '../../POS/functions/get_stocks_level.php', // Your PHP endpoint
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#product-container').empty(); // Clear the container
            
            $.each(response, function(index, product) {
                var statusClass = 'status-disabled'; // Default status
                var statusText = 'No Stock';
                
                //check of the critiocal level and totalamount
                if (product.prod_critical >= product.total_amount) {
                    statusClass = 'status-active';
                    statusText = 'In Stocks';
                } else if (product.total_amount === '0') {
                    statusClass = 'status-disabled';
                    statusText = 'No Stock';
                } else {
                    statusClass = 'status-warning';
                    statusText = 'Critical';
                }
                
                var productHtml = `
                    <div class="row mb-3">
                        <div class="col-9">
                            <div class="d-flex flex-row">
                                <div class="me-2 rounded" style="width: 30%; height: 70px">
                                    <img class="border rounded" style="width: 100%; height: 100%; object-fit: cover" src="../../upload_prodImg/${product.prod_image}" alt="prod">
                                </div>
                                <div style="width: 70%;">
                                    <p class="fw-bold">${product.prod_name}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <p class="fw-bold text-end m-0">${product.total_amount} pcs</p>
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
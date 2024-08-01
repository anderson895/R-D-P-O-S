$(document).ready(function() {
    $.ajax({
        url: '../../POS/functions/get_top_5_products_walkin.php', // Your PHP endpoint
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#top-walk').empty(); // Clear the container
            
            $.each(response, function(index, product) {
                var rank = index + 1; // Calculate rank based on index
                var stars = 6 - rank; // Calculate number of stars based on rank

                var productHtml = `
                    <div class="row mb-3">
                        <div class="col-8">
                            <div class="d-flex flex-row">
                                <div class="me-2" style="width: 30%; height: 70px; border-radius: 15px">
                                    <img class="border" style="border-radius: 15px;width: 100%; height: 100%; object-fit: cover" src="../../upload_prodImg/${product.prod_image}" alt="${product.prod_image}">
                                </div>
                                <div style="width: 70%;">
                                    <p class="fw-bold">#${rank} ${product.prod_name}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <p class="fw-bold text-end m-0">${product.qty} pcs</p>
                            <div style="width: auto;" class="text-center">
                                ${generateStars(stars)}
                            </div>
                        </div>
                    </div>
                `;
                
                $('#top-walk').append(productHtml);
            });
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });

    function generateStars(stars) {
        let starsHtml = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= stars) {
                starsHtml += '<i class="bi text-warning bi-star-fill"></i>';
            } else {
                starsHtml += '<i class="bi text-warning bi-star"></i>';
            }
        }
        return starsHtml;
    }
});

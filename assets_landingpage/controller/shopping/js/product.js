$(document).ready(function() {
    $('.view-product').click(function() {
        var id = $(this).data('id');
        window.location.href = "view_product.php?view_id=" + id;
    });
});

$('#categorySelect').change(function() {
    var selectedCategory = $(this).find(':selected').data('id');
    if (selectedCategory === 'all') {
        $('.product').show();
    } else {
        $('.product').hide();
        $('.categprod' + selectedCategory).show();
    }
});


document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("searchInput");
    const products = document.querySelectorAll(".product");

    searchInput.addEventListener("input", function() {
        const searchTerm = searchInput.value.trim().toLowerCase();

        products.forEach(function(product) {
            const productName = product.dataset.name;
            
            if (productName && searchTerm) {
                if (productName.toLowerCase().includes(searchTerm)) {
                    product.style.display = "block";
                } else {
                    product.style.display = "none";
                }
            }
        });
    });
});

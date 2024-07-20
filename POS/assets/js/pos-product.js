$(document).ready(function() {
    // Load the initial product list when the page loads
    loadProducts();

    // Attach an event handler to the input field
    $("#searchInput").on("input", function() {
        var searchTerm = $(this).val(); // Get the search term from the input field

        if (searchTerm === "") {
            // If there's no search term, load the initial product list
            loadProducts();
        } else {
            // Send the search term to the server using AJAX
            $.ajax({
                url: "../functions/table_product_list.php", // Change this to the URL of your PHP script
                type: "POST",
                data: { searchTerm: searchTerm },
                success: function(data) {
                    // Update the product display with the search results
                    $(".product").html(data);
                }
            });
        }
    });

    // Function to load the initial product list
    function loadProducts() {
        $.ajax({
            url: "../functions/table_product_list.php", // Change this to the URL of your PHP script
            type: "POST",
            data: { searchTerm: "" }, // An empty search term
            success: function(data) {
                // Update the product display with the initial product list
                $(".product").html(data);
            }
        });
    }
});
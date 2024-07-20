$(document).ready(function () {
    // Function to handle product search
    function searchProduct(query) {
        $.ajax({
            url: 'stock_in/controller/fetchProduct.php',
            method: 'POST',
            data: { query: query },
            dataType: 'json',
            success: function (response) {
                // Handle the response from the server
                displaySearchResults(response);

                console.log(response);
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.log('XHR:', xhr.responseText); // Log the full response text for debugging
            }
        });
    }

function displaySearchResults(results) {
    // Clear previous search results
    $('#updatesuggestionsContainer').empty();

    // Display new search results
    if (results.length > 0) {
        // Iterate through results and append them to the suggestions container
        $.each(results, function (index, result) {
            var suggestion = $('<div>' + result.prod_name + '</div>');

            // Add hover effect
            suggestion.hover(
                function () {
                    $(this).css('background-color', '#f0f0f0');
                },
                function () {
                    $(this).css('background-color', 'white');
                }
            );

            // Set search input value on click
            suggestion.click(function () {


                
                


                $('#updatesearchProduct').val(result.prod_name);
                $('#updatesearchProductCode').val(result.prod_code);
                $('#updateprod_expirationStatus').val(result.prod_expirationStatus);


                   $('#updateproductname').html(
                    'Product Name: ' +
                    (result.prod_name ? result.prod_name + '<br>' : '') +
               
                    ('Current price:' + (result.prod_currprice ? '₱' + Number(result.prod_currprice).toFixed(2) + '<br>' : ''))
                );
                
                // $('#updateproductname').html(
                //     'Product Name: ' +
                //     (result.prod_name ? result.prod_name + '<br>' : '') +
                //     (result.prod_kg != 0 ? 'Product Unit: ' + result.prod_kg + ' Kg<br>' : '') +
                //     (result.prod_ml != 0 ? 'Product Unit: ' + result.prod_ml + ' Ml<br>' : '') +
                //     (result.prod_g != 0 ? 'Product Unit: ' + result.prod_g + ' g<br>' : '') +
                //     ('Current price:' + (result.prod_currprice ? '₱' + Number(result.prod_currprice).toFixed(2) + '<br>' : ''))
                // );

                $('#UpdateunitLabel').show()

                $('#UpdateunitLabel').html(
                    (result.prod_kg != 0 ? result.prod_kg + 'Kg<br>' : '') +
                    (result.prod_ml != 0 ? result.prod_ml + 'Ml<br>' : '') +
                    (result.prod_g != 0 ? result.prod_g + 'g<br>' : '')
                );
                
              
            if (result.prod_image) {
                
                var imagePath = '../../upload_prodImg/' + result.prod_image;

                $('#updateproductImage').attr('src', imagePath);
                $('#updateproductImage').show();
            } else {
                $('#updateproductImage').hide();  // Hide the image element if there is no image
            }

                
                
                
                
                
                
                //prod_currprice
              

                // Handle expiration date visibility
                if (result.prod_expirationStatus === 'withExpi') {
                    $('#updateexpiDateDiv').show();  // Show the expiration date input field

                } else {
                    $('#updateexpiDateDiv').hide();  // Hide the expiration date input field
                    $('#updateexpiDate').val("");
                }

                // Clear suggestions after selecting
                $('#updatesuggestionsContainer').empty();
            });

            // Append the suggestion to the container
            $('#updatesuggestionsContainer').append(suggestion);
        });
    } else {
        // No results found
        $('#updatesuggestionsContainer').append('<div>No results found</div>');
    }
}




    // Event listener for the search input
    $('#updatesearchProduct').on('input', function () {

        
        var query = $(this).val();

        // Perform search only if the query is not empty
        if (query.trim() !== '') {
            searchProduct(query);
        } else {
            // Clear suggestions if the search input is empty
            $('#updatesuggestionsContainer').empty();
        }
    });

     // Event listener for the Save button
     $('#btnEdit').on('click', function () {

        //  $(document).on('click', '.btnRemove', function() {
        // Get the values from the input fields

        var supplier_code = $('#supplier_code').val();

        var db_s_id = $('#db_s_id').val();
        var invoice_no = $('#invoice_no').val();
        var stockin_date = $('#stockin_date').val();
        var quantity = $('#updateqtyInput').val();
        var supplierPrice = $('#updatesupplierPriceInput').val();
        var expirationDate = $('#updateexpiDate').val();
        var searchProductCode = $('#updatesearchProductCode').val();
        var prod_expirationStatus = $('#updateprod_expirationStatus').val();
    
        // Client-side validation
        if(prod_expirationStatus=="withExpi"){
            
         
            if (!supplier_code || !invoice_no || !stockin_date || !quantity || !supplierPrice || !searchProductCode || !expirationDate) {
                alertify.error('Please fill out all required fields.');
                return;
            }

        }else{

            if (!supplier_code || !invoice_no || !stockin_date || !quantity || !supplierPrice || !searchProductCode) {
                alertify.error('Please fill out all required fields.');
                return;
            }

        }
        

        var ajaxParams = {
            url: 'stock_in/controller/editStocks.php',
            method: 'POST',
            data: {
                db_s_id:db_s_id,
                supplier_code: supplier_code,
                invoice_no: invoice_no,
                stockin_date: stockin_date,
                quantity: quantity,
                supplierPrice: supplierPrice,
                product: searchProductCode
            },
            dataType: 'json',
            beforeSend: function () {
                // Show loading indicator
                // You can implement this part based on your UI framework or design
            },
            success: function (response) {
                // Handle the response from the server after saving the data
                console.log(response.status);


                if(response.status=="success"){
                    // location.reload();

                    $("#edit").modal("hide");
                }
                // Hide loading indicator
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.log('XHR:', xhr.responseText); // Log the full response text for debugging
                alertify.error('Error adding stock. Please try again.');
                // Hide loading indicator
            }
            
        };
    
        if (prod_expirationStatus === 'withExpi') {
            // Check if the expiration date is valid (at least 7 days from today or tomorrow)
            var today = new Date();
            today.setHours(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0 for accurate comparison
        
            var selectedExpirationDate = new Date(expirationDate);
            selectedExpirationDate.setHours(0, 0, 0, 0);
        
            var minimumExpirationDate = new Date(today);
            minimumExpirationDate.setDate(today.getDate() + 7); // Minimum expiration date is today + 7 days
        
            if (selectedExpirationDate < minimumExpirationDate) {
                alertify.error('Expiration date must be at least 7 days from today or tomorrow.');
                return;
            }
        
            ajaxParams.data.expirationDate = expirationDate;
        }
        
        // Check if the product exists before making the AJAX request
        checkProductExistence(searchProductCode, function (isProductExisting) {
            if (isProductExisting) {
                // Product exists, make the AJAX request
                $.ajax(ajaxParams);
            } else {
                alertify.error('Product not found.');
            }
        });
    });
    


     // Function to check if the product exists
     function checkProductExistence(searchProductCode, callback) {
        $.ajax({
            url: 'stock_in/controller/checkProductExistence.php', // Change the URL to the actual PHP file for checking existence
            method: 'POST',
            data: { searchProductCode: searchProductCode },
            dataType: 'json',
            success: function (response) {
                // Handle the response from the server
                callback(response.exists);
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.log('XHR:', xhr.responseText); // Log the full response text for debugging
            }
        });
    }
});

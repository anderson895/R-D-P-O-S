

$(document).on("click", "#ToglerRemoveAllFormCart", function() {
    purchase_id = $(this).attr('data-purchase_id');
    acc_id = $(this).attr('data-acc_id');
 //  console.log("error")
    //$('#ssid').val(ssid);
    console.log(purchase_id);
//start alert
    Swal.fire({
        title: "Remove from cart? ",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, remove it!",
        confirmButtonClass: "btn btn-primary",
        cancelButtonClass: "btn btn-danger ml-1",
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            // Dito mo isasagawa ang AJAX request para sa pag-update ng product
            $.ajax({
                url: 'managestocks/controller/removeCartrecord.php', // Palitan mo ito ng tamang URL
                type: 'POST',
                data: {
                    prodcart:prodcart
                   
                },
                success: function(response) {
                    // Dito mo ilalagay ang mga actions na kailangan mong gawin kapag successful ang update
                    
                      console.log(response)
                    
                },
                error: function(xhr, status, error) {
                    // Dito mo ilalagay ang mga actions para sa error handling
                    Swal.fire({
                        type: "error",
                        title: "Error",
                        text: "An error occurred while deleting the product.",
                        confirmButtonClass: "btn btn-danger"
                    });
                }
            });

            //end ajax
        }
    });
// end alert

});




$(document).on("click", ".ToglerRemoveCart", function() {
    prodcart = $(this).attr('data-prodcart');
   console.log("error")
    //$('#ssid').val(ssid);
    console.log(prodcart);

    Swal.fire({
        title: "Remove from cart? ",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, remove it!",
        confirmButtonClass: "btn btn-primary",
        cancelButtonClass: "btn btn-danger ml-4",
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            // Dito mo isasagawa ang AJAX request para sa pag-update ng product
            $.ajax({
                url: 'managestocks/controller/removeCartrecord.php', // Palitan mo ito ng tamang URL
                type: 'POST',
                data: {
                    prodcart:prodcart
                   
                },
                success: function(response) {
                    // Dito mo ilalagay ang mga actions na kailangan mong gawin kapag successful ang update
                   
                      //  location.reload();
                      console.log(response)
               
                },
                error: function(xhr, status, error) {
                    // Dito mo ilalagay ang mga actions para sa error handling
                    Swal.fire({
                        type: "error",
                        title: "Error",
                        text: "An error occurred while deleting the product.",
                        confirmButtonClass: "btn btn-danger"
                    });
                }
            });
        }
    });
});

    $(document).on("click", ".deleteConfirmation", function() {
        prod_id = $(this).attr('data-prod_id');
        acc_id = $(this).attr('data-acc_id');
        prod_code = $(this).attr('data-prod_code');
        //$('#ssid').val(ssid);
        console.log(prod_id);

        Swal.fire({
            title: "Are you sure?",
            text: "Remove this product",
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
                    url: 'productlist/controller/delete_product.php', // Palitan mo ito ng tamang URL
                    type: 'POST',
                    data: {
                        prod_id:prod_id,
                        acc_id:acc_id,
                        prod_code: prod_code, // Palitan mo ito ng tamang product ID
                        prod_status: 2
                    },
                    success: function(response) {
                        // Dito mo ilalagay ang mga actions na kailangan mong gawin kapag successful ang update
                        Swal.fire({
                            type: "success",
                            title: "Deleted!",
                            text: "Your product has been removed.",
                            confirmButtonClass: "btn btn-success"
                        }).then(function() {
                        // location.reload();
                        });
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

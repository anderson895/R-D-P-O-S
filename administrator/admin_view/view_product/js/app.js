

$(".toglerRestore").on("click", function() {
    prod_id = $(this).attr('data-prod_id');
    acc_id = $(this).attr('data-acc_id');
    prod_code = $(this).attr('data-prod_code');
    //$('#ssid').val(ssid);
    console.log(prod_code);

    Swal.fire({
        title: "Are you sure?",
        text: "Remove this product",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Restore it!",
        confirmButtonClass: "btn btn-primary",
        cancelButtonClass: "btn btn-danger ml-1",
        buttonsStyling: false
    }).then(function(result) {
        if (result.value) {
            // Dito mo isasagawa ang AJAX request para sa pag-update ng product
            $.ajax({
                url: 'productlist/controller/restore.php', // Palitan mo ito ng tamang URL
                type: 'POST',
                data: {
                    prod_id:prod_id,
                    acc_id:acc_id,
                    prod_code: prod_code, // Palitan mo ito ng tamang product ID
                    prod_status: 0
                },
                success: function(response) {
                    // Dito mo ilalagay ang mga actions na kailangan mong gawin kapag successful ang update
                    Swal.fire({
                        type: "success",
                        title: "Restore!",
                        text: "Your product has been Restored.",
                        confirmButtonClass: "btn btn-success"
                    }).then(function() {
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    // Dito mo ilalagay ang mga actions para sa error handling
                    Swal.fire({
                        type: "error",
                        title: "Error",
                        text: "An error occurred while restoring the product.",
                        confirmButtonClass: "btn btn-danger"
                    });


                    console.log(response)
                }
            });
        }
    });
});


$("#frmUploadImage").submit(function (e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);

    // Disable Save button and show spinner
    $('.btnSave').hide(); 
    $('.spinner-grow').closest('button').show();
 
    

    $.ajax({
        type: "POST",
        url: "view_product/endpoint/pos_img.php",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "text",
        success: function (response) {
            console.log(response);

            if (response.trim() === "200") {
                alertify.success("Image uploaded successfully!");
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                alertify.error("Uploading failed!");
                // Re-enable Save button and hide spinner on failure
                $('.btnSave').show(); 
                $('.spinner-grow').closest('button').hide();
            }
        },
        error: function (xhr, status, error) {
            console.error(`Status: ${status}, Error: ${error}`);
            alertify.error("An error occurred during the upload.");
            // Re-enable Save button and hide spinner on error
            $('.btnSave').show(); 
            $('.spinner-grow').closest('button').hide();
        }
    });
});

// Initially hide the spinner button
$('.spinner-grow').closest('button').hide();





$(document).ready(function() {
    $('.btnDeleteProduct').click(function() {
        var img_id = $(this).data('img_id');
        var filename = $(this).data('filename');

        // Show Alertify confirmation dialog
        alertify.confirm("Delete Confirmation", "Are you sure you want to delete photos of this product?",
            function() {
                // User confirmed, proceed with AJAX request
                $.ajax({
                    url: 'view_product/endpoint/del_img.php', // Replace with your actual endpoint URL
                    type: 'POST',
                    data: {
                        img_id: img_id,
                        filename: filename
                    },
                    success: function(response) {
                        // Handle the response from the server
                        console.log(response);
                        alertify.success("Deleted successfully!");
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors
                        console.error('AJAX Error: ' + status + error);
                    }
                });
            },
            function() {
                // User canceled, no action needed
                alertify.error("Delete canceled");
            }
        ).set('labels', {ok:'Yes', cancel:'No'}); // Customize button labels
    });
});

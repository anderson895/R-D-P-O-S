

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
                alert("Image Uploaded!");
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                alert("Uploading Failed!");
            }
        },
        error: function (xhr, status, error) {
            console.error(`Status: ${status}, Error: ${error}`);
            alert("An error occurred during the upload.");
        }
    });
});



$(document).ready(function() {
    $('.btnDeleteProduct').click(function() {
        var img_id = $(this).data('img_id');
        var filename = $(this).data('filename');

        // Show confirmation dialog
        var userConfirmed = confirm("Are you sure you want to delete photos of this product?");
        if (userConfirmed) {
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
                    // alert('Product deleted successfully');
                    alert("Image Uploaded!");
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    // Handle any errors
                    console.error('AJAX Error: ' + status + error);
                }
            });
        }
    });
});
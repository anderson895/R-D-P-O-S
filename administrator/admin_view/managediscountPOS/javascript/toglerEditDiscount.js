$(document).ready(function() {
    

    // Editing Discount
    $(".toglerEditDiscount").on("click", function() {
        // Define db_acc_id and spl_id or obtain their values
        var discount_id_update = $(this).data("discount_id");  // Replace with actual value
        var discount_name_update = $(this).data("discount_name");     // Replace with actual value
        var discount_description_update = $(this).data("discount_description");  
        var discount_rate_update = $(this).data("discount_rate");  
        var discount_status_update = $(this).data("discount_status");  

        $("#discount_id_update").val(discount_id_update);
        $("#discount_name_update").val(discount_name_update);
        $("#discount_description_update").val(discount_description_update);
        $("#discount_rate_update").val(discount_rate_update);
        $("#discount_status_update_select").val(discount_status_update);

        console.log(discount_rate_update);
    });

    // Processing Edit Discount
    $(".toglerEditDiscountProcess").on("click", function() {
        $('#validation-messages_for_updateModal').empty();

        // Get form input values
        const acc_id = $("#acc_id").val();
        const discount_id_update = $("#discount_id_update").val();
        const discount_name_update = $("#discount_name_update").val();
        const discount_description_update = $("#discount_description_update").val();
        const discount_rate_update = $("#discount_rate_update").val();
        const discount_status_update_select = $("#discount_status_update_select").val();

       
        // Validate Discount Name
        if (discount_name_update.length < 1 || discount_name_update.length > 10) {
            $('#validation-messages_for_updateModal').append('<p>Discount Name should have a minimum of 1 character and a maximum of 10 characters.</p>');

        
        }

        // Validate Description
        if (discount_description_update.length < 5 || discount_description_update.length > 300) {
            $('#validation-messages_for_updateModal').append('<p>Description should have a minimum of 5 characters and a maximum of 300 characters.</p>');
        }

        // Validate Discount Rate
        if (isNaN(discount_rate_update) || discount_rate_update < 0 || discount_rate_update > 100) {
            $('#validation-messages_for_updateModal').append('<p>Discount Rate should be a number between 0 and 100.</p>');
        }

        // If there are validation errors, prevent the modal from closing and stop the AJAX request
        if ($('#validation-messages_for_updateModal').children().length > 0) {
            return false; // This will prevent the default behavior (e.g., form submission) and stop the event propagation
        }

        console.log(discount_name_update)

        // If no validation errors, proceed with AJAX request
        $.ajax({
            url: 'managediscountPOS/controller/update_DiscountProcess.php',
            type: 'POST',
            data: {
                acc_id: acc_id,
                discount_id_update: discount_id_update,
                discount_name_update: discount_name_update,
                discount_description_update: discount_description_update,
                discount_rate_update: discount_rate_update,
                discount_status_update_select: discount_status_update_select
            },
            success: function(response) {
                // Actions for successful update
                Swal.fire({
                    type: "success",
                    title: "Success!",
                    text: "Unit update successful.",
                    confirmButtonClass: "btn btn-success"
                }).then(function() {
                    location.reload();
                    console.log(response);
                });
            },
            error: function(xhr, status, error) {
                // Error handling actions
                Swal.fire({
                    type: "error",
                    title: "Error",
                    text: "An error occurred while updating the unit: " + error,
                    confirmButtonClass: "btn btn-danger"
                });
                console.error(error);
            }
        });
    });
});

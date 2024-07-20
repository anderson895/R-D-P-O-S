$(document).ready(function() {
    

    // Editing Discount
    $(".toglerEditDiscount").on("click", function() {
        // Define db_acc_id and spl_id or obtain their values
        var voucher_id_update = $(this).data("voucher_id_update");  // Replace with actual value
        var voucher_name_update = $(this).data("voucher_name_update");     // Replace with actual value
        var voucher_desciption_update = $(this).data("voucher_desciption_update");  
        var voucher_discount_update = $(this).attr("data-voucher_discount_update");  
        var voucher_maximumLimit_update = $(this).attr("data-voucher_maximumLimit_update");  
        var voucher_status_update = $(this).data("voucher_status");  
        var voucher_expiration = $(this).attr("data-voucher_expiration");  

      
        var expirationDate_update = $('#expirationDate_update').val(); 
        var inputDate_update = new Date(expirationDate_update);
        

        console.log(voucher_expiration);

        $("#discount_id_update").val(voucher_id_update);
        $("#discount_name_update").val(voucher_name_update);
        $("#discount_description_update").val(voucher_desciption_update);
        $("#discount_rate_update").val(voucher_discount_update);
        $("#discount_status_update_select").val(voucher_status_update);
        $("#discount_maxlimit_update").val(voucher_maximumLimit_update);
        $("#inputDate_update").val(inputDate_update);
        $("#expirationDate_update").val(voucher_expiration);

   
    });

    // Processing Edit Discount
    $(".toglerEditDiscountProcess").on("click", function() {
        $('#validation-messages_for_updateModal').empty();

        // // Get form input values
        const acc_id = $("#acc_id").val();
        const discount_id_update = $("#discount_id_update").val();
        const discount_name_update = $("#discount_name_update").val();
        const discount_description_update = $("#discount_description_update").val();
        const discount_rate_update = $("#discount_rate_update").val();
        const discount_maxlimit_update_select = $("#discount_maxlimit_update").val();
        const discount_status_update_select = $("#discount_status_update_select").val();
        const inputDate_update = $("#inputDate_update").val();
        const expirationDate_update = $("#expirationDate_update").val();

        
       


   


        var inputDate = new Date(expirationDate_update);

        // Get the current date
        var currentDate = new Date();

        // Check if the input date is valid and not earlier than the current date
        if (isNaN(inputDate.getTime()) || inputDate < currentDate) {
            // Invalid date
            $('#validation-messages_for_updateModal').append('<p>Invalid Date.</p>');
        } 
        // Validate Discount Name
        if (discount_name_update.length < 1 || discount_name_update.length > 20) {
            $('#validation-messages_for_updateModal').append('<p>Discount Name should have a minimum of 1 character and a maximum of 20 characters.</p>');
        }

        // Validate Description
        if (discount_description_update.length < 5 || discount_description_update.length > 300) {
            $('#validation-messages_for_updateModal').append('<p>Description should have a minimum of 5 characters and a maximum of 300 characters.</p>');
        }


        // Validate maxlimit
        if (isNaN(discount_maxlimit_update_select) || discount_maxlimit_update_select < 0 || discount_maxlimit_update_select > 999999) {
            $('#validation-messages_for_updateModal').append('<p>Maximumlimit should be a number between 0 and 999999.</p>');
        }

        // Validate Discount Rate
        if (isNaN(discount_rate_update) || discount_rate_update < 0 || discount_rate_update > 100) {
            $('#validation-messages_for_updateModal').append('<p>Discount Rate should be a number between 0 and 100.</p>');
        }

        // If there are validation errors, prevent the modal from closing
        if ($('#validation-messages_for_updateModal').children().length > 0) {
            return false;
        }



      

        // If no validation errors, proceed with AJAX request
        $.ajax({
            url: 'managediscountORDER/controller/update_DiscountProcess.php',
            type: 'POST',
            data: {
                acc_id: acc_id,
                discount_id_update: discount_id_update,
                discount_name_update: discount_name_update,
                discount_description_update: discount_description_update,
                discount_rate_update:discount_rate_update,
                discount_maxlimit_update_select:discount_maxlimit_update_select,
                discount_status_update_select: discount_status_update_select,
                inputDate_update: inputDate_update,
                expirationDate_update:expirationDate_update
   
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


$(document).ready(function() {










    $('.toglerAddDiscount').click(function() {
        // Reset previous validation messages

        

        $('#validation-messages').empty();

        // Get input values
        var acc_id = $('#acc_id').val();
        var discount_name = $('#discount_name').val();
        var discount_description = $('#discount_description').val();
        var maxlimit = $('#maxlimit').val();
        var discount_rate = $('#discount_rate').val(); 
       
        var voucherStatus = $('#voucherStatus').val(); 

        var expirationDate = $('#expirationDate').val(); 

        var inputDate = new Date(expirationDate);

        // Get the current date
        var currentDate = new Date();

        // Check if the input date is valid and not earlier than the current date
        if (isNaN(inputDate.getTime()) || inputDate < currentDate) {
            // Invalid date
            $('#validation-messages').append('<p>Invalid Date.</p>');
        } 
        // Validate Discount Name
        if (discount_name.length < 1 || discount_name.length > 20) {
            $('#validation-messages').append('<p>Discount Name should have a minimum of 1 character and a maximum of 20 characters.</p>');
        }

        // Validate Description
        if (discount_description.length < 5 || discount_description.length > 300) {
            $('#validation-messages').append('<p>Description should have a minimum of 5 characters and a maximum of 300 characters.</p>');
        }


        // Validate maxlimit
        if (isNaN(maxlimit) || maxlimit < 0 || maxlimit > 999999) {
            $('#validation-messages').append('<p>Maximumlimit should be a number between 0 and 999999.</p>');
        }

        // Validate Discount Rate
        if (isNaN(discount_rate) || discount_rate < 0 || discount_rate > 100) {
            $('#validation-messages').append('<p>Discount Rate should be a number between 0 and 100.</p>');
        }

        // If there are validation errors, prevent the modal from closing
        if ($('#validation-messages').children().length > 0) {
            return false;
        }

        $("#toglerAddDiscount").css("display", "none");
        $(".btn-cancel").css("display", "none");

        // If there are no validation errors, proceed with the AJAX request
        $.ajax({
            type: 'POST',
            url: 'managediscountORDER/controller/addDiscount.php', // Replace with your server endpoint
            data: {
                discount_name: discount_name,
                discount_description: discount_description,
                discount_rate: discount_rate,
                expirationDate:expirationDate,
                voucherStatus: voucherStatus,
                maxlimit:maxlimit,
                acc_id:acc_id
            },
            success: function(response) {
                // Handle the success response from the server
                console.log(response);
                // Optionally, you can close the modal here
                //$('#addpayment').modal('hide');
                
            },
            beforeSend: function() {
                $("#loadingSpinner").html('<div class="spinner-border text-warning" role="status"><span class="sr-only">Loading...</span></div>').show();
              }, 
            error: function(error) {
                // Handle the error response from the server
                console.error(error);
            },
            complete: function() {
                $("#loadingSpinner").hide();
                $("#toglerAddDiscount").css("display", "block");
                $(".btn-cancel").css("display", "block");
                location.reload();
              }
        });
    });
});


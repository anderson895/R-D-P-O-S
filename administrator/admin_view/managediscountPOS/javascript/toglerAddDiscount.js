
$(document).ready(function() {
    $('.toglerAddDiscount').click(function() {
        // Reset previous validation messages
        $('#validation-messages').empty();

        // Get input values
        var acc_id = $('#acc_id').val();
        var discountName = $('#discount_name').val();
        var description = $('#discount_description').val();
        var discountRate = $('#discount_rate').val();
        var unitStatus = $('#unitStatus').val(); 

        // Validate Discount Name
        if (discountName.length < 1 || discountName.length > 10) {
            $('#validation-messages').append('<p>Discount Name should have a minimum of 1 character and a maximum of 10 characters.</p>');
        }

        // Validate Description
        if (description.length < 5 || description.length > 300) {
            $('#validation-messages').append('<p>Description should have a minimum of 5 characters and a maximum of 300 characters.</p>');
        }

        // Validate Discount Rate
        if (isNaN(discountRate) || discountRate < 0 || discountRate > 100) {
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
            url: 'managediscountPOS/controller/addDiscount.php', // Replace with your server endpoint
            data: {
                discountName: discountName,
                description: description,
                discountRate: discountRate,
                unitStatus: unitStatus,
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


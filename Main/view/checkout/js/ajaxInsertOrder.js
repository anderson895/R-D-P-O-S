$(document).ready(function() {


    $("#btnCunfirmOrder").on("click", function() {
        var timeOrder = $("#timeOrder").val();
        var user_add_display_status = $("#user_add_display_status").val();
        var user_add_Default_status = $("#user_add_Default_status").val();
        var user_address_id = $("#user_address_id").val();
        var regionCode = $("#GenerateRegionCode").val();
        var regionName = $("#GenerateRegionName").val();
        var acc_code = $("#acc_code").val();
        var customer_id = $("#customer_id").val();
        var edit_Fullname = $("#edit_Fullname").val();
        var edit_Contact = $("#edit_Contact").val();
        var edit_email = $("#edit_email").val();
        var address = $("#address").val();
        var BankEwallet = $("#BankEwallet").val();

        var user_add_users_longitud = $("#user_add_users_longitud").val();
        var user_add_users_latitude = $("#user_add_users_latitude").val();

        var db_system_tax=$("#db_system_tax").val();
        var address_rate=$("#address_rate").val();

        

        var prodIds = [];
        var cartIds = [];
        var vnames = [];
        var vdiscounts = [];
        var prod_currprices = [];

        var db_cart_prodQtys = [];

        var total_prices = [];

        var new_total_prices = [];

        $("input[name='total_price[]']").each(function() {
            var total_price = $(this).val();
            total_prices.push(total_price);
        });

        $("input[name='new_total_price[]']").each(function() {
            var new_total_price = $(this).val();
            new_total_prices.push(new_total_price);
        });


        //new_total_price[]

        $("input[name='db_cart_prodQty[]']").each(function() {
            var db_cart_prodQty = $(this).val();
            db_cart_prodQtys.push(db_cart_prodQty);
        });


        $("input[name='prod_currprice[]']").each(function() {
            var prod_currprice = $(this).val();
            prod_currprices.push(prod_currprice);
        });

        $("input[name='db_voucher_discount[]']").each(function() {
            var voucher_discount = $(this).val();
            vdiscounts.push(voucher_discount);
        });


        $("input[name='db_voucher_name[]']").each(function() {
            var voucher_name = $(this).val();
            vnames.push(voucher_name);
        });

        $("input[name='cart_id[]']").each(function() {
            var cart_id = $(this).val();
            cartIds.push(cart_id);
        });

         // Iterate over input elements with name "prod_id[]"
         $("input[name='prod_id[]']").each(function() {
            var value = $(this).val();
            prodIds.push(value);
        });

        

        // Create a FormData object to include all data, including uploaded files
        var formData = new FormData();
        formData.append('attachment', $('#paymentAttachment')[0].files[0]); // Add the uploaded file
        formData.append('prodIds', prodIds); // Add your array or other data as needed
        formData.append('cartIds', cartIds); // Add your array or other data as needed
        formData.append('vnames', vnames); // Add your array or other data as needed
        formData.append('vdiscounts', vdiscounts); // Add your array or other data as needed
        formData.append('timeOrder', timeOrder);
        formData.append('user_add_display_status', user_add_display_status);
        formData.append('user_add_Default_status', user_add_Default_status);
        formData.append('user_address_id', user_address_id);
        formData.append('regionCode', regionCode);
        formData.append('regionName', regionName);
        formData.append('acc_code', acc_code);
        formData.append('customer_id', customer_id);
        formData.append('edit_Fullname', edit_Fullname);
        formData.append('edit_Contact', edit_Contact);
        formData.append('edit_email', edit_email);
        formData.append('address', address);

        formData.append('db_cart_prodQtys', db_cart_prodQtys);
        
        formData.append('total_prices', total_prices);
        formData.append('BankEwallet', BankEwallet);
     
        
        
        formData.append('user_add_users_longitud', user_add_users_longitud);
        formData.append('user_add_users_latitude', user_add_users_latitude);

        formData.append('db_system_tax', db_system_tax);

        formData.append('address_rate', address_rate);

        formData.append('prod_currprices', prod_currprices);

        formData.append('new_total_prices', new_total_prices);

        
        
        // Use AJAX to send the data to the server///
        $("#btnCunfirmOrder").prop("disabled", true);
        $("#no").prop("disabled", true);
      

        $.ajax({
            type: "POST",
            url: "back_ordering.php",
            data: formData,
            beforeSend: function() {
                $("#loadingSpinner").html('<div class="spinner-border text-warning" role="status"><span class="sr-only">Loading...</span></div>').show();
              },
            // Use the FormData object
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Set content type to false
            success: function(response) {
                // Handle the response from the server
                console.log("Server Response:", response);
                alertify.success("Request successfully sent " );
                //   $("#sendRequestTogler").prop("disabled", false);
             //   $("#btnCunfirmOrder").prop("disabled", true);
                location.href = "myOrders.php";
            },
            error: function(error) {
                console.error("Error:", error);
            },
            complete: function() {
                // Hide loading spinner after the request is complete (success or error)
              $("#loadingSpinner").hide();
                
          
            }
        });
    });
});

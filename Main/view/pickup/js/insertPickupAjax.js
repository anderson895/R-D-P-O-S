$(document).ready(function() {


    $("#btnCunfirmOrder").on("click", function() {
       
        var customername=$("#customername").val();
        var BankEwallet = $("#BankEwallet").val();

        var datePick=$("#datePick").val();
        var timePick=$("#timePick").val();

        var db_system_tax=$("#db_system_tax").val();

        var acc_id=$("#customer_id").val();

        
      
     

    
        var db_cart_prodQtys = [];

        var prodids = [];
        var total_prices = [];
        var new_total_prices = [];

        

        var prod_currprices = [];

        var db_voucher_names = [];
        var db_voucher_discounts = [];
        var cart_ids = [];

        
        $("input[name='cart_id[]']").each(function() {
            var cart_id = $(this).val();
            cart_ids.push(cart_id);
        });



        $("input[name='db_voucher_name[]']").each(function() {
            var db_voucher_name = $(this).val();
            db_voucher_names.push(db_voucher_name);
        });

       
        $("input[name='db_voucher_discount[]']").each(function() {
            var db_voucher_discount = $(this).val();
            db_voucher_discounts.push(db_voucher_discount);
        });


        $("input[name='prod_currprice[]']").each(function() {
            var prod_currprice = $(this).val();
            prod_currprices.push(prod_currprice);
        });

        
        

        $("input[name='prod_id[]']").each(function() {
            var prodid = $(this).val();
            prodids.push(prodid);
        });


        $("input[name='total_price[]']").each(function() {
            var total_price = $(this).val();
            total_prices.push(total_price);
        });

        $("input[name='db_cart_prodQty[]']").each(function() {
            var db_cart_prodQty = $(this).val();
            db_cart_prodQtys.push(db_cart_prodQty);
        });

        $("input[name='new_total_price[]']").each(function() {
            var new_total_price = $(this).val();
            new_total_prices.push(new_total_price);
        });



       
        

        

        // Create a FormData object to include all data, including uploaded files
        var formData = new FormData();
        formData.append('attachment', $('#paymentAttachment')[0].files[0]); // Add the uploaded file
        formData.append('prodids', prodids); // Add your array or other data as needed
       
        formData.append('db_voucher_names', db_voucher_names);
        formData.append('db_voucher_discounts', db_voucher_discounts);

        formData.append('db_cart_prodQtys', db_cart_prodQtys);
        
        formData.append('total_prices', total_prices);
        formData.append('BankEwallet', BankEwallet);
     
        formData.append('acc_id', acc_id);
        
        formData.append('datePick', datePick);
        formData.append('timePick', timePick);

        formData.append('db_system_tax', db_system_tax);

        formData.append('customername', customername);

        formData.append('prod_currprices', prod_currprices);

        formData.append('new_total_prices', new_total_prices);

        formData.append('cart_ids', cart_ids);

        
        // Use AJAX to send the data to the server///
        $("#btnCunfirmOrder").prop("disabled", true);
        $("#no").prop("disabled", true);
      

        $.ajax({
            type: "POST",
            url: "back_pickup.php",
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
                location.href = "myPickup.php";
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

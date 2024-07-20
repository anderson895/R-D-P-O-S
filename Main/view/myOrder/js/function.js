

$(document).ready(function() {

	$('.toglertrash').click(function() {
    var value2 = $(this).attr('data-value2'); 
    var orders_id_remove = $(this).attr('data-orders_id'); // Corrected attribute name
    
    $('#orders_id_remove').val(orders_id_remove);
    $('#value2').val(value2);

    console.log(orders_id_remove);

    var orders_status_rem = $(this).attr('data-orders_status'); 
    $('#orders_status_rem').val(orders_status_rem);

    // console.log(orders_status_rem)
});

	//orders_status



  var orderTransactionCode; // Declare a variable to store the order transaction code

  $('.zz').click(function() {
    var orderId = $(this).val();

    orders_status = $(this).attr('data-orders_status'); // Store the order transaction code in the variable
    $('#orders_status').val(orders_status);

	
    orderTransactionCode = $(this).attr('data-value2'); // Store the order transaction code in the variable
    $('#orders_id').val(orderId);
    //$('#status').val('Cancelled');
    $('#order_transaction_code').text(orderTransactionCode); // Display the order transaction code

    if(orders_status=="Decline" ||orders_status== "Cancelled"){
      $('#warning').text("Remove order from the display ?");

      console.log("Remove order from the display ?")
    }else{
      $('#warning').text("Are you sure you want to cancel your order? ?");
      console.log("Are you sure you want to cancel your order? ?")
    }
  
   
  });



  
  $('#cancelBtn').click(function() {
    var orderId = $('#orders_id').val();
    var status = $('#status').val();
    var value2 = $('.zz').data('value2'); // Retrieve the value2 from the .zz button
    $.ajax({
      url: 'back_myOrders.php',
      type: 'POST',
      data: { orders_id: orderId,orders_status:orders_status, status: status, btncancel: true, value2: orderTransactionCode },
      success: function(response) {
		console.log(response)
        // Refresh the page
         location.reload();

       //console.log(orders_status); // Use the orderTransactionCode variable here
      },
      error: function(xhr, status, error) {
        alert('Failed to cancel the order.');
      }
    });
  });
});



function myFunction(order_transaction_code) {
    window.location.href = "order_progress.php?transaction_code=" + order_transaction_code;
  }
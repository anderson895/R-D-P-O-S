

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




  



  
  $('.btnAcceptOrder').click(function() {
    var acc_id = $('.acc_id').val();
    var orders_status = $('.orders_status').val();
    var order_transaction_code = $('.order_transaction_code').val();
    var customerFullname=$('.customerFullname').val();
  
    $(".btnAcceptOrder").css("display", "none");

    $.ajax({
      url: 'userlist_order/controller/back_ApproveOrders.php',
      type: 'POST',
      data: { acc_id: acc_id,orders_status:orders_status, orders_status: orders_status, btnAcceptOrder: true, transaction_code: order_transaction_code,customerFullname:customerFullname },
      success: function(response) {
		console.log(response)
      },
      beforeSend: function() {
        $(".loadingSpinner").html('<div class="spinner-border text-warning" role="status"><span class="sr-only">Loading...</span></div>').show();
      }, 

      error: function(xhr, status, error) {
        alert('Failed to cancel the order.');
      },

      complete: function() {
        alertify.success("Accept order successful");
        $(".loadingSpinner").hide();
        $(".btnAcceptOrder").css("display", "block");
        $('.exampleModal').modal('hide');
        
      }

    });
  });



  
  $('.btnDecline').click(function() {
    var acc_id = $('.acc_id').val();
    var order_transaction_code = $('.order_transaction_code').val();
    var orders_status = $('.orders_status').val();
    var customerFullname=$('.customerFullname').val();

    
    $(".btnDecline").css("display", "none");

    $.ajax({
      url: 'userlist_order/controller/back_ApproveOrders.php',
      type: 'POST',
      data: { acc_id:acc_id, btnDecline: true, transaction_code: order_transaction_code,orders_status:orders_status,customerFullname:customerFullname },
      success: function(response) {
        console.log(response)
      },

      beforeSend: function() {
        $(".loadingSpinner").html('<div class="spinner-border text-warning" role="status"><span class="sr-only">Loading...</span></div>').show();
      }, 
      
      error: function(xhr, status, error) {
        //alert('Failed to cancel the order.');
        console.log(status, error)
      },
      complete: function() {
        alertify.error("Decline order successful");
        $(".loadingSpinner").hide();
        $(".btnDecline").css("display", "block");
        $('#declineModal').modal('hide');
        
      }

    });
  });



  $('.btnArchive').click(function() {
    var acc_id = $('.acc_id').val();
    var order_transaction_code = $('.order_transaction_code').val();
    var orders_status = $('.orders_status').val();
    var customerFullname=$('.customerFullname').val();

    
    $(".btnArchive").css("display", "none");

    $.ajax({
      url: 'userlist_order/controller/back_ApproveOrders.php',
      type: 'POST',
      data: { acc_id:acc_id, btnArchive: true, transaction_code: order_transaction_code,orders_status:orders_status,customerFullname:customerFullname },
      success: function(response) {
        console.log(response)
      },

      beforeSend: function() {
        $(".loadingSpinner").html('<div class="spinner-border text-warning" role="status"><span class="sr-only">Loading...</span></div>').show();
      }, 
      
      error: function(xhr, status, error) {
        //alert('Failed to cancel the order.');
        console.log(status, error)
      },
      complete: function() {
        alertify.error("Decline order successful");
        $(".loadingSpinner").hide();
        $(".btnArchive").css("display", "block");
        $('#declineModal').modal('hide');
        
      }

    });
  });




  
  
  $('.btnToRecieve').click(function() {
    var customerFullname=$('.customerFullname').val();
    var acc_id = $('.acc_id').val();
    var order_transaction_code = $('.order_transaction_code').val();
    var orders_status = $('.orders_status').val();
   

    $(".btnToRecieve").css("display", "none");

    $.ajax({
      url: 'userlist_order/controller/back_ApproveOrders.php',
      type: 'POST',
      data: { acc_id:acc_id, btnToRecieved: true, transaction_code: order_transaction_code,orders_status:orders_status,customerFullname:customerFullname },
      success: function(response) {

        console.log(response)

      },

      beforeSend: function() {
        $(".loadingSpinner").html('<div class="spinner-border text-warning" role="status"><span class="sr-only">Loading...</span></div>').show();
      }, 

      error: function(xhr, status, error) {
        //alert('Failed to cancel the order.');
        console.log(status, error)
      },

      complete: function() {
        alertify.success("Order status change to recieve successful");
        $(".loadingSpinner").hide();
        $(".btnToRecieve").css("display", "block");
        $('.toRecieveModal').modal('hide');
        
      }
      
    });
  });




  $('.btnComplete').click(function() {
    var customerFullname=$('.customerFullname').val();
    var acc_id = $('.acc_id').val();
    var order_transaction_code = $('.order_transaction_code').val();
    var orders_status = $('.orders_status').val();
   
    $(".btnComplete").css("display", "none");


    $.ajax({
      url: 'userlist_order/controller/back_ApproveOrders.php',
      type: 'POST',
      data: { acc_id:acc_id, btnComplete: true, transaction_code: order_transaction_code,orders_status:orders_status,customerFullname:customerFullname },
      success: function(response) {
        console.log(response)
      },

      beforeSend: function() {
        $(".loadingSpinner").html('<div class="spinner-border text-warning" role="status"><span class="sr-only">Loading...</span></div>').show();
      }, 

      error: function(xhr, status, error) {
        //alert('Failed to cancel the order.');
        console.log(status, error)
      },

      complete: function() {
        alertify.success(" Order status change to complete successful");
        $(".loadingSpinner").hide();
        $(".btnComplete").css("display", "block");
        $('.completeModal').modal('hide');
        
      }

    });
  });



  $('.btnRemoveDisplay').click(function() {
    var customerFullname=$('.customerFullname').val();
    var acc_id = $('.acc_id').val();
    var order_transaction_code = $('.order_transaction_code').val();
    var orders_status = $('.orders_status').val();
   
    $(".btnRemoveDisplay").css("display", "none");


    $.ajax({
      url: 'userlist_order/controller/back_ApproveOrders.php',
      type: 'POST',
      data: { acc_id:acc_id, btnRemoveDisplay: true, transaction_code: order_transaction_code,orders_status:orders_status,customerFullname:customerFullname },
      success: function(response) {
        console.log(response)
      },
      beforeSend: function() {
        $(".loadingSpinner").html('<div class="spinner-border text-warning" role="status"><span class="sr-only">Loading...</span></div>').show();
      }, 
      error: function(xhr, status, error) {
        //alert('Failed to cancel the order.');
        console.log(status, error)
      },

      complete: function() {
        alertify.success(" Remove successful");
        $(".loadingSpinner").hide();
        $(".btnRemoveDisplay").css("display", "block");
        $('.completeModal').modal('hide');

        location.reload();
        
      }

    });
  });





});



function myFunction(order_transaction_code) {
    window.location.href = "order_progress.php?transaction_code=" + order_transaction_code;
  }
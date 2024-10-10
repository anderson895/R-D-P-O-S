$(document).ready(function () {


  const getCollectedCount = () => {
    $.ajax({
      url: 'backend/endpoints/get-collected-count.php', // PHP file where the data is coming from
      type: 'GET',
      dataType: 'json',
      success: function(response) {
          // The response will be in JSON format
          console.log(response); // You can inspect the response in your browser console

      
        
          $('#collectedCount').text(response);
      },
      error: function(xhr, status, error) {
          console.error("Error fetching order status counts:", error);
      }
  });
};


  const getOrdersCount = () => {
        $.ajax({
          url: 'backend/endpoints/get_count_status.php', // PHP file where the data is coming from
          type: 'GET',
          dataType: 'json',
          success: function(response) {
              // The response will be in JSON format
            console.log(response); // You can inspect the response in your browser console

              // Example of how you can handle the response:
              let pendingCount = response.Pending;
              let acceptedCount = response.Accepted;
              let readyForDeliveryCount = response.ReadyForDelivery;
              let shippedCount = response.Shipped;
              let deliveredCount = response.Delivered;
              let collectedCount = response.collectedCount;
              let rejected = response.Rejected;
              
              let cancelled = response.Cancelled;
              // You can display these counts in your HTML or process them further
              $('#pendingCount').text(pendingCount);
              $('#acceptedCount').text(acceptedCount);
              $('#readyForDeliveryCount').text(readyForDeliveryCount);
              $('#shippedCount').text(shippedCount);
              $('#deliveredCount').text(deliveredCount);
              $('#collectedCount').text(collectedCount);
              $('#rejectedCount').text(rejected);
              
                $('#cancelledCount').text(cancelled);
              
    
              
              
              
            //   rejectedCount
              
              
              
          },
          error: function(xhr, status, error) {
              console.error("Error fetching order status counts:", error);
          }
      });
  };




  // Get the URL parameters
  const getUrlParameter = (name) => {
    name = name.replace(/[[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
    var results = regex.exec(location.search);
    return results === null
      ? ""
      : decodeURIComponent(results[1].replace(/\+/g, " "));
  };

  const getCollectedCod = () => {
    var page = getUrlParameter("page");

    $.ajax({
        type: "GET",
        url: "backend/endpoints/get-cod-collected.php",
        data: {
            page: page,
        },
        beforeSend: function() {
            // Show the spinner before sending the request
            // $(".spinner-border").show();
        },
        success: function(response) {
            $("#CodCollectedContainer").html(response);
        },
        complete: function() {
            // Hide the spinner after the request is complete
            // $(".spinner-border").hide();
        },
    });
};




  const getOrders = () => {
    var page = getUrlParameter("page");

    $.ajax({
      type: "GET",
      url: "backend/endpoints/get-orders.php",
      data: {
        page: page,
      },
      success: function (response) {
        $("#ordersContainer").html(response);
      },
    });
  };

  const getOrderStatus = () => {
    var orderId = getUrlParameter("orderId");
    $.ajax({
      type: "GET",
      url: "backend/endpoints/get-order-status.php",
      data: {
        orderId: orderId,
      },
      success: function (response) {
        $("#viewOrderStatusContainer").html(response);
      },
    });
  };

  const getChangeOrderStatusButtons = () => {
    var orderId = getUrlParameter("orderId");
    $.ajax({
      type: "GET",
      url: "backend/endpoints/get-change-order-status-buttons.php",
      data: {
        orderId: orderId,
      },
      success: function (response) {
        $("#btnChangeOrderStatusContainer").html(response);
      },
    });
  };

  const getSelectRider = () => {
    var orderId = getUrlParameter("orderId");
    $.ajax({
      type: "GET",
      url: "backend/endpoints/get-select-rider.php",
      data: {
        orderId: orderId,
      },
      success: function (response) {
        $("#selectRiderContainer").html(response);
      },
    });
  };

  const closeModal = () => {
    $(".modal").modal("hide");
  };

  const showAlert = (alertType, text) => {
    $(alertType).text(text).css("opacity", "1");
    setTimeout(() => {
      $(alertType).css("opacity", "0");
    }, 1000);
  };
  setInterval(() => {
    getCollectedCount();
    getOrdersCount();
    getCollectedCod();
    getOrders();
    getOrderStatus();
    getChangeOrderStatusButtons();
  }, 3000);

  $(document).on("click", ".btnUpgradeStatus", function (e) {
    e.preventDefault();
    var currentStatus = $(this).data("currstats");
    if(currentStatus == "Shipped") {
        console.log(currentStatus);
        $("#changeOrderStatusModalToDelivered").modal("show");   
        $('#changeOrderStatusModalOrderIdDelivered').val($(this).data("id"));
    } else {
     $("#changeOrderStatusModal").modal("show");   
     $("#changeOrderStatusModalOrderId").val($(this).data("id"));
    }
  });


  
$(document).on("click", "#BtnCollect", function (e) {
  e.preventDefault();

  var riderId = $(this).attr('data-rider-id');

  console.log(riderId);


  Swal.fire({
    title: "Mark as Collected this?",
    text: "You won't be able to revert this!",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Confirm!"
  }).then((result) => {
    if (result.isConfirmed) {
      
      $.ajax({
        type: "POST",
        url: "backend/endpoints/post-set-collected.php",
        data: {riderId:riderId, requestType:"MarkAs_Collected"},
        dataType: "text",
        success: function (response) {

          console.log(response);
          
        }
      });
      
      Swal.fire("Saved!", "", "success");
    } else if (result.isDenied) {
      Swal.fire("Changes are not saved", "", "info");
    }
  });
});



  $("#frmChangeOrderStatus").submit(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "backend/endpoints/post.php",
      data: formData,
      success: function (response) {

        console.log(response);
        closeModal();
        if (response == "200") {
          showAlert(".alert-success", "Order Status Changed!");
          getOrderStatus();
          getChangeOrderStatusButtons();
          getSelectRider();
        } else if (response == "Please select rider!") {
          showAlert(".alert-danger", response);
        } else {
          showAlert(".alert-danger", "Something went wrong!");
          window.location.reload();
        }
      },
    });
  });
  
  $("#frmChangeOrderStatusToDelivered").submit(function (e) {
    e.preventDefault();

    // Disable the submit button
    var $submitButton = $(this).find('button[type="submit"]'); // Adjust the selector to match your button
    $submitButton.prop('disabled', true);
    
    // Create a container for the spinner and center it
    var $spinnerContainer = $('<div class="spinner-container d-flex justify-content-center align-items-center"></div>');
    var $spinner = $('<div class="spinner-border" role="status"><span class="sr-only"></span></div>');
    $spinnerContainer.append($spinner);
    
    // Append the spinner container to the form
    $(this).append($spinnerContainer);

    // Optionally, style the container to cover the entire form or a specific section
    $spinnerContainer.css({
        position: 'absolute', // Make sure the container is positioned over the form
        top: 0,
        left: 0,
        width: '100%',
        height: '100%',
        background: 'rgba(255, 255, 255, 0.8)', // Optional: semi-transparent background to overlay on the form
        zIndex: 1000 // Make sure it's above other elements
    });

    var formData = new FormData($(this)[0]);

    $.ajax({
        type: "POST",
        url: "backend/endpoints/post.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            closeModal();
            if (response == "200") {
                showAlert(".alert-success", "Order Status Changed!");
                getOrderStatus();
            } else if (response == "Please select rider!") {
                showAlert(".alert-danger", response);
            } else {
                showAlert(".alert-danger", "Something went wrong!");
                console.log(response);
            }
        },
        error: function () {
            // Handle error case
            showAlert(".alert-danger", "An error occurred. Please try again.");
        },
        complete: function () {
            // Re-enable the submit button and hide the spinner
            $submitButton.prop('disabled', false);
            $spinnerContainer.remove(); // Remove the spinner container after the process
        }
    });
});



  $(document).on("click", ".btnRejectOrder", function (e) {
    e.preventDefault();
    $("#rejectOrderId").val($(this).data("id"));
    $("#rejectOrderModal").modal("show");
  });

  $("#frmRejectOrder").submit(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "backend/endpoints/post.php",
      data: formData,
      success: function (response) {
        closeModal();
        if (response == "200") {
          showAlert(".alert-success", "Order Rejected!");
          getOrderStatus();
          getChangeOrderStatusButtons();
          getSelectRider();
        } else {
          showAlert(".alert-danger", "Something went wrong!");
          window.location.reload();
        }
      },
    });
  });

  $(".btnCloseModal").click(function (e) {
    e.preventDefault();
    closeModal();
  });

  $(document).on("change", "#selectRider", function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "backend/endpoints/post.php",
      data: {
        requestType: "SelectRider",
        riderId: $(this).val(),
        orderId: $(this).data("id"),
      },
      success: function (response) {
        console.log(response);
      },
    });
  });
  getCollectedCount();
  getOrdersCount();
  getCollectedCod();
  getOrders();
  getOrderStatus();
  getChangeOrderStatusButtons();
  getSelectRider();
});

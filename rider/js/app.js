$(document).ready(function () {

  
  //   Functions

  const getCollectedCount = () => {
    $.ajax({
      url: 'backend/endpoints/get-collected-count.php', // PHP file where the data is coming from
      type: 'GET',
      dataType: 'json',
      success: function(response) {
          // The response will be in JSON format
          // console.log(response); // You can inspect the response in your browser console

      
        
          $('#collectedCount').text(response);
      },
      error: function(xhr, status, error) {
          console.error("Error fetching order status counts:", error);
      }
  });
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

          // You can display these counts in your HTML or process them further
          // $('#pendingCount').text(pendingCount);
          // $('#acceptedCount').text(acceptedCount);
          $('#readyForDeliveryCount').text(readyForDeliveryCount);
          $('#shippedCount').text(shippedCount);
          $('#deliveredCount').text(deliveredCount);
          // $('#collectedCount').text(collectedCount);
      },
      error: function(xhr, status, error) {
          console.error("Error fetching order status counts:", error);
      }
  });
};


  const showAlert = (alertType, text) => {
    $(alertType).text(text).css("opacity", "1");
    setTimeout(() => {
      $(alertType).css("opacity", "0");
    }, 1000);
  };

  const getUrlParameter = (name) => {
    name = name.replace(/[[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
    var results = regex.exec(location.search);
    return results === null
      ? ""
      : decodeURIComponent(results[1].replace(/\+/g, " "));
  };

  const displayOrders = () => {
    $.ajax({
      type: "GET",
      url: "backend/endpoints/get-orders.php",
      data: {
        page: getUrlParameter("page"),
      },
      success: function (response) {
        $("#OrdersContainer").html(response);
      },
    });
  };

  const getOrderStatus = () => {
    $.ajax({
      type: "GET",
      url: "backend/endpoints/get-order-status.php",
      data: {
        orderId: getUrlParameter("orderId"),
      },
      success: function (response) {
        $("#viewOrderStatusContainer").html(response);
      },
    });
  };

  const getBtnDeliverOrder = () => {
    $.ajax({
      type: "GET",
      url: "backend/endpoints/get-change-order-status-buttons.php",
      data: {
        orderId: getUrlParameter("orderId"),
      },
      success: function (response) {
        $("#btnChangeOrderStatusContainer").html(response);
      },
    });
  };

  const closeModal = () => {
    $(".modal").modal("hide");
  };

  $(".btnCloseModal").click(function (e) {
    e.preventDefault();
    closeModal();
  });

  // Deliver Order
  $(document).on("click", ".btnUpgradeStatus", function (e) {
    e.preventDefault();
    $("#changeOrderStatusModalOrderId").val($(this).data("id"));
    $("#changeOrderStatusModal").modal("show");
  });


  
  $("#frmChangeOrderStatus").submit(function (e) {
    e.preventDefault();
    
    // Show the spinner and disable the submit button
    var submitButton = $(this).find('button[type="submit"]');
    submitButton.find('.spinner-border').removeClass('d-none');
    submitButton.attr('disabled', true);
    
    var formData = new FormData($(this)[0]);
    
    $.ajax({
      type: "POST",
      url: "backend/endpoints/post.php",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        // Hide the spinner and enable the submit button
        submitButton.find('.spinner-border').addClass('d-none');
        submitButton.attr('disabled', false);
        
        closeModal();
        if (response == "200") {
          showAlert(".alert-success", "Order Status Changed!");
          getOrderStatus();
          getBtnDeliverOrder();
        } else if (response == "Please select rider!") {
          showAlert(".alert-danger", response);
        } else {
          showAlert(".alert-danger", "Something went wrong!");
          window.location.reload();
        }
      },
      error: function () {
        // Handle error
        submitButton.find('.spinner-border').addClass('d-none');
        submitButton.attr('disabled', false);
        showAlert(".alert-danger", "An error occurred!");
      }
    });
});


  setInterval(() => {
    getCollectedCount();
    getCollectedCod();
    getOrdersCount();
    displayOrders();
  }, 3000);

  setInterval(() => {
    
    getOrderStatus();
    getBtnDeliverOrder();
  }, 1000);


  getCollectedCount();
  getOrdersCount();
  getCollectedCod();
  displayOrders();
  getOrderStatus();
  getBtnDeliverOrder();
});

$(document).ready(function () {
  // Get the URL parameters
  const getUrlParameter = (name) => {
    name = name.replace(/[[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
    var results = regex.exec(location.search);
    return results === null
      ? ""
      : decodeURIComponent(results[1].replace(/\+/g, " "));
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

  $("#frmChangeOrderStatus").submit(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "backend/endpoints/post.php",
      data: formData,
      success: function (response) {
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
    console.log('asd');
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
        //   getBtnDeliverOrder();
        } else if (response == "Please select rider!") {
          showAlert(".alert-danger", response);
        } else {
          showAlert(".alert-danger", "Something went wrong!");
        //   window.location.reload();
        console.log(response);
        }
      },
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

  getOrders();
  getOrderStatus();
  getChangeOrderStatusButtons();
  getSelectRider();
});

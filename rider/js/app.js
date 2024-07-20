$(document).ready(function () {
  //   Functions
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
          getBtnDeliverOrder();
        } else if (response == "Please select rider!") {
          showAlert(".alert-danger", response);
        } else {
          showAlert(".alert-danger", "Something went wrong!");
          window.location.reload();
        }
      },
    });
  });

  setInterval(() => {
    displayOrders();
  }, 3000);

  setInterval(() => {
    getOrderStatus();
    getBtnDeliverOrder();
  }, 1000);

  displayOrders();
  getOrderStatus();
  getBtnDeliverOrder();
});

$(document).ready(function () {

const getOrdersCount = () => {
    $.ajax({
      url: '../new-orders-view/backend/endpoints/get_count_status.php', // PHP file where the data is coming from
      type: 'GET',
      dataType: 'json',
      success: function(response) {
          // The response will be in JSON format
        console.log(response); // You can inspect the response in your browser console

          // Example of how you can handle the response:
          let pendingCount = response.Pending;
        //   let acceptedCount = response.Accepted;
        //   let readyForDeliveryCount = response.ReadyForDelivery;
        //   let shippedCount = response.Shipped;
        //   let deliveredCount = response.Delivered;
        //   let collectedCount = response.collectedCount;
        //   let rejected = response.Rejected;
          
        //   let cancelled = response.Cancelled;
          // You can display these counts in your HTML or process them further
          $('#pendingCount').text(pendingCount);
        //   $('#acceptedCount').text(acceptedCount);
        //   $('#readyForDeliveryCount').text(readyForDeliveryCount);
        //   $('#shippedCount').text(shippedCount);
        //   $('#deliveredCount').text(deliveredCount);
        //   $('#collectedCount').text(collectedCount);
        //   $('#rejectedCount').text(rejected);
          
        //     $('#cancelledCount').text(cancelled);
          

          
          
          
        //   rejectedCount
          
          
          
      },
      error: function(xhr, status, error) {
          console.error("Error fetching order status counts:", error);
      }
  });
};

setInterval(() => {
    getOrdersCount();
  }, 3000);


  getOrdersCount();
});

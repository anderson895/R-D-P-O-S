$(document).ready(function () {

const getOrdersCount = () => {
    $.ajax({
      url: '../new-orders-view/backend/endpoints/get_count_status.php', // PHP file where the data is coming from
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        console.log(response);

          let pendingCount = response.Pending;
       
          $('#pendingCount').text(pendingCount);

          if (pendingCount > 0) {
            $('#pendingCount').show();
        } else {
            $('#pendingCount').hide();
        }
   
          
          
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

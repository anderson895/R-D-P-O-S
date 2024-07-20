<?php

include("../../connection.php");
$discount_id = $discountName = $discountRate = "";
// Check if the request is a POST request
if (isset($_POST["btn_update_discount"])) {
  // Retrieve the form data
  $discount_id = $_POST['discount_id_update'];
  $discountName = $_POST['discount_name_update'];
  $discountRate = $_POST['discount_rate_update'];

  // Perform the database update
  $query = "UPDATE `discount` SET 
            `discount_name` = '$discountName',
            `discount_rate` = '$discountRate'
            WHERE `discount_id` = '$discount_id'";

  // Prepare the update statement
  if (mysqli_query($connections, $query)) {
    // Update successful
    echo '
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
      swal({
        title: "Success!",
        text: "Update Discount Successful",
        icon: "success",
        content: true // Use the "content" option instead of "html"
      }).then((value) => {
        if (value) {
          window.location.href = "managediscount.php";
          // Display the print receipt code here
        } else {
          window.location.reload();
        }
      });
    });
    </script>';
  } else {
    // Error occurred while updating
    echo "Error updating record: " . mysqli_error($connections);
  }
}
?>

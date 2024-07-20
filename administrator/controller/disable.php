<?php 
include "../../connection.php";


// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the form data
  $voucher_id = $_POST['voucher_id'];
  

  // Perform the database update
  $query = "UPDATE `voucher` SET `voucher_status` = '0' 
            WHERE `voucher_id` = '$voucher_id'";

  // Prepare the update statement
  if (mysqli_query($connections, $query)) {
  
   
  } else {
    echo "Error updating record: " . mysqli_error($connections);
  }
}
?>
